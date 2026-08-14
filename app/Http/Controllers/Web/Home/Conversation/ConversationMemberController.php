<?php

namespace App\Http\Controllers\Web\Home\Conversation;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Home\Conversation\ConversationMember\StoreRequest;
use App\Services\Home\Conversation\ConversationMemberService;
use Illuminate\Http\JsonResponse;

class ConversationMemberController extends Controller
{
    public function __construct(
        protected ConversationMemberService $conversationMemberService
    )
    {
        parent::__construct($conversationMemberService, env('APP_VIEW_PATH_HOME').'.conversation.conversation_member');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->conversationMemberService->store($request);
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function updateLastDeleteAt(string|int $id): JsonResponse
    {
        if (!$this->conversationMemberService->updateLastDeleteAt($id)) {
            return $this->responseError(__('app.message.destroy_error'));
        }
        return $this->responseSuccess(__('app.message.destroy_success'));
    }
}
