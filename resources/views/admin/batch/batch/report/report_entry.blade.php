<div class="table-responsive report-entry-table">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th rowspan="2" class="w-40px">#</th>
            <th rowspan="2">{{ __('app.name') }}</th>
            <th colspan="3">{{ __('app.judgment') }}</th>
            <th colspan="3">{{ __('app.attribute') }}</th>
        </tr>
        <tr>
            <th>{{ __('app.check') }} {{ __('app.done') }} (<= 5%)</th>
            <th>{{ __('app.check') }} {{ __('app.error') }} (> 5%)</th>
            <th>{{ __('app.entried') }}</th>

            <th>{{ __('app.true') }}</th>
            <th>{{ __('app.false') }}</th>
            <th>{{ __('app.done') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batch?->entries as $ie => $entry)
            <tr>
                <td class="text-center">{{ $ie+1 }}</td>
                <td class="text-nowrap">{{ $entry->name }}</td>

                <td class="text-center text-nowrap">
                    {{ numberFormat($entry->check_number_done_rates_count ?? 0) }}
                    /
                    {{ numberFormat($entry->check_judgments_count ?? 0) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat(($entry->check_judgments_count ?? 0) - ($entry->check_number_done_rates_count ?? 0)) }}
                    /
                    {{ numberFormat($entry->check_judgments_count ?? 0) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($entry->entry_judgments_count ?? 0) }}
                    /
                    {{ numberFormat($entry->judgments_count ?? 0) }}
                </td>

                <td class="text-center text-nowrap">
                    {{ numberFormat(($entry->entry_number_sum ?? 0) - ($entry->check_number_error_sum ?? 0)) }}
                    /
                    {{ numberFormat($entry->entry_number_sum ?? 0) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($entry->check_number_error_sum ?? 0) }}
                    /
                    {{ numberFormat($entry->entry_number_sum ?? 0) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($entry->entry_number_done_sum ?? 0) }}
                    /
                    {{ numberFormat($entry->entry_number_sum ?? 0) }}
                </td>
            </tr>
        @endforeach
        @if($batch?->entries)
            <tr class="text-center">
                <td colspan="2">Tổng số</td>
                <td>
                    {{ numberFormat($batch?->entries?->sum('check_number_done_rates_count') ?? 0) }}
                    /
                    {{ numberFormat($batch?->entries?->sum('check_judgments_count') ?? 0) }}</td>
                <td class="text-center">
                    {{ numberFormat(($batch?->entries?->sum('check_judgments_count') ?? 0) - ($batch?->entries?->sum('check_number_done_rates_count') ?? 0)) }}
                    /
                    {{ numberFormat($batch?->entries?->sum('check_judgments_count') ?? 0) }}
                </td>
                <td class="text-center">
                    {{ numberFormat($batch?->entries?->sum('entry_judgments_count') ?? 0) }}
                    /
                    {{ numberFormat($batch?->entries?->sum('judgments_count') ?? 0) }}
                </td>

                <td class="text-center">
                    {{ numberFormat(($batch?->entries?->sum('entry_number_sum') ?? 0) - ($batch?->entries?->sum('check_number_error_sum') ?? 0)) }}
                    /
                    {{ numberFormat($batch?->entries?->sum('entry_number_sum') ?? 0) }}
                </td>
                <td class="text-center">
                    {{ numberFormat($batch?->entries?->sum('check_number_error_sum') ?? 0) }}
                    /
                    {{ numberFormat($batch?->entries?->sum('entry_number_sum') ?? 0) }}
                </td>
                <td class="text-center">
                    {{ numberFormat($batch?->entries?->sum('entry_number_done_sum') ?? 0) }}
                    /
                    {{ numberFormat($batch?->entries?->sum('entry_number_sum') ?? 0) }}
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

{!! renderPagination($batch?->entries) !!}

{!! renderSearchEmpty($batch?->entries) !!}
