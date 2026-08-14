<?php

namespace App\Services\Home\Conversation;

use App\Models\User;
use App\Repositories\ConversationRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationService extends BaseService
{
    public function __construct(
        protected ConversationRepository $conversationRepository,
        protected UserRepository $userRepository,

        protected ConversationMemberService $conversationMemberService
    )
    {
        parent::__construct($conversationRepository);
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['users'] = $this->userRepository->get(['whereNot' => ['users.id' => session('user_id')]]);
        return $data;
    }

    public function filter(Request $request): array
    {
        $conversations = $this->conversationRepository->get($request->all(), ['conversationMembers.member'], ['conversationMembers']);
        foreach ($conversations as $conversation) {
            $this->handleName($conversation);
        }

        $data = $request->all();
        $data['conversations'] = $conversations->items();
        return $data;
    }

    public function handleName(mixed $conversation): void
    {
        if ($conversation && !$conversation->is_group) {
            foreach ($conversation->conversationMembers as $conversationMembers) {
                if (!(Auth::user() instanceof $conversationMembers->member_type && $conversationMembers->member_id == session('member_id'))) {
                    $conversation->name = $conversationMembers->member->name;
                    $conversation->avatar = $conversationMembers->member->avatar;
                }
            }
        }
    }

    public function store(Request $request): Model|array|null
    {
        $createData = [
            'name' => $request->name,
            'avatar' => env('APP_FAVICON'),
            'is_group' => $request->is_group,
            'created_by_id' => session('member_id'),
            'created_by_type' => User::class,
            'last_message_at' => date('Y-m-d H:i:s')
        ];
        $conversation = $this->conversationRepository->create($createData);
        $conversationId = $conversation->id;
        $this->conversationMemberService->handleStore(['conversation_id' => $conversationId, 'member_id' => array_merge($request->member_id, [session('member_id')])]);
        return $conversation;
    }

    public function updateLastMessageAt(string|int $id): bool
    {
        $updateData = [
            'last_message_at' => date('Y-m-d H:i:s')
        ];
        $this->conversationRepository->update($id, $updateData);
        return true;
    }

    public function read($id, Request $request): void
    {
        $this->conversationMemberService->updateLastReadAt($id);
    }

    public function unread($id, Request $request): array
    {
        $conversations = $this->conversationRepository->get(['conversations.id' => $id], ['conversationMembers.member'], ['conversationMembers']);
        foreach ($conversations as $conversation) {
            $this->handleName($conversation);
        }

        $data['type'] = 'top';
        $data['conversation_id'] = $id;
        $data['conversations'] = $conversations->toArray();
        $data['unread_conversations_count'] = $this->conversationRepository->getUnreadConversationsCount();
        return $data;
    }
}
