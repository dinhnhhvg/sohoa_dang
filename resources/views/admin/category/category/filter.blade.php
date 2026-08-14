<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100" data-sticky-column="2">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{{ __('app.code') }}</th>
            <th>{{ __('app.name') }}</th>
            <th>{{ __('app.module') }}</th>
            <th>{{ __('app.category') }}</th>
            <th>{{ __('app.topic') }}</th>
            <th>{{ __('app.is_active') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $i => $category)
            <tr class="{{ $category->is_active ? '' : 'bg-inactive' }}">
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $category->code }}</td>
                <td class="text-center text-nowrap">{{ $category->name }}</td>
                <td class="text-center text-nowrap">{{ __('app.'.$category->module) }}</td>
                <td class="text-center text-nowrap">{{ $category->parent?->name }}</td>
                <td class="text-center">
                    @foreach($category->topics as $topic)
                        <span class="badge badge-hover bg-success">
                            {{ $topic->name }}
                            <span class="badge-action ps-2 text-nowrap">
                                <a href="javascript:void(0)" class="pe-1" title="{{ __('app.edit') }}"
                                   onclick="commonShowModal('{{ route('admin.topic.edit', ['topic' => $topic->id]) }}')">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="commonDelete('{{ route('admin.topic.destroy', ['topic' => $topic->id]) }}')" title="{{ __('app.delete') }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </span>
                        </span>
                    @endforeach
                    <span class="badge bg-success">
                        <a href="javascript:void(0)" class="text-white" title="{{ __('app.create') }}"
                           onclick="commonShowModal('{{ route('admin.topic.create', ['category_id' => $category->id]) }}')">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </span>
                </td>
                <td class="text-center">{!! renderIsActive($category->is_active) !!}</td>
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.category.edit', ['category' => $category->id]) }}')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                       onclick="commonToggleActive('{{ route('admin.category.update', ['category' => $category->id]) }}', {{ $category->is_active }})">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.category.destroy', ['category' => $category->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($categories) !!}

{!! renderSearchEmpty($categories) !!}
