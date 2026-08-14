<div class="card-header">
    <div class="d-sm-flex align-items-center justify-content-between">
        @if(isset($conversation) && $conversation)
            <div class="d-flex align-items-center">
                <img src="{{ asset($conversation->avatar) }}" alt="Profile" class="rounded-circle w-40px me-2">
                <p class="mb-1">
                    <span class="title text-primary">{{ $conversation->name }}</span>
                    <br>
                    <span class="text-black fs-12">{{ $conversation->is_group ? $conversation->conversation_members_count.' '.__('app.member') : '' }}</span>
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)"
                       onclick="conversationDelete('{{ route('conversation_member.update_last_delete_at', ['conversation_member' => $conversation->conversation_member_id]) }}', this, '{{ __('app.message.are_you_sure_delete_chat') }}')">
                        {{ __('app.delete') }} {{ __('app.chat') }}
                    </a>
                    @if($conversation->is_group)
                        <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('conversation_member.filter_modal', ['conversation_id' => $conversation->id]) }}', '#conversationShowModal')">
                            {{ __('app.member') }}
                        </a>

                        @if (in_array(session('member_id'), $conversation->conversationMemberAdmins->pluck('member_id')->toArray()))
                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('conversation.edit', ['conversation' => $conversation->id]) }}', '#conversationShowModal')">
                                {{ __('app.edit') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="commonShowModal('{{ route('conversation_member.create', ['conversation_id' => $conversation->id]) }}', '#conversationShowModal')">
                                {{ __('app.add_member') }}
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)"
                               onclick="conversationDelete('{{ route('conversation.destroy', ['conversation' => $conversation->id]) }}', this, '{{ __('app.message.are_you_sure_delete_conversation') }}')">
                                {{ __('app.delete') }}
                            </a>
                        @else
                            <a class="dropdown-item" href="javascript:void(0)"
                               onclick="conversationDelete('{{ route('conversation_member.destroy', ['conversation_member' => $conversation->conversation_member_id]) }}', this, '{{ __('app.message.are_you_sure_leave_group') }}')">
                                {{ __('app.leave_group') }}
                            </a>
                        @endif
                    @else
                        <a class="dropdown-item" href="javascript:void(0)"
                           onclick="conversationDelete('{{ route('conversation.destroy', ['conversation' => $conversation->id]) }}', this, '{{ __('app.message.are_you_sure_delete_conversation') }}')">
                            {{ __('app.delete') }}
                        </a>
                    @endif
                </div>

                <a href="javascript:void(0)" class="btn btn-sm btn-danger p-1 action-close" onclick="commonShow('{{ route('message.filter_card', ['conversation_id' => 0]) }}', '#message-filter-card')" title="{{ __('app.closed') }}">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>
        @else
            <h5 class="card-title mb-0">{{ __('app.chat') }}</h5>
        @endif
    </div>
</div>
<div class="card-body">
    <form method="GET" action="{{ route('message.filter_message') }}" id="message-filter-form" class="filter-form" onsubmit="messageFilter(); return false">
        <input type="hidden" name="conversation_id" value="{{ $conversation->id ?? 0 }}">
        <input type="hidden" name="max_id" value="0">
        <input type="hidden" name="type" value="botton">
        <div class="d-none">
            {!! renderSelectPaginateAndSubmit() !!}
        </div>
    </form>

    <div id="message-filter-table" class="filter-table" onscroll="messageOnscrollTop(this)" data-conversation-id="{{ $conversation->id ?? 0 }}"></div>
</div>
<div class="card-footer">
    <form method="POST" action="{{ route('message.store') }}" class="mb-0" onsubmit="messageSubmit(this); return false" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="conversation_id" value="{{ $conversation?->id }}">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex align-items-center">
                    <textarea class="form-control" name="content" rows="1" placeholder="{{ __('app.enter_message') }}"></textarea>
                    @if($conversation?->id)
                        <button type="submit" class="btn btn-primary py-2 ms-1" title="{{ __('app.send') }}">
                            <i class="fa-solid fa-location-arrow" style="transform: rotate(45deg);"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    @if($conversation?->id)
        messageFilter();
    @endif
</script>

