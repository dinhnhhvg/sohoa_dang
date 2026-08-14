<?php

namespace App\Http\Controllers\Web\Admin\Contact;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Contact\Contact\StoreRequest;
use App\Http\Requests\Admin\Contact\Contact\UpdateRequest;
use App\Services\Admin\Contact\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    )
    {
        parent::__construct($contactService, env('APP_VIEW_PATH_ADMIN') . '.contact.contact');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->contactService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(string|int $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->contactService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function showNote(string|int $id, Request $request): string
    {
        $data = $this->contactService->showNote($id, $request);
        return view($this->viewPath.'.show_note', $data)->render();
    }
}
