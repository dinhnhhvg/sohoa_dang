<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr class="text-center text-nowrap">
            <th class="w-40px">#</th>
            <th>{{ __('app.name') }}</th>
            <th>{{ __('app.judgment') }}</th>
            <th>{{ __('app.judgment_document') }}</th>
            <th>{{ __('app.page') }}</th>
            <th>{{ __('app.sheet') }}</th>
            <th>{{ __('app.size') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $i => $type)
            <tr class="text-center">
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ __('app.'.$type->name) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($type->report->judgments_count) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($type->report->judgment_documents_count) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($type->report->pages_sum) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($type->report->sheets_sum) }}</td>
                <td class="text-center text-nowrap">{{ formatSizeUnit($type->report->file_size_sum) }}</td>
            </tr>
        @endforeach
        @if(count($types))
            <tr>
                <td></td>
                <td class="text-center text-nowrap">{{ __('app.total') }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($totalReport['judgments_count']) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($totalReport['judgment_documents_count']) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($totalReport['pages_sum']) }}</td>
                <td class="text-center text-nowrap">{{ numberFormat($totalReport['sheets_sum']) }}</td>
                <td class="text-center text-nowrap">{{ formatSizeUnit($totalReport['file_size_sum']) }}</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

{!! renderPagination($types) !!}

{!! renderSearchEmpty($types) !!}
