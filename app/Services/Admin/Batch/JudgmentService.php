<?php

namespace App\Services\Admin\Batch;

use App\Repositories\AgencyRepository;
use App\Repositories\BatchRepository;
use App\Repositories\ConfigRepository;
use App\Repositories\DefendantRepository;
use App\Repositories\JudgmentRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\OldAgencyRepository;
use App\Repositories\OldDistrictRepository;
use App\Repositories\OldProvinceRepository;
use App\Repositories\OldWardRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\Repositories\WardRepository;
use App\Services\BaseService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class JudgmentService extends BaseService
{
    public function __construct(
        protected JudgmentRepository    $judgmentRepository,
        protected DefendantRepository   $defendantRepository,
        protected BatchRepository       $batchRepository,
        protected TypeRepository        $typeRepository,
        protected StatusRepository      $statusRepository,
        protected ConfigRepository $configRepository,
        protected LanguageRepository $languageRepository,

        protected ProvinceRepository    $provinceRepository,
        protected WardRepository        $wardRepository,
        protected AgencyRepository      $agencyRepository,

        protected OldAgencyRepository   $oldAgencyRepository,
        protected OldProvinceRepository $oldProvinceRepository,
        protected OldDistrictRepository $oldDistrictRepository,
        protected OldWardRepository     $oldWardRepository,
        protected UserRepository $userRepository
    )
    {
        parent::__construct($judgmentRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['batches'] = $this->batchRepository->get();
        $data['checkers'] = $data['entries'] = $this->userRepository->getByRole('sale');
        $data['statuses'] = $this->statusRepository->getActiveByModule('judgment');
        $data['tenurePeriods'] = $this->configRepository->getByModule('tenure_period');
        $data['fonts'] = $this->configRepository->getByModule('font');
        return $data;
    }

    public function filterCard(Request $request): array
    {
        $batch = $this->batchRepository->find($request->input('batch_id'), ['entries', 'checkers']);

        $data = $request->all();
        $data['entries'] = $batch->entries;
        $data['checkers'] = $batch->checkers;
        $data['statuses'] = $this->statusRepository->getActiveByModule('judgment');
        $data['tenurePeriods'] = $this->configRepository->getByModule('tenure_period');
        $data['fonts'] = $this->configRepository->getByModule('font');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['judgments'] = $this->judgmentRepository->getSum(
            $request->all(),
            ['status', 'entry', 'checker', 'batch', 'tenurePeriod', 'retentionPeriod', 'font'],
            ['judgmentDocuments', 'entryJudgmentDocuments', 'checkJudgmentDocuments']
        );
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['judgment'] = $this->judgmentRepository->find($id);
        $data['languages'] = $this->languageRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('judgment');
        $data['physicalConditions'] = $this->configRepository->getByModule('physical_condition');
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $judgment = $this->judgmentRepository->find($id);

        $updateData = $request->validated();
        $updateData = $this->handleFormatDate($updateData, ['start_date', 'end_date']);
        unset($updateData['language_id']);

        $this->judgmentRepository->update($id, $updateData);
        $judgment->languages()->sync($request->input('language_id'));

        if ($judgment->status_id == env('APP_JUDGMENT_STATUS_NEW_ID') && $request->input('status_id') == env('APP_JUDGMENT_STATUS_ENTRIED_ID')) {
            $judgmentEntry = $this->judgmentRepository->findArray($id);
            $updateEntry['entry_json'] = json_encode($judgmentEntry, true);
            $updateEntry['entry_number'] = countValidElements($judgmentEntry);
            $updateEntry['entried_at'] = date('Y-m-d H:i:s');
            $this->judgmentRepository->update($id, $updateEntry);
        }
        if ($judgment->status_id == env('APP_JUDGMENT_STATUS_ENTRIED_ID') && $request->input('status_id') == env('APP_JUDGMENT_STATUS_CHECKED_ID')) {
            $judgmentCheck = $this->judgmentRepository->findArray($id);
            $updateCheck['check_number'] = countAllChanges(json_decode($judgment['entry_json'], true), $judgmentCheck);
            $updateCheck['check_number_rate'] = $judgment['entry_number'] ? floor($updateCheck['check_number']/$judgment['entry_number']*100) : 0;
            $updateCheck['checked_at'] = date('Y-m-d H:i:s');
            $this->judgmentRepository->update($id, $updateCheck);
        }
        return true;
    }

    public function updateHvg(Request $request): void
    {
        $js = $this->judgmentRepository->get([
            'status_id' => env('APP_JUDGMENT_STATUS_ENTRIED_ID'),
            'batch_id' => $request->input('batch_id'),
        ]);
        foreach ($js as $j) {
            $judgmentEntry = $this->judgmentRepository->findArray($j->id);

            $updateEntry['entry_json'] = $j->entry_json ?: json_encode($judgmentEntry, true);
            $updateEntry['entry_number'] = $j->entry_number ?: countValidElements($judgmentEntry);
            $updateEntry['entried_at'] = $j->entried_at ?: $j->updated_at;
            $this->judgmentRepository->update($j->id, $updateEntry);
        }

        $js = $this->judgmentRepository->get([
            'status_id' => env('APP_JUDGMENT_STATUS_CHECKED_ID'),
            'batch_id' => $request->input('batch_id'),
        ]);
        foreach ($js as $j) {
            $judgmentCheck = $this->judgmentRepository->findArray($j->id);
            $updateCheck['entry_json'] = $j->entry_json ?: json_encode($judgmentCheck, true);
            $updateCheck['entry_number'] = $j->entry_number ?: countValidElements($judgmentCheck);
            $updateCheck['entried_at'] = $j->entried_at ?: $j->updated_at;
            $updateCheck['check_number'] = $j->check_number ?: countAllChanges(json_decode($j['entry_json'], true), $judgmentCheck);
            $updateCheck['check_number_rate'] = $j->check_number_rate ?: ($j['entry_number'] ? floor($updateCheck['check_number']/$j['entry_number']*100) : 0);
            $updateCheck['checked_at'] = $j->checked_at ?: $j->updated_at;
            $this->judgmentRepository->update($j->id, $updateCheck);
        }
    }

    public function reportCard(Request $request): array
    {
        $data = $request->all();
        $data['batch'] = $this->batchRepository->find($request->input('batch_id'), ['entries', 'checkers']);
        return $data;
    }

    public function reportFilter(Request $request): array
    {
        $data = $request->all();
        $data['chartData'] = $this->handleChartData($request->all());
        return $data;
    }

    public function handleChartData(?array $filters): array
    {
        $entryData = $this->judgmentRepository->reportEntry($filters)->keyBy('report_date');
        $checkData = $this->judgmentRepository->reportCheck($filters)->keyBy('report_date');

        $period = CarbonPeriod::create($filters['start_date'], $filters['end_date']);
        $result = collect($period)->map(fn($d) => [
            'key' => $key = $d->format('Y-m-d'),
            'date' => $d->format('d-m-Y'),
            'entry_count' => $entryData[$key]->judgments_count ?? 0,
            'check_count' => $checkData[$key]->judgments_count ?? 0,
        ]);

        return [
            'labels' => $result->pluck('date'),
            'series' => [
                [
                    'name' => __('app.entry'),
                    'data' => $result->pluck('entry_count'),
                ],
                [
                    'name' => __('app.check'),
                    'data' => $result->pluck('check_count'),
                ],
            ],
        ];
    }

    public function destroyManyEntry(Request $request): array|bool|null
    {
        $ids = explode(',', $request->input('ids'));
        $updateData = [
            'entry_id' => null,
        ];
        return $this->judgmentRepository->update($ids, $updateData);
    }

    public function destroyManyChecker(Request $request): array|bool|null
    {
        $ids = explode(',', $request->input('ids'));
        $updateData = [
            'checker_id' => null,
        ];
        return $this->judgmentRepository->update($ids, $updateData);
    }

    public function showWorkDistribution(Request $request): array
    {
        $data = $request->all();
        $data['batch'] = $this->batchRepository->find($request->input('batch_id'), ['entries', 'checkers']);
        return $data;
    }

    public function workDistribution(Request $request): array|bool|null
    {
        $ids = explode(',', $request->input('ids'));

        $entryKey = 0;
        $checkerKey = 0;

        $entryIds = $request->input('entry_id');
        $checkerIds = $request->input('checker_id');

        foreach ($ids as $id) {
            $updateData = null;
            $judgment = $this->judgmentRepository->find($id);
            if (!$judgment?->entry_id) {
                $entryArr = circularNextInArray($entryIds, $entryKey);
                $updateData['entry_id'] = $entryArr['value'];
                $entryKey = $entryArr['key'];
            }
            if (!$judgment?->checker_id) {
                $checkerArr = circularNextInArray($checkerIds, $checkerKey);
                if ($checkerArr['value'] == ($updateData['entry_id'] ?? $judgment->entry_id)) {
                    $checkerArr = circularNextInArray($checkerIds, $checkerArr['key']);
                }
                $updateData['checker_id'] = $checkerArr['value'];
                $checkerKey = $checkerArr['key'];
            }
            if ($updateData) {
                $this->judgmentRepository->update($id, $updateData);
            }
        }
        return true;
    }
}
