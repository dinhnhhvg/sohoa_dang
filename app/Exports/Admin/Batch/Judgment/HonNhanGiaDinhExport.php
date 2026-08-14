<?php

namespace App\Exports\Admin\Batch\Judgment;

use App\Exports\BaseExport;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class HonNhanGiaDinhExport extends BaseExport implements WithEvents
{
    public function headings(): array
    {
        return $this->buildHeaderRowsAndMerges()['rows'];
    }

    public function map(mixed $row): array
    {
        if (isset($row->defendant) && !empty((array)$row->defendant)) {
            $defendantData = [
                $row->defendant->maritalStatus?->name,
                $row->defendant->content_summary,
                $row->defendant->total_court_fee,
                $row->defendant->court_fee_status,
                renderManyName($row->defendant->legalRelationships),
                $row->defendant->litigationStatus?->name,
                $row->defendant->full_name,
                $row->defendant->alias_name,
                renderCodeName($row->defendant->identityDocument),
                $row->defendant->identity_number,
                $row->defendant->identity_created_date?->format('d/m/Y'),
                $row->defendant->identity_expiry_date?->format('d/m/Y'),
                renderGender($row->defendant->gender),
                $row->defendant->birth_date?->format('d/m/Y'),
                renderManyName($row->defendant->nationalities, true),
                $row->defendant->ethnicity?->name,
                $row->defendant->religion?->name,
                renderCodeName($row->defendant->permanentOldProvince),
                renderCodeName($row->defendant->permanentOldDistrict),
                renderCodeName($row->defendant->permanentOldWard),
                $row->defendant->permanent_address,
                renderCodeName($row->defendant->hometownOldProvince),
                renderCodeName($row->defendant->hometownOldDistrict),
                renderCodeName($row->defendant->hometownOldWard),
                $row->defendant->hometown_address,
                renderCodeName($row->defendant->foreignIdentityDocument),
                $row->defendant->foreign_identity_number,
                $row->defendant->marriage_certificate_number
            ];

        } else {
            $defendantData = [];
            for ($i = 0; $i < 28; $i++) {
                $defendantData[] = '';
            }
        }

        return [
            renderCodeName($row->judgment?->language),
            $row->judgment?->judgmentDocuments?->sum('sheets_count'),
            renderCodeName($row->judgment?->physicalCondition),
            $row->judgment?->description,
            $row->judgmentType?->name,
            $row->documentType?->name,
            renderManyName($row->languages, true),
            $row->sheets_count,
            renderCodeName($row->physicalCondition),
            $row->description,
            getEndName($row->file_path, 'CSDL/'),
            $row->normalized_number,
            $row->original_symbol,
            $row->issued_date?->format('d/m/Y'),
            renderCodeName(in_array($row->judgment_type_id, [4]) ? $row->judgment?->batch?->oldAgency : $row->oldAgency),
            renderCodeName($row->police),
            renderCodeName($row->procuracy),
            in_array($row->judgment_type_id, [4]) ? '' : $row->issuer_name,
            $row->effective_date?->format('d/m/Y'),
            $row->documentRelations?->first()?->normalized_number,
            $row->documentRelations?->first()?->issued_date?->format('d/m/Y'),
            renderCodeName($row->documentRelations->first()?->oldAgency),
            ...$defendantData
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $header = $this->buildHeaderRowsAndMerges();
                $lastColumn = Coordinate::stringFromColumnIndex(count($header['rows'][0]));
                $highestRow = $sheet->getHighestRow();

                foreach ($header['merges'] as $range) {
                    $sheet->mergeCells($range);
                }

                $sheet->getStyle('A1:'.$lastColumn.'3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                ]);

                foreach (range(1, 3) as $row) {
                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }

                $sheet->getStyle('A4:'.$lastColumn.$highestRow)->applyFromArray([
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                        'wrapText' => true,
                    ],
                ]);

                foreach (range(4, $highestRow) as $row) {
                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }

                foreach ($this->headerColumnWidths($header['rows']) as $column => $width) {
                    $sheet->getColumnDimension($column)->setWidth($width);
                }
            },
        ];
    }

    private function buildHeaderRowsAndMerges(): array
    {
        $tree = $this->headerTree();
        $columnCount = $this->countLeafNodes($tree);
        $rows = array_fill(0, 3, array_fill(0, $columnCount, ''));
        $merges = [];
        $columnIndex = 1;

        foreach ($tree as $node) {
            $columnIndex = $this->appendHeaderNode($node, 1, $columnIndex, $rows, $merges);
        }

        return [
            'rows' => $rows,
            'merges' => $merges,
        ];
    }

    private function headerTree(): array
    {
        return [
            [
                'label' => __('app.information').' '.__('app.judgment'),
                'children' => [
                    ['label' => __('app.language')],
                    ['label' => __('app.sheet')],
                    ['label' => __('app.physical_condition')],
                    ['label' => __('app.description')],
                ],
            ],
            [
                'label' => __('app.judgment_decision_information'),
                'children' => [
                    ['label' => __('app.judgment_type')],
                    ['label' => __('app.document_type')],
                    ['label' => __('app.language')],
                    ['label' => __('app.sheet')],
                    ['label' => __('app.physical_condition')],
                    ['label' => __('app.description')],
                    ['label' => __('app.file_path')],
                    ['label' => __('app.normalized_number')],
                    ['label' => __('app.original_symbol')],
                    ['label' => __('app.issued_date')],
                    [
                        'label' => 'Tên cơ quan ban hành Bản án/Quyết định/Tài liệu',
                        'children' => [
                            ['label' => 'Đơn vị Tòa án ban hành'],
                            ['label' => 'Đơn vị Công an ban hành'],
                            ['label' => 'Đơn vị Viện kiểm sát ban hành'],
                        ],
                    ],
                    ['label' => 'Tên tổ chức/ cá nhân ban hành Bản án/Quyết định/Tài liệu'],
                    ['label' => __('app.effective_date')],
                    [
                        'label' => 'Bản án/Quyết định liên quan',
                        'children' => [
                            ['label' => __('app.related_number')],
                            ['label' => __('app.related_date')],
                            ['label' => 'Tòa án ban hành'],
                        ],
                    ],
                ],
            ],
            ['label' => __('app.marital_status')],
            ['label' => __('app.content_summary')],
            [
                'label' => '',
                'children' => [
                    ['label' => __('app.court_fee')],
                    ['label' => __('app.court_fee_status')],
                    ['label' => __('app.legal_relationship')],
                    ['label' => __('app.litigation_status')],
                ]
            ],
            [
                'label' => 'CMND, CCCD, '.__('app.passport').', '.__('app.household_registration'),
                'children' => [
                    ['label' => __('app.full_name')],
                    ['label' => __('app.alias_name')],
                    ['label' => __('app.identity_document')],
                    ['label' => __('app.identity_number')],
                    ['label' => __('app.identity_created_date')],
                    ['label' => __('app.identity_expiry_date')],
                    ['label' => __('app.gender')],
                    ['label' => __('app.birth_date')],
                    ['label' => __('app.nationality')],
                    ['label' => __('app.ethnicity')],
                    ['label' => __('app.religion')],
                    [
                        'label' => __('app.permanent'),
                        'children' => [
                            ['label' => __('app.province')],
                            ['label' => __('app.district')],
                            ['label' => __('app.ward')],
                            ['label' => __('app.address')],
                        ],
                    ],
                    [
                        'label' => __('app.hometown'),
                        'children' => [
                            ['label' => __('app.province')],
                            ['label' => __('app.district')],
                            ['label' => __('app.ward')],
                            ['label' => __('app.address')],
                        ],
                    ],
                    [
                        'label' => __('app.foreign_document_number'),
                        'children' => [
                            ['label' => __('app.identity_document')],
                            ['label' => __('app.identity_number')],
                        ],
                    ],
                ],
            ],
            ['label' => __('app.marriage_certificate_number')]
        ];
    }

    private function appendHeaderNode(array $node, int $depth, int $columnIndex, array &$rows, array &$merges): int
    {
        $span = $this->countLeafNodes([$node]);
        $startColumn = $columnIndex;
        $endColumn = $startColumn + $span - 1;
        $rows[$depth - 1][$startColumn - 1] = $node['label'] ?? '';

        if (! empty($node['children'])) {
            if ($span > 1) {
                $merges[] = $this->columnRange($startColumn, $depth, $endColumn, $depth);
            }

            foreach ($node['children'] as $child) {
                $columnIndex = $this->appendHeaderNode($child, $depth + 1, $columnIndex, $rows, $merges);
            }

            return $columnIndex;
        }

        if ($depth < 3) {
            $merges[] = $this->columnRange($startColumn, $depth, $startColumn, 3);
        }

        return $columnIndex + 1;
    }

    private function countLeafNodes(array $nodes): int
    {
        $count = 0;

        foreach ($nodes as $node) {
            if (empty($node['children'])) {
                $count++;
                continue;
            }

            $count += $this->countLeafNodes($node['children']);
        }

        return $count;
    }

    private function columnRange(int $startColumn, int $startRow, int $endColumn, int $endRow): string
    {
        return Coordinate::stringFromColumnIndex($startColumn).$startRow.':'.Coordinate::stringFromColumnIndex($endColumn).$endRow;
    }

    private function headerColumnWidths(array $rows): array
    {
        $widths = [];
        $columnCount = count($rows[0]);

        for ($columnIndex = 1; $columnIndex <= $columnCount; $columnIndex++) {
            $maxLength = 0;

            foreach ($rows as $row) {
                $label = trim((string) ($row[$columnIndex - 1] ?? ''));
                if ($label === '') {
                    continue;
                }

                $maxLength = max($maxLength, mb_strlen($label));
            }

            $widths[Coordinate::stringFromColumnIndex($columnIndex)] = max(10, min($maxLength + 2, 24));
        }

        return $widths;
    }
}
