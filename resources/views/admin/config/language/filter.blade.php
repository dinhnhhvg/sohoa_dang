<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.code'), 'languages.code', $orderByName, $orderByType) !!}</th>
            <th>{!! renderThSort(__('app.name'), 'languages.name', $orderByName, $orderByType) !!}</th>
            <th>{{ __('locale') }}</th>
            <th>{{ __('app.description') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($languages as $i => $language)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-nowrap text-center">{{ $language->code }}</td>
                <td class="text-nowrap text-center">
                    @if(in_array($language->locale, $locales))
                        <a href="{{ route('admin.language.show', ['locale' => $language->locale]) }}" title="{{ __('app.edit') }}">
                            {{ $language->name }}
                        </a>
                    @else
                        {{ $language->name }}
                    @endif
                </td>
                <td class="text-nowrap">{{ $language->locale }}</td>
                <td>{{ $language->description }}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.language.edit', ['language' => $language->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    @if(in_array($language->locale, $locales))
                        <a href="{{ route('admin.language.show', ['locale' => $language->locale]) }}" class="btn btn-sm btn-primary mb-1" title="{{ __('app.edit') }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    @endif
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.language.destroy', ['language' => $language->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($languages) !!}

{!! renderSearchEmpty($languages) !!}
