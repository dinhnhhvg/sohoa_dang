<?php

namespace App\Services\Admin\Config;

use App\Exports\Admin\Batch\ConfigExport;
use App\Http\Requests\Admin\Config\Config\StoreRequest;
use App\Repositories\ConfigRepository;
use App\Repositories\JudgmentDocumentRepository;
use App\SampleExports\ConfigSampleExport;
use App\Services\Admin\Log\ImportLogService;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ConfigService extends BaseService
{
    public function __construct(
        protected ConfigRepository $configRepository,
        protected ImportLogService $importLogService,
        protected JudgmentDocumentRepository $judgmentDocumentRepository
    )
    {
        parent::__construct($configRepository);
    }

    public function downloadImport(): BinaryFileResponse
    {
        return Excel::download(new ConfigSampleExport(), 'export.xlsx');
    }

    public function storeImport(Request $request): array|null
    {
        // Old code
        $module = str_replace('-', '_', request()->segment(2));

        $sheets = Excel::toArray((object)[], public_path($request->input('file_path')));
        $sheet = $sheets[0] ?? [];

        $rules = (new StoreRequest())->rules();

        $logData = [];
        foreach ($sheet as $i => $row) {
            if ($i == 0) {
                continue;
            }

            $row = cleanExcelValue($row, 3);
            $createData = [
                'module' => $module,
                'code' => $row[0],
                'name' => $row[1],
                'description' => $row[2]
            ];

            $validator = Validator::make($createData, $rules);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $logData[] = [
                    'status' => false,
                    'name' => __('app.row') . ' ' . $i + 1,
                    'value' => $row,
                    'message' => $errors[0] ?? ''
                ];
                continue;
            }

            $this->configRepository->create($createData);

            $logData[] = [
                'status' => true,
                'name' => __('app.row') . ' ' . $i + 1,
                'value' => $row,
                'message' => __('app.message.create_success')
            ];
        }

        $importLog = $this->importLogService->storeImportLog($module, $request->input('file_path'), $logData);
        return [
            'status' => true,
            'url' => route('admin.import_log.show', ['import_log' => $importLog->id])
        ];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $filters = $request->all();
        $filters['module'] = str_replace('-', '_', request()->segment(2));
        $data = $this->configRepository->get($filters);
        return Excel::download(new ConfigExport($data), 'export.xlsx');
    }
}
