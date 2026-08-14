<?php

namespace App\Http\Controllers\Web\Home\Conversation;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Home\Conversation\Message\StoreRequest;
use App\Services\Home\Conversation\MessageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(
        protected MessageService $messageService
    )
    {
        parent::__construct($messageService, env('APP_VIEW_PATH_HOME').'.conversation.message');
    }

    public function filterCard(Request $request): string
    {
        $data = $this->messageService->filterCard($request);
        return view($this->viewPath.'.filter_card', $data)->render();
    }
    public function filterMessage(Request $request): JsonResponse
    {
        $data = $this->messageService->filter($request);
        return $this->responseSuccess('', $data);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->messageService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }
}
