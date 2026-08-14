<?php

namespace App\Services\Admin\IssuingUnit;

use App\Exports\Admin\PoliceExport;
use App\Http\Requests\Admin\IssuingUnit\Police\StoreRequest;
use App\Repositories\PoliceRepository;
use App\SampleExports\PoliceSampleExport;
use App\Services\Admin\Log\ImportLogService;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PoliceService extends BaseService
{
    public function __construct(
        protected PoliceRepository $policeRepository,
        protected ImportLogService $importLogService
    )
    {
        parent::__construct($policeRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['polices'] = $this->policeRepository->get($request->all());
        return $data;
    }

    public function downloadImport(): BinaryFileResponse
    {
        return Excel::download(new PoliceSampleExport(), 'polices.xlsx');
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

            $this->policeRepository->create($createData);

            $logData[] = [
                'status' => true,
                'name' => __('app.row') . ' ' . $i + 1,
                'value' => $row,
                'message' => __('app.message.create_success')
            ];
        }

        $importLog = $this->importLogService->storeImportLog('police', $request->input('file_path'), $logData);
        return [
            'status' => true,
            'url' => route('admin.import_log.show', ['import_log' => $importLog->id])
        ];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->policeRepository->get($request->all());
        return Excel::download(new PoliceExport($data), 'polices.xlsx');
    }
}
