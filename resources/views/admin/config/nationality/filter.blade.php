<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.flag') }}</th>
            <th>{!! renderThSort(__('app.code'), 'nationalities.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'nationalities.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('app.description') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($nationalities as $i => $nationality)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center">
                    @if($nationality->flag)
                        <img src="{{ asset($nationality->flag) }}" alt="flag" class="w-40px">
                    @endif
                </td>
                <td class="text-nowrap text-center">{{ $nationality->code }}</td>
                <td class="text-nowrap text-center">{{ $nationality->name }}</td>
                <td>{{ $nationality->description }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.nationality.edit', ['nationality' => $nationality->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.nationality.destroy', ['nationality' => $nationality->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($nationalities) !!}

{!! renderSearchEmpty($nationalities) !!}
