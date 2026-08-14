<?php

namespace App\Services\Admin\Batch;

use App\Exports\Admin\Batch\Judgment\DangExport;
use App\Exports\Admin\Batch\Judgment\HanhChinhExport;
use App\Exports\Admin\Batch\Judgment\HinhSuExport;
use App\Exports\Admin\Batch\Judgment\HonNhanGiaDinhExport;
use App\Exports\Admin\Batch\Judgment\ThiHanhAnExport;
use App\Repositories\BatchRepository;
use App\Repositories\JudgmentDocumentRepository;
use App\Repositories\JudgmentRepository;
use App\Repositories\OldAgencyRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BatchService extends BaseService
{
    public function __construct(
        protected BatchRepository $batchRepository,
        protected StatusRepository $statusRepository,
        protected TypeRepository $typeRepository,
        protected OldAgencyRepository $oldAgencyRepository,
        protected UserRepository $userRepository,
        protected JudgmentRepository $judgmentRepository,
        protected JudgmentDocumentRepository $judgmentDocumentRepository,
    )
    {
        parent::__construct($batchRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('batch');
        $data['types'] = $this->typeRepository->getActiveByModule('judgment');
        return $data;
    }

    public function filter(Request $request): array
    {
        $batches = $this->batchRepository->getSum(
            $request->all(),
            ['oldAgency', 'status', 'type', 'entries', 'checkers'],
            ['judgments', 'entryJudgments', 'checkJudgments', 'judgmentDocuments', 'defendants']
        );
        foreach ($batches as $batch) {
            $batch->entry_rate = calculateRate($batch->entry_judgments_count, $batch->judgments_count);
            $batch->check_rate = calculateRate($batch->check_judgments_count, $batch->judgments_count);
        }
        $data = $request->all();
        $data['batches'] = $batches;
        return $data;
    }

    public function detail(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['batch'] = $this->batchRepository->find($id, ['oldAgency']);
        return $data;
    }

    public function show(string|int $id, Request $request): array
    {
        $batch = $this->batchRepository->reportById($id);
        $batch->entry_rate = calculateRate($batch->entry_judgments_count, $batch->judgments_count);
        $batch->check_rate = calculateRate($batch->check_judgments_count, $batch->judgments_count);

        $data = $request->all();
        $data['batch'] = $batch;
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('batch');
        $data['types'] = $this->typeRepository->getActiveByModule('judgment');
        $data['checkers'] = $data['entries'] = $this->userRepository->getByRole('sale');
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $this->handleFormatDate($request->validated(), ['start_date', 'end_date']);
        if (isset($createData['folder_path']) && $createData['folder_path'] && pathinfo($createData['folder_path'], PATHINFO_EXTENSION)) {
            $createData['folder_path'] = dirname($createData['folder_path']);
        }

        unset($createData['entry_id'], $createData['checker_id']);
        $batch = $this->batchRepository->create($createData);

        if ($request->has('entry_id')) {
            $batch->entries()->sync($request->input('entry_id'));
        }
        if ($request->has('checker_id')) {
            $batch->checkers()->sync($request->input('entry_id'));
        }
        return $batch;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['batch'] = $this->batchRepository->find($id, ['entries', 'checkers']);
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        $data['types'] = $this->typeRepository->getActiveByModule('judgment');
        $data['statuses'] = $this->statusRepository->getActiveByModule('batch');
        $data['checkers'] = $data['entries'] = $this->userRepository->getByRole('sale');
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $this->handleFormatDate($request->validated(), ['start_date', 'end_date']);
        if (isset($updateData['folder_path']) && $updateData['folder_path'] && pathinfo($updateData['folder_path'], PATHINFO_EXTENSION)) {
            $updateData['folder_path'] = dirname($updateData['folder_path']);
        }

        unset($updateData['entry_id'], $updateData['checker_id']);
        $this->batchRepository->update($id, $updateData);

        $batch = $this->batchRepository->find($id);
        if ($request->has('entry_id')) {
            $batch->entries()->sync($request->input('entry_id'));
        }
        if ($request->has('checker_id')) {
            $batch->checkers()->sync($request->input('checker_id'));
        }
        return true;
    }

    public function reportCard(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['batch'] = $this->batchRepository->find($id, ['entries', 'checkers']);
        return $data;
    }

    public function reportEntry(Request $request): array
    {
        $batch = $this->batchRepository->reportEntryById($request->input('batch_id'));
        $batch->entry_rate = calculateRate($batch->entry_judgments_count, $batch->judgments_count);

        if ($batch->entries) {
            foreach ($batch->entries as $entry) {
                $entry->entry_rate = $entry->judgments_count ? round($entry->entry_judgments_count/$entry->judgments_count*100) : 0;
            }
        }

        $data = $request->all();
        $data['batch'] = $batch;
        return $data;
    }

    public function reportCheck(Request $request): array
    {
        $batch = $this->batchRepository->reportCheckById($request->input('batch_id'));
        $batch->check_rate = calculateRate($batch->check_judgments_count, $batch->judgments_count);

        if ($batch->checkers) {
            foreach ($batch->checkers as $check) {
                $check->check_rate = $check->judgments_count ? round($check->check_judgments_count/$check->judgments_count*100) : 0;
            }
        }

        $data = $request->all();
        $data['batch'] = $batch;
        return $data;
    }

    public function reportDateFilter(Request $request): array
    {
        $batch = $this->batchRepository->reportDateById($request->input('batch_id'), $request->all());
        $entries = $batch->entries;
        $checkers = $batch->checkers;

        $allParticipants = $entries->concat($checkers)
            ->groupBy('id')
            ->map(function ($users) {
                $participant = $users->first();
                $participant->entry_judgments_count = $users->sum(fn ($user) => $user->entry_judgments_count ?? 0);
                $participant->check_judgments_count = $users->sum(fn ($user) => $user->check_judgments_count ?? 0);
                $participant->entry_defendants_count = $users->sum(fn ($user) => $user->entry_defendants_count ?? 0);
                $participant->check_defendants_count = $users->sum(fn ($user) => $user->check_defendants_count ?? 0);
                $participant->entry_number_sum = $users->sum(fn ($user) => $user->entry_number_sum ?? 0);
                $participant->check_number_sum = $users->sum(fn ($user) => $user->check_number_sum ?? 0);
                return $participant;
            })
            ->values();

        $batch->users = $allParticipants;

        $data = $request->all();
        $data['batch'] = $batch;
        return $data;
    }

    public function exportDetail(string|int $id, Request $request): BinaryFileResponse
    {
        $batch = $this->repository->find($id);
        $filter = ['batch_id' => $id];

        $judgments = $this->judgmentRepository->getSum(
            $filter,
            ['status', 'entry', 'checker', 'batch', 'tenurePeriod', 'retentionPeriod', 'font'],
            ['judgmentDocuments', 'entryJudgmentDocuments', 'checkJudgmentDocuments']
        );

        $judgmentDocuments = $judgments->flatMap(function ($judgment) {
            return $judgment->judgmentDocuments->map(function ($jd) use ($judgment) {
                $jd->setRelation('judgment', $judgment);
                return $jd;
            });
        });

        $data = $judgmentDocuments;

        switch ($batch->type->code) {
            case 'DANG':
                return Excel::download(new DangExport($data), 'dang.xlsx');
            case 'THI HANH AN HINH SU':
            case 'THI HANH AN TU HINH':
            case 'XOA AN TICH':
                return Excel::download(new ThiHanhAnExport($data), 'sohoa.xlsx');
            case 'HON NHAN GIA DINH':
                return Excel::download(new HonNhanGiaDinhExport($data), 'sohoa.xlsx');
            case 'HINH SU':
                return Excel::download(new HinhSuExport($data), 'sohoa.xlsx');
            case 'HANH CHINH':
            case 'DAN SU':
            case 'LAO DONG':
            case 'KINH DOANH THUONG MAI':
            case 'PHA SAN':
            default:
                return Excel::download(new HanhChinhExport($data), 'sohoa.xlsx');
        }
    }

    public function reportUser(Request $request): array
    {
        return $request->all();
    }

    public function reportUserFilter(Request $request): array
    {
        $data = $request->all();
        $data['users'] = $this->userRepository->reportBatch($request->all());
        return $data;
    }
}
