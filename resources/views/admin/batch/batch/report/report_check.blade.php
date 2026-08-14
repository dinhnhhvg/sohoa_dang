<div class="table-responsive report-check-table">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.name') }}</th>
            <th>{{ __('app.judgment') }}</th>
            <th>{{ __('app.attribute') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batch?->checkers as $ic => $checker)
            <tr>
                <td class="text-center">{{ $ic+1 }}</td>
                <td>{{ $checker->name }}</td>
                <td class="text-center">
                    {{ $checker->check_judgments_count ?? 0 }}
                    /
                    {{ $checker->judgments_count ?? 0 }}
                </td>
                <td class="text-center">
                    {{ $checker->check_number_sum ?? 0 }}
                    /
                    {{ $checker->entry_number_sum ?? 0 }}
                </td>
            </tr>
        @endforeach
        @if($batch->entries)
            <tr class="text-center">
                <td colspan="2">Tổng số</td>
                <td>
                    {{ $batch?->checkers?->sum('entry_judgments_count') ?? 0 }}
                    /
                    {{ $batch?->entries?->sum('judgments_count') ?? 0 }}
                </td>
                <td>
                    {{ $batch?->checkers?->sum('check_number_sum') ?? 0 }}
                    /
                    {{ $batch?->checkers?->sum('entry_number_sum') ?? 0 }}
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

{!! renderPagination($batch?->checkers) !!}

{!! renderSearchEmpty($batch?->checkers) !!}
