<?php

namespace App\Services\Admin\Batch;

use App\Models\User;
use App\Models\Defendant;
use App\Models\JudgmentDocument;
use App\Repositories\BatchRepository;
use App\Repositories\DefendantRepository;
use App\Repositories\JudgmentDocumentRepository;
use App\Repositories\JudgmentRepository;
use Illuminate\Database\Eloquent\Model;
use App\Services\BaseService;
use Illuminate\Http\Request;

class DefendantService extends BaseService
{
    public function __construct(
        protected DefendantRepository $defendantRepository,
        protected JudgmentRepository $judgmentRepository,
        protected JudgmentDocumentRepository $judgmentDocumentRepository,
        protected BatchRepository $batchRepository,
        protected Defendant $defendant,
        protected JudgmentDocument $judgmentDocument
    )
    {
        parent::__construct($defendantRepository);
    }

    private function checkD(): int
    {
        $ds = $this->defendant->newQuery()
            ->selectRaw('judgment_id, full_name, organization_tax_code, GROUP_CONCAT(id) as ids')
            ->groupBy('judgment_id', 'full_name', 'organization_tax_code')
            ->havingRaw('COUNT(id) > 1')
            ->get();

        foreach ($ds as $d) {
            $ids = explode(',', $d->ids);
            if (count($ids) > 1) {
                foreach ($ids as $i => $id) {
                    if ($i > 0) {
                        $this->defendantRepository->delete($id);
                    }
                }
            }
        }

        return 0;
    }

    public function changePath($oldPath, $newPath, int|string|array $id): void
    {
        $batches = $this->batchRepository->get(['id' => $id], ['judgments', 'judgmentDocuments', 'oldAgency']);
        foreach ($batches as $batch) {
            $this->batchRepository->update($batch->id, ['folder_path' => str_replace($oldPath, $newPath, $batch->folder_path)]);
            foreach ($batch->judgments as $judgment) {
                $this->judgmentRepository->update($judgment->id, ['folder_path' => str_replace($oldPath, $newPath, $judgment->folder_path)]);
            }
            foreach ($batch->judgmentDocuments as $judgmentDocument) {
                $this->judgmentDocumentRepository->update($judgmentDocument->id, ['file_path' => str_replace($oldPath, $newPath, $judgmentDocument->file_path)]);
            }
        }
    }

    private function updateRate(): bool
    {
        $js = $this->judgmentRepository->get(['status_id' => env('APP_JUDGMENT_STATUS_ENTRIED_ID')]);
        foreach ($js as $j) {
            $judgmentEntry = $this->judgmentRepository->findArray($j->id);
            $updateEntry['entry_json'] = json_encode($judgmentEntry, true);
            $updateEntry['entry_number'] = countValidElements($judgmentEntry);
            $updateEntry['entried_at'] = date('Y-m-d H:i:s');
            $this->judgmentRepository->update($j->id, $updateEntry);
        }

        $js = $this->judgmentRepository->get(['status_id' => env('APP_JUDGMENT_STATUS_CHECKED_ID')]);
        foreach ($js as $j) {
            $judgmentEntry = $this->judgmentRepository->findArray($j->id);
            $updateEntry['entry_json'] = json_encode($judgmentEntry, true);
            $updateEntry['entry_number'] = countValidElements($judgmentEntry);
            $updateEntry['entried_at'] = date('Y-m-d H:i:s');
            $this->judgmentRepository->update($j->id, $updateEntry);

            $judgmentCheck = $this->judgmentRepository->findArray($j->id);
            $updateCheck['check_number'] = countAllChanges(json_decode($j['entry_json'], true), $judgmentCheck);
            $updateCheck['check_number_rate'] = $j['entry_number'] ? floor($updateCheck['check_number']/$j['entry_number']*100) : 0;
            $updateCheck['checked_at'] = date('Y-m-d H:i:s');
            $this->judgmentRepository->update($j->id, $updateCheck);
        }
        return true;
    }

    public function index(Request $request): array
    {
        // xoa cac bi cao thua
        // $this->checkD();

        // Doi ten cac
        // $this->changePath('/D01/', '/D01.20/', [3,4,5,6,7,8,9,12,13,14,16,17,18,19,20,21]);
        // $this->changePath('/CSDL/', '/CSDL/D01.20/', [22,23,24,25,27,28,29,30]);
        // $this->changePath('/D01.1/', '/D01/', [31,32,33]);
        // $this->changePath('/QD DC', '/QDDC', [24,25,30]);
        // $this->changePath('/QD GQ', '/QDGQ', [18,20,21]);

        // $this->updateRate();

        $this->changePath('/D01.20/D01.20/', '/D01.20/', [35,36,37,38,39,40]);

        dd('done');

        return [];
    }

    public function store(Request $request): Model|array|null
    {
        $dataCreate = $this->handleFormatDate(
            $request->validated(),
            [
                'identity_created_date',
                'identity_expiry_date',
                'birth_date',
                'prohibition_start_date',
                'judicial_measure_start_date',
                'judicial_measure_end_date',
                'execution_date',
            ]
        );

        unset($dataCreate['defendant_id']);
        unset($dataCreate['main_penalty_id']);
        unset($dataCreate['additional_penalty_id']);

        unset($dataCreate['nationality_id']);
        unset($dataCreate['judicial_measure_name_id']);
        unset($dataCreate['legal_relationship_id']);

        $dataCreate['first_instance_court_fee'] = $dataCreate['first_instance_court_fee'] ? formatPrice($dataCreate['first_instance_court_fee']) : null;
        $dataCreate['appellate_court_fee'] = $dataCreate['appellate_court_fee'] ? formatPrice($dataCreate['appellate_court_fee']) : null;
        $dataCreate['civil_court_fee'] = $dataCreate['civil_court_fee'] ? formatPrice($dataCreate['civil_court_fee']) : null;
        $dataCreate['total_court_fee'] = $dataCreate['first_instance_court_fee'] + $dataCreate['appellate_court_fee'] + $dataCreate['civil_court_fee'];
        $dataCreate['total_court_fee'] = $dataCreate['total_court_fee'] ? formatPrice($dataCreate['total_court_fee']) : null;

        $dataCreate['content_summary'] = $dataCreate['full_name'].' '.($dataCreate['crime_name'] ?? '');

        $defendant = $this->defendantRepository->find($request->input('defendant_id'));
        if ($defendant) {
            $this->defendantRepository->update($defendant->id, $dataCreate);
        } else {
            $defendant = $this->defendantRepository->create($dataCreate);
        }

        $defendant->nationalities()->sync($request->input('nationality_id'));
        $defendant->judicialMeasureNames()->sync($request->input('judicial_measure_name_id'));
        $defendant->legalRelationships()->sync($request->input('legal_relationship_id'));

        $mainPenaltyIds = $request->input('main_penalty_id');
        $mainPenaltyIds = collect($mainPenaltyIds)->filter()->values();
        $subData = $mainPenaltyIds->mapWithKeys(function ($id) {
            return [$id => ['is_main' => 1]];
        })->toArray();
        $defendant->mainPenalties()->sync($subData);

        $additionalPenaltyIds = $request->input('additional_penalty_id');
        $additionalPenaltyIds = collect($additionalPenaltyIds)->filter()->values();
        $subData = $additionalPenaltyIds->mapWithKeys(function ($id) {
            return [$id => ['is_main' => 0]];
        })->toArray();
        $defendant->additionalPenalties()->sync($subData);

        $defendant->judgmentDocument->itemNotes()->create([
            'status_id' => $defendant->judgmentDocument->status_id,
            'note' => __('app.update') . ' ' . $request->input('full_name'),
            'created_by_id' => session('user_id'),
            'created_by_type' =>  User::class
        ]);

        return $defendant;
    }
}
