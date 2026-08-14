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
        @foreach($users as $iu => $user)
            <tr>
                <td class="text-center">{{ $iu+1 }}</td>
                <td class="text-nowrap">{{ $user->name }}</td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($user->entry_judgments_count) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($user->entry_number_sum) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($user->check_judgments_count) }}
                </td>
                <td class="text-center text-nowrap">
                    {{ numberFormat($user->check_number_sum) }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($users) !!}

{!! renderSearchEmpty($users) !!}
