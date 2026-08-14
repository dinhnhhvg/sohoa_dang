@foreach($conversations as $conversation)
    <div>
        <a href="javascript:void(0)" class="d-flex align-items-center justify-content-between p-1 my-1 conversation-item" data-conversation-id="{{ $conversation->id }}"
           onclick="commonShow('{{ route('message.filter_card', ['conversation_id' => $conversation->id]) }}', '#message-filter-card', this, 'conversation')">
            <p class="d-flex align-items-center mb-0">
                <img src="{{ asset($conversation->avatar) }}" alt="Profile" class="rounded-circle w-45px me-2">
                <span class="mb-1">
                    <span class="title text-primary">{{ $conversation->name }}</span>
                    <br>
                    <span class="me-3 text-black fs-12">{{ $conversation->last_message_at?->format('H:s d-m-Y') }}</span>
                    <span class="text-black fs-12">{{ $conversation->is_group ? $conversation->conversation_members_count.' '.__('app.member') : '' }}</span>
                </span>
            </p>
            @if($conversation?->new_messages_count)
                <span class="btn btn-sm btn-danger rounded-circle float-end conversation-new-message">{{ $conversation?->new_messages_count }}</span>
            @endif
        </a>
    </div>
@endforeach

{!! renderSearchEmpty($conversations) !!}

<script>
    commonShow('{{ route('message.filter_card', ['conversation_id' => 0]) }}', '#message-filter-card')
</script>
