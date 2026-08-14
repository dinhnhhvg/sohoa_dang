<?php

namespace App\Http\Controllers\Web\Home\Conversation;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Home\Conversation\Conversation\StoreRequest;
use App\Http\Requests\Home\Conversation\Conversation\UpdateRequest;
use App\Services\Home\Conversation\ConversationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function __construct(
        protected ConversationService $conversationService
    )
    {
        parent::__construct($conversationService, env('APP_VIEW_PATH_HOME').'.conversation.conversation');
    }

    public function filterConversation(Request $request): JsonResponse
    {
        $data = $this->conversationService->filter($request);
        return $this->responseSuccess('', $data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->conversationService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->conversationService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function read(string|int $id, Request $request): JsonResponse
    {
        $this->conversationService->read($id, $request);
        return $this->responseSuccess('');
    }

    public function unread(string|int $id, Request $request): JsonResponse
    {
        $data = $this->conversationService->unread($id, $request);
        return $this->responseSuccess('', $data);
    }
}
