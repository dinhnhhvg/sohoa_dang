<?php

namespace App\Services\Admin\Batch;

use App\Models\User;
use App\Repositories\BatchRepository;
use App\Repositories\JudgmentDocumentRepository;
use App\Repositories\JudgmentRepository;
use App\Repositories\OldAgencyRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class WorkDistributionService extends BaseService
{
    public function __construct(
        protected BatchRepository $batchRepository,
        protected OldAgencyRepository $oldAgencyRepository,
        protected StatusRepository $statusRepository,
        protected TypeRepository $typeRepository,
        protected JudgmentRepository $judgmentRepository,
        protected JudgmentDocumentRepository $judgmentDocumentRepository
    )
    {
        parent::__construct($batchRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['oldAgencies'] = $this->oldAgencyRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('batch');
        return $data;
    }

    public function filter(Request $request): array
    {
        $batches = $this->batchRepository->get($request->all(), ['oldAgency', 'status', 'entries', 'checkers'], ['judgments']);

        $batches = $batches->filter(function ($batch) {
            $foldersWaitingCount = 0;
            $filesWaitingCount = 0;
            $judgmentFolders = getLeafFolderPathsWithFilesFast($batch->folder_path);

            foreach ($judgmentFolders as $judgmentFolder) {
                $judgment = $this->judgmentRepository->getByBatchFolderPath($batch->id, $judgmentFolder['folder_path']);
                if (!isset($judgment->id)) {
                    $foldersWaitingCount++;
                    $filesWaitingCount += $judgmentFolder['files_count'];
                }
            }

            if ($foldersWaitingCount > 0) {
                $batch->folders_waiting_count = $foldersWaitingCount;
                $batch->files_waiting_count  = $filesWaitingCount;
                return true;
            }
            return false;
        })->values();

        $data = $request->all();
        $data['batches'] = $batches;
        return $data;
    }

    public function handle(string|int $id, Request $request): array
    {
        $batch = $this->batchRepository->find($id, ['entries', 'checkers']);
        $entryIds = $batch->entries->pluck('id')->toArray();
        $checkerIds = $batch->checkers->pluck('id')->toArray();

        if (!$entryIds) {
            return [
                'status' => false,
                'message' => __('app.message.no_information_found', ['name' => __('app.batch_entry')])
            ];
        }
        if (!$checkerIds) {
            return [
                'status' => false,
                'message' => __('app.message.no_information_found', ['name' => __('app.batch_checker')])
            ];
        }

        $judgmentFolders = getLeafFolderPathsWithFilesFast($batch->folder_path);
        $entryKey = 0;
        $checkerKey = 0;
        foreach ($judgmentFolders as $judgmentFolder) {
            $judgment = $this->judgmentRepository->getByBatchFolderPath($batch->id, $judgmentFolder['folder_path']);
            if (!isset($judgment->id)) {
                $entryArr = circularNextInArray($entryIds, $entryKey);
                $checkerArr = circularNextInArray($checkerIds, $checkerKey);

                if ($checkerArr['value'] == $entryArr['value']) {
                    $checkerArr = circularNextInArray($checkerIds, $checkerArr['key']);
                }

                $entryKey = $entryArr['key'];
                $checkerKey = $checkerArr['key'];

                $createJudgmentData = [
                    'folder_path' => $judgmentFolder['folder_path'],
                    'batch_id' => $batch->id,
                    'is_after_merge' => 0,
                    'status_id' => env('APP_DEFAULT_JUDGMENT_STATUS_ID'),
                    'type_id' => $batch->type_id,
                    'entry_id' => $entryArr['value'],
                    'checker_id' => $checkerArr['value'],
                ];
                $judgment = $this->judgmentRepository->create($createJudgmentData);

                $files = getPdfFilesInfoInFolder($judgmentFolder['folder_path']);

                foreach ($files as $file) {
                    $createDocumentJudgmentData = [
                        'judgment_id' => $judgment->id,
                        'status_id' => env('APP_DEFAULT_JUDGMENT_STATUS_ID'),
                        'file_path' => $file['file_path'],
                        'sheets_count' => $file['sheets_count'],
                        'pages_count' => $file['pages_count'],
                        'file_size' => $file['file_size'],
                        'note' => __('app.create'),
                    ];
                    $judgmentDocument = $this->judgmentDocumentRepository->create($createDocumentJudgmentData);
                    $judgmentDocument->itemNotes()->create([
                        'status_id' => env('APP_DEFAULT_JUDGMENT_STATUS_ID'),
                        'note' => __('app.create'),
                        'created_by_id' => session('user_id'),
                        'created_by_type' =>  User::class
                    ]);
                }
            }
        }
        return ['status' => true];
    }
}
