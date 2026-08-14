<div class="table-responsive">
    <table class="table table-list table-scroll table-bordered table-striped table-condensed w-100">
        <thead>
        <tr>
            <th class="w-40px">
                <input type="checkbox" class="form-check-input" onchange="checkAll(this)">
            </th>
            <th class="w-40px">#</th>
            <th>{{ __('app.code') }}</th>
            <th>{{ __('app.name') }}</th>
            <th>{!! renderThSort(__('app.time'), 'conversation_members.created_at', $orderByName, $orderByType) !!}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conversationMembers as $i => $conversationMember)
            <tr>
                <td class="text-center">
                    @if(session('member_id') != $conversationMember->member_id)
                        <input type="checkbox" class="form-check-input id" name="id[]" value="{{ $conversationMember->id }}">
                    @endif
                </td>
                <td class="text-center">{{ $i + 1 }}</td>
                <td class="text-center text-nowrap">{{ $conversationMember->member->code }}</td>
                <td class="text-nowrap">
                    {{ $conversationMember->member->name }}
                    @if($conversationMember->type === 'admin')
                        <span class="text-primary" title="{{ __('app.admin') }}"><i class="fas fa-crown"></i></span>
                    @endif
                </td>
                <td class="text-center text-nowrap">{{ $conversationMember->created_at?->format('d-m-Y H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{!! renderPagination($conversationMembers) !!}

{!! renderSearchEmpty($conversationMembers) !!}
