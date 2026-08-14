<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\LanguageService;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function __construct(
        protected LanguageService $languageService
    )
    {
        parent::__construct($this->languageService, env('APP_VIEW_PATH_HOME'));
    }

    public function change(string $locale): RedirectResponse
    {
        $this->languageService->change($locale);
        return redirect()->back()->with('success', __('app.message.change_success'));
    }
}
