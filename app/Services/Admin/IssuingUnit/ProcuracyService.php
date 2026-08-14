<?php

namespace App\Services\Admin\IssuingUnit;

use App\Exports\Admin\ProcuracyExport;
use App\Http\Requests\Admin\IssuingUnit\Procuracy\StoreRequest;
use App\Repositories\ProcuracyRepository;
use App\SampleExports\ProcuracySampleExport;
use App\Services\Admin\Log\ImportLogService;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProcuracyService extends BaseService
{
    public function __construct(
        protected ProcuracyRepository $procuracyRepository,
        protected ImportLogService $importLogService,
    )
    {
        parent::__construct($procuracyRepository);
    }

    public function downloadImport(): BinaryFileResponse
    {
        return Excel::download(new ProcuracySampleExport(), 'procuracies.xlsx');
    }

    public function storeImport(Request $request): array|null
    {
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

            $this->procuracyRepository->create($createData);

            $logData[] = [
                'status' => true,
                'name' => __('app.row') . ' ' . $i + 1,
                'value' => $row,
                'message' => __('app.message.create_success')
            ];
        }

        $importLog = $this->importLogService->storeImportLog('procuracy', $request->input('file_path'), $logData);
        return [
            'status' => true,
            'url' => route('admin.import_log.show', ['import_log' => $importLog->id])
        ];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->procuracyRepository->get($request->all());
        return Excel::download(new ProcuracyExport($data), 'procuracies.xlsx');
    }
}
