<div class="table-responsive">
    @foreach($menus as $menu)
        <div class="card mb-2 me-5">
            <div class="card-body p-2 {{ $menu->is_active ? 'bg-active' : 'bg-inactive' }}">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="mb-0 text-primary"><strong><i class="{{ $menu->icon }}"></i> {{ $menu->name }}</strong></p>

                    @if(!count($menu->menus))
                        <p class="mb-0">
                            @foreach($menu->actions as $action)
                                <span class="badge badge-hover {{ $action->pivot->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $action->name }}
                                    <span class="badge-action ps-2 text-nowrap">
                                        <a href="javascript:void(0)" class="pe-1" title="{{ __('app.toggle_active') }}"
                                           onclick="commonToggleActive('{{ route('root.menu_action.update', ['menu_action' => $action->pivot->id]) }}', {{ $action->pivot->is_active }})">
                                            <i class="fa-solid fa-power-off"></i>
                                        </a>
                                        <a href="javascript:void(0)" title="{{ __('app.delete') }}"
                                           onclick="commonDelete('{{ route('root.menu_action.destroy', ['menu_action' => $action->pivot->id]) }}')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </span>
                                </span>
                            @endforeach
                        </p>
                    @endif

                    <div>
                        <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                           onclick="commonShowModal('{{ route('root.menu.edit', ['menu' => $menu->id]) }}', '#common-modal-lg')">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('root.menu.update', ['menu' => $menu->id]) }}', {{ $menu->is_active }})">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                           onclick="commonDelete('{{ route('root.menu.destroy', ['menu' => $menu->id]) }}')">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @foreach($menu['menus'] as $subMenu)
            <div class="card mb-2 ms-5">
                <div class="card-body p-2 {{ $subMenu->is_active ? 'bg-active' : 'bg-inactive' }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 text-primary">
                            <strong>
                                @if(!$subMenu->is_menu) <i class="fa-solid fa-eye-low-vision"></i> @endif
                                {{ $subMenu->name }}
                            </strong>
                        </p>

                        <p class="mb-0">
                            @foreach($subMenu->actions as $action)
                                <span class="badge badge-hover {{ $action->pivot->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $action->name }}
                                    <span class="badge-action ps-2 text-nowrap">
                                        <a href="javascript:void(0)" class="pe-1" title="{{ __('app.toggle_active') }}"
                                           onclick="commonToggleActive('{{ route('root.menu_action.update', ['menu_action' => $action->pivot->id]) }}', {{ $action->pivot->is_active }})">
                                            <i class="fa-solid fa-power-off"></i>
                                        </a>
                                        <a href="javascript:void(0)" title="{{ __('app.delete') }}"
                                           onclick="commonDelete('{{ route('root.menu_action.destroy', ['menu_action' => $action->pivot->id]) }}')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </span>
                                </span>
                            @endforeach
                        </p>

                        <div>
                            <a href="javascript:void(0)" class="btn btn-sm btn-success mb-1" title="{{ __('app.edit') }}"
                               onclick="commonShowModal('{{ route('root.menu.edit', ['menu' => $subMenu->id]) }}', '#common-modal-lg')">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                               onclick="commonToggleActive('{{ route('root.menu.update', ['menu' => $subMenu->id]) }}', {{ $subMenu->is_active }})">
                                <i class="fa-solid fa-power-off"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.delete') }}"
                               onclick="commonDelete('{{ route('root.menu.destroy', ['menu' => $subMenu->id]) }}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

{!! renderPagination($menus) !!}

{!! renderSearchEmpty($menus) !!}
