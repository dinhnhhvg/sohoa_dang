<?php

namespace App\Services\Home\Conversation;

use App\Events\MessageSent;
use App\Models\User;
use App\Repositories\ConversationRepository;
use App\Repositories\MessageRepository;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MessageService extends BaseService
{
    public function __construct(
        protected MessageRepository $messageRepository,
        protected ConversationRepository $conversationRepository,

        protected ConversationService $conversationService,
        protected ConversationMemberService $conversationMemberService
    )
    {
        parent::__construct($messageRepository);
    }

    public function filterCard(Request $request): array
    {
        $this->conversationMemberService->updateLastReadAt($request->input('conversation_id'));

        $conversation = $this->conversationRepository->find($request->input('conversation_id'), ['conversationMembers.member', 'conversationMemberAdmins'], ['conversationMembers']);
        $this->conversationService->handleName($conversation);
        $data = $request->all();
        $data['conversation'] = $conversation;
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['messages'] = $this->messageRepository->get($request->all(), ['createdBy'])->items();
        $data['unread_conversations_count'] = $this->conversationRepository->getUnreadConversationsCount();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = [
            'conversation_id' => $request->input('conversation_id'),
            'created_by_id' => session('member_id'),
            'created_by_type' => User::class,
            'content' => $request->input('content')
        ];
        $message = $this->messageRepository->create($createData);

        $this->conversationService->updateLastMessageAt($request->input('conversation_id'));
        $this->conversationMemberService->updateLastReadAt($request->input('conversation_id'));

        broadcast(new MessageSent( $this->messageRepository->find($message->id, ['conversation.conversationMembers', 'createdBy'])));
        return $message;
    }
}
