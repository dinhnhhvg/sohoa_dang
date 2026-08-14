<?php

namespace App\Services\Admin;

use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class TypeService extends BaseService
{
    public function __construct(
        protected TypeRepository $typeRepository,
    )
    {
        parent::__construct($typeRepository);
    }

    public function reportBatch(Request $request): array
    {
        $types = $this->typeRepository->reportBatch($request->all());

        $totalReport = [
            'judgments_count' => 0,
            'judgment_documents_count' => 0,
            'defendants_count' => 0,
            'defendant_infos_count' => 0,
            'sheets_sum' => 0,
            'pages_sum' => 0,
            'file_size_sum' => 0
        ];

        foreach ($types as $type) {
            $report = [
                'judgments_count' => $type->batches->sum('judgments_count'),
                'judgment_documents_count' => $type->batches->sum('judgment_documents_count'),
                'defendants_count' => $type->batches->sum('defendants_count'),
                'defendant_infos_count' => $type->batches->sum('defendant_infos_count'),
                'sheets_sum' => $type->batches->sum('sheets_sum'),
                'pages_sum' => $type->batches->sum('pages_sum'),
                'file_size_sum' => $type->batches->sum('file_size_sum')
            ];
            $type->report = (object) $report;

            $totalReport['judgments_count'] += $report['judgments_count'];
            $totalReport['judgment_documents_count'] += $report['judgment_documents_count'];
            $totalReport['defendants_count'] += $report['defendants_count'];
            $totalReport['defendant_infos_count'] += $report['defendant_infos_count'];
            $totalReport['sheets_sum'] += $report['sheets_sum'];
            $totalReport['pages_sum'] += $report['pages_sum'];
            $totalReport['file_size_sum'] += $report['file_size_sum'];
        }

        $data = $request->all();
        $data['types'] = $types;
        $data['totalReport'] = $totalReport;
        return $data;
    }
}
