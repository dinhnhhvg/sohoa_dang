<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\AccountService;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function __construct(
        protected AccountService $accountService
    )
    {
        parent::__construct($this->accountService, env('APP_VIEW_PATH_HOME').'.account');
    }

    public function login(): View
    {
        $data = $this->accountService->login();
        return view($this->viewPath.'.login', $data);
    }
}
