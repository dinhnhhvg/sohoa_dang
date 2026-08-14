<?php

namespace App\Exports\Admin\Batch\Judgment;

use App\Exports\BaseExport;

class DangExport extends BaseExport
{
    public function headings(): array
    {
        return [
            [
                '#',
                __('app.font_name'),
                __('app.font_number'),
                __('app.tenure_period'),
                __('app.table_of_contents_number'),
                __('app.box_number'),
                __('app.dossier_number'),
                __('app.retention_period'),
                __('app.dossier_title'),
                __('app.start_date'),
                __('app.end_date'),
                __('app.judgment_document'),
                __('app.sheet'),
                __('app.page'),
                __('app.agency'),
                __('app.document_number'),
                __('app.document_notation'),
                __('app.issue_date'),
                __('app.document_genre'),
                __('app.document_genre_code'),
                __('app.content_summary'),
                __('app.signer'),
                __('app.confidentiality_level'),
                __('app.copy_type'),
                __('app.page'),
                __('app.keywords'),
                __('app.topic'),
                __('app.original_doc_location'),
                __('app.data_entry_by'),
                __('app.doc_order_in_dossier'),
                __('app.language'),
                __('app.note'),
                __('app.page_number'),
                __('app.info_code'),
                __('app.usage_mode'),
                __('app.handwritten_notes'),
                __('app.physical_condition'),
                __('app.document_type'),
                __('app.file_path'),
                __('app.renamed_file_path'),
            ]
        ];
    }

    public function map(mixed $row): array
    {
        static $i = 0;
        $i++;
        $judgment = $row->judgment;
        $judgment->withSum('judgmentDocuments as sheets_sum', 'sheets_count')
            ->withSum('judgmentDocuments as pages_sum', 'pages_count')
            ->withSum('judgmentDocuments as file_size_sum', 'file_size');

        return [
            $i,
            $judgment->font?->name,
            $judgment->font?->code,
            $judgment->tenurePeriod?->name,
            $judgment->table_of_contents_number,
            $judgment->box_number,
            $judgment->dossier_number,
            $judgment->retentionPeriod?->name,
            $judgment->dossier_title,
            $judgment->start_date?->format('d/m/Y'),
            $judgment->end_date?->format('d/m/Y'),
            $judgment->judgment_documents_count,
            numberFormat($judgment->sheets_sum),
            numberFormat($judgment->pages_sum),
            renderCodeName($row->oldAgency),
            $row->document_number,
            $row->document_notation,
            $row->issue_date?->format('d-m-Y'),
            $row->documentGenre?->name,
            $row->documentGenre?->code,
            $row->content_summary,
            $row->signer,
            $row->confidentialityLevel?->name,
            $row->copyType?->name,
            $row->pages_count,
            $row->keywords,
            $row->topic,
            $row->original_doc_location,
            $row->data_entry_by,
            $row->doc_order_in_dossier,
            renderManyName($row?->languages, true),
            $row->note,
            $row->page_number,
            $row->info_code,
            $row->usageMode?->name,
            $row->handwritten_notes,
            $row->physicalCondition?->name,
            $row->documentType?->name,
            renderStandardPath($row->file_path),
            renderStandardPath($row->renamed_file_path),
        ];
    }
}
