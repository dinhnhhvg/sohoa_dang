<?php

namespace App\Http\Controllers\Web\Admin\Config;

use App\Http\Controllers\Web\Controller;
use App\Http\Requests\Admin\Setting\Language\StoreRequest;
use App\Http\Requests\Admin\Setting\Language\UpdateRequest;
use App\Services\Admin\Config\LanguageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function __construct(
        protected LanguageService $languageService
    )
    {
        parent::__construct($languageService, env('APP_VIEW_PATH_ADMIN').'.config.language');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        if (!$this->languageService->store($request)) {
            return $this->responseError(__('app.message.create_error'));
        }
        return $this->responseSuccess(__('app.message.create_success'));
    }

    public function update(int|string $id, UpdateRequest $request): JsonResponse
    {
        if (!$this->languageService->update($id, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }

    public function filterMessage(string $locale, Request $request): View
    {
        $data = $this->languageService->filterMessage($locale, $request);
        return view($this->viewPath.'.filter_message', $data);
    }

    public function updateMessage(string $locale, Request $request): JsonResponse
    {
        if (!$this->languageService->updateMessage($locale, $request)) {
            return $this->responseError(__('app.message.update_error'));
        }
        return $this->responseSuccess(__('app.message.update_success'));
    }
}
