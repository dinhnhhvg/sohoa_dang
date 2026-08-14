<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'campaign.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'campaign.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.sale') }}</th>
            <th>{!! renderThSort(__('app.start_date'), 'campaign.start_date', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.end_date'), 'campaign.end_date', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.customer'), 'campaign_customers_count', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($campaigns as $i => $campaign)
            <tr class="{{ $campaign->is_active ? '' : 'bg-inactive' }}">
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $campaign->code }}</td>
                <td class="text-center text-nowrap">
                    <a href="{{ route('admin.campaign.detail', ['campaign' => $campaign->id]) }}">
                        <strong>{{ $campaign->name }}</strong>
                    </a>
                </td>
                <td class="text-center">
                    @foreach($campaign->sales as $sale)
                        <span class="badge bg-success">{{ $sale->name }}</span>
                    @endforeach
                </td>
                <td class="text-center text-nowrap">{{ $campaign->start_date?->format('d-m-Y') }}</td>
                <td class="text-center text-nowrap">{{ $campaign->end_date?->format('d-m-Y') }}</td>
                <td class="text-center">{{ $campaign->campaign_customers_count ?? 0 }}</td>
                <td class="text-center">{!! renderIsActive($campaign->is_active) !!}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.campaign.edit', ['campaign' => $campaign->id]) }}', '#common-modal-xl')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.campaign.detail', ['campaign' => $campaign->id]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.detail') }}">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                       onclick="commonToggleActive('{{ route('admin.campaign.update', ['campaign' => $campaign->id]) }}', {{ $campaign->is_active }})">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.campaign.destroy', ['campaign' => $campaign->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($campaigns) !!}

{!! renderSearchEmpty($campaigns) !!}
