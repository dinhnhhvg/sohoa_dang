<div class="modal-header">
    <h4 class="modal-title text-primary">{{ __('app.member') }}</h4>
    <button type="button" class="btn-close fs-22" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="card filter-card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0">{{ __('app.list') }}</h5>
                <div>
                    <div class="btn-group float-end">
                        <button type="button" class="btn btn-primary dropdown-toggle me-2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('app.advanced') }}</button>
                        <div class="dropdown-menu">
                            @if(in_array(session('member_id'), $memberAdminIds))
                                <a class="dropdown-item" href="javascript:void(0)" onclick="commonHandleMany(this, '{{ route('conversation_member.destroy_many') }}')">{{ __('app.delete') }}</a>
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary is-search-button" onclick="changeIsSearch(this)"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('conversation_member.filter') }}" id="conversation_member-filter-form" class="filter-form d-none"
                  onsubmit="commonFilter(1, '#conversation_member-filter-form', '#conversation_member-filter-table'); return false">
                <input type="hidden" name="orderByName">
                <input type="hidden" name="orderByType">
                <input type="hidden" name="viewType">
                <input type="hidden" name="conversation_id" value="{{ $conversation_id }}">
                <div class="row">
                    <div class="col-xxl-3 col-sm-12">
                        <div class="form-group mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search_key" autocomplete="off" placeholder="{{ __('app.search') }}...">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>

                    {!! renderSelectPaginateAndSubmit() !!}
                </div>
            </form>

            <div id="conversation_member-filter-table" class="filter-table"></div>
        </div>
    </div>
</div>

<script>
    commonFilter(1, '#conversation_member-filter-form', '#conversation_member-filter-table');
</script>
