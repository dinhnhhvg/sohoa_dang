<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">#</th>
            <th>{!! renderThSort(__('app.name'), 'attributes.name', $orderByName, $orderByType) !!}</th>
            <th class="min-w-220px">{{ __('app.description') }}</th>
            <th>{{ __('app.category') }}</th>
            <th>{{ __('app.value') }}</th>
            <th class="min-w-100px">{{ __('app.action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attributes as $i => $attribute)
            @php
                $rows = count($attribute->categoryAttributes);
                $categoryAttributeFirst = $attribute->categoryAttributes?->first();
                $values = $categoryAttributeFirst->valuesByCategory($categoryAttributeFirst->category_id)->get();
            @endphp
            <tr>
                <td class="text-center" rowspan="{{ $rows }}">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap" rowspan="{{ $rows }}">{{ $attribute->name }}</td>
                <td rowspan="{{ $rows }}">{{ $attribute->description }}</td>
                <td>{{ $categoryAttributeFirst?->category?->name }}</td>
                <td class="text-center">
                    @if($values)
                        @foreach($values as $value)
                            <span class="badge badge-hover bg-success">
                                {{ $value->name }}
                                <span class="badge-action ps-2 text-nowrap">
                                    <a href="javascript:void(0)" class="pe-1" title="{{ __('app.edit') }}"
                                       onclick="commonShowModal('{{ route('admin.attribute_value.edit', ['attribute_value' => $value->id]) }}')">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="commonDelete('{{ route('admin.attribute_value.destroy', ['attribute_value' => $value->id]) }}')" title="{{ __('app.delete') }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </span>
                            </span>
                        @endforeach
                    @endif
                    <span class="badge bg-success">
                        <a href="javascript:void(0)" class="text-white" title="{{ __('app.create') }}"
                           onclick="commonShowModal('{{ route('admin.attribute_value.create', ['category_id' => $attribute->categoryAttributes->first()->category->id, 'attribute_id' => $attribute->id]) }}')">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </span>
                </td>
                <td class="text-center" rowspan="{{ $rows }}">
                    <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                       onclick="commonShowModal('{{ route('admin.attribute.edit', ['attribute' => $attribute->id]) }}', '#common-modal-lg')">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                       onclick="commonDelete('{{ route('admin.attribute.destroy', ['attribute' => $attribute->id]) }}')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
            </tr>
            @foreach($attribute->categoryAttributes as $i2 => $categoryAttribute)
                @if($i2 > 0)
                    <tr>
                        <td>{{ $categoryAttribute->category->name }}</td>
                        <td class="text-center">
                            @foreach($categoryAttribute->valuesByCategory($categoryAttribute->category_id)->get() as $value)
                                <span class="badge badge-hover bg-success">
                                    {{ $value->name }}
                                    <span class="badge-action ps-2 text-nowrap">
                                        <a href="javascript:void(0)" class="pe-1" title="{{ __('app.edit') }}"
                                           onclick="commonShowModal('{{ route('admin.attribute_value.edit', ['attribute_value' => $value->id]) }}')">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="commonDelete('{{ route('admin.attribute_value.destroy', ['attribute_value' => $value->id]) }}')" title="{{ __('app.delete') }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </span>
                                </span>
                            @endforeach
                            <span class="badge bg-success">
                                <a href="javascript:void(0)" class="text-white" title="{{ __('app.create') }}"
                                   onclick="commonShowModal('{{ route('admin.attribute_value.create', ['category_id' => $categoryAttribute->category->id, 'attribute_id' => $attribute->id]) }}')">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($attributes) !!}

{!! renderSearchEmpty($attributes) !!}
