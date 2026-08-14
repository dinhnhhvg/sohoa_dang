<?php

namespace App\Services\Home\Conversation;

use App\Models\User;
use App\Repositories\ConversationMemberRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ConversationMemberService extends BaseService
{
    public function __construct(
        protected ConversationMemberRepository $conversationMemberRepository,
        protected UserRepository $userRepository
    )
    {
        parent::__construct($conversationMemberRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['memberAdminIds'] = $this->conversationMemberRepository->get(['conversation_id' => $request->input('conversation_id'), 'type' => 'admin'])->pluck('member_id')->toArray();
        return $data;
    }

    public function create(Request $request): array
    {
        $memberIds = $this->conversationMemberRepository->get(['conversation_id' => $request->input('conversation_id')])->pluck('member_id')->toArray();

        $data = $request->all();
        $data['users'] = $this->userRepository->get(['whereNot' => ['users.id' => $memberIds]]);
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $this->handleStore($request->all());
        return null;
    }

    public function handleStore(?array $post): bool
    {
        if (isset($post['member_id']) && $post['member_id']) {
            $memberIds = is_array($post['member_id']) ? $post['member_id'] : [$post['member_id']];
            foreach ($memberIds as $memberId) {
                $createData = [
                    'conversation_id' => $post['conversation_id'],
                    'type' => $memberId == session('member_id') ? 'admin' : 'member',
                    'member_id' => $memberId,
                    'member_type' => User::class,
                    'last_read_at' => date('Y-m-d H:i:s'),
                    'last_delete_at' => date('Y-m-d H:i:s')
                ];
                $this->conversationMemberRepository->create($createData);
            }
            return true;
        }
        return false;
    }

    public function updateLastReadAt(string|int|null $conversationId): bool
    {
        if ($conversationId) {
            $filters = [
                'conversation_id' => $conversationId,
                'member_id' => session('member_id'),
            ];
            $member = $this->conversationMemberRepository->get($filters)?->first();

            if ($member) {
                $updateData = [
                    'last_read_at' => date('Y-m-d H:i:s'),
                ];
                $this->conversationMemberRepository->update($member->id, $updateData);
                return true;
            }
        }
        return false;
    }

    public function updateLastDeleteAt(string|int|null $id): bool
    {
        $updateData = [
            'last_delete_at' => date('Y-m-d H:i:s'),
        ];
        return $this->conversationMemberRepository->update($id, $updateData);
    }
}
