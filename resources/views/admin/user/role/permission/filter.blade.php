@foreach($menus as $menu)
    <div class="card mb-2 me-5">
        <div class="card-body p-2 {{ $menu->roles_count ? 'bg-active' : 'bg-inactive' }}">
            <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 text-primary"><strong><i class="{{ $menu->icon }}"></i> {{ __('app.'.$menu->name) }}</strong></p>

                @if(!count($menu->menus))
                    <p class="mb-0">
                        @foreach($menu->menuActions as $menuAction)
                            <span class="badge badge-hover {{ $menuAction->roles_count ? 'bg-success' : 'bg-danger' }}">
                                {{ __('app.'.$menuAction->action->name) }}
                                <span class="badge-action ps-2 text-nowrap">
                                    <a href="javascript:void(0)" class="pe-1" title="{{ __('app.toggle_active') }}"
                                       onclick="commonToggleActive('{{ route('admin.role_menu_action.toggle_relation', ['role' => $roleId, 'menu_action' => $menuAction->id]) }}')">
                                        <i class="fa-solid fa-power-off"></i>
                                    </a>
                                </span>
                            </span>
                        @endforeach
                    </p>
                @endif

                <div>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                       onclick="commonToggleActive('{{ route('admin.menu_role.toggle_relation', ['menu' => $menu->id, 'role' => $roleId]) }}')">
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @foreach($menu['menus'] as $subMenu)
        <div class="card mb-2 ms-5">
            <div class="card-body p-2 {{ $subMenu->roles_count ? 'bg-active' : 'bg-inactive' }}">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="mb-0 text-primary"><strong>{{ __('app.'.$subMenu->name) }}</strong></p>

                    <p class="mb-0">
                        @foreach($subMenu->menuActions as $menuAction)
                            <span class="badge badge-hover {{ $menuAction->roles_count ? 'bg-success' : 'bg-danger' }}">
                                {{ __('app.'.$menuAction->action->name) }}
                                <span class="badge-action ps-2 text-nowrap">
                                    <a href="javascript:void(0)" class="pe-1" title="{{ __('app.toggle_active') }}"
                                       onclick="commonToggleActive('{{ route('admin.role_menu_action.toggle_relation', ['role' => $roleId, 'menu_action' => $menuAction->id]) }}')">
                                        <i class="fa-solid fa-power-off"></i>
                                    </a>
                                </span>
                            </span>
                        @endforeach
                    </p>

                    <div>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger mb-1" title="{{ __('app.toggle_active') }}"
                           onclick="commonToggleActive('{{ route('admin.menu_role.toggle_relation', ['menu' => $subMenu->id, 'role' => $roleId]) }}')">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

{!! renderPagination($menus) !!}

{!! renderSearchEmpty($menus) !!}
