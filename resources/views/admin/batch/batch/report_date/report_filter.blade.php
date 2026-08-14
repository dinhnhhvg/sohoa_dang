<div class="table-responsive report-date-filter-table">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th rowspan="2" class="w-40px">#</th>
            <th rowspan="2">{{ __('app.name') }}</th>
            <th colspan="3">{{ __('app.entry') }}</th>
            <th colspan="3">{{ __('app.check') }}</th>
        </tr>
        <tr>
            <th>{{ __('app.quantity') }}</th>
            <th>{{ __('app.attribute') }}</th>

            <th>{{ __('app.quantity') }}</th>
            <th>{{ __('app.attribute') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($batch?->users as $iu => $user)
            <tr>
                <td class="text-center">{{ $iu+1 }}</td>
                <td class="text-nowrap">{{ $user->name }}</td>

                @if($user->entry_judgments_count)
                    <td class="text-center text-nowrap">
                        {{ numberFormat($user->entry_judgments_count) }}
                    </td>
                    <td class="text-center text-nowrap">
                        {{ numberFormat($user->entry_number_sum) }}
                    </td>
                @else
                    <td colspan="3"></td>
                @endif

                @if($user->check_judgments_count)
                    <td class="text-center text-nowrap">
                        {{ numberFormat($user->check_judgments_count) }}
                    </td>
                    <td class="text-center text-nowrap">
                        {{ numberFormat($user->check_number_sum) }}
                    </td>
                @else
                    <td colspan="3"></td>
                @endif
            </tr>
        @endforeach
        @if($batch?->users)
            <tr class="text-center">
                <td colspan="2">Tổng số</td>
                <td class="text-center">
                    {{ numberFormat($batch?->users?->sum('entry_judgments_count')) }}
                </td>
                <td class="text-center">
                    {{ numberFormat($batch?->users?->sum('entry_number_sum')) }}
                </td>
                <td class="text-center">
                    {{ numberFormat($batch?->users?->sum('check_judgments_count')) }}
                </td>
                <td class="text-center">
                    {{ numberFormat($batch?->users?->sum('check_number_sum')) }}
                </td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

{!! renderPagination($batch?->users) !!}

{!! renderSearchEmpty($batch?->users) !!}
