<?php

namespace App\Http\Controllers\Web\Home\Address;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Address\WardService;
use Illuminate\Http\Request;

class WardController extends Controller
{
    public function __construct(
        protected WardService $wardService
    )
    {
        parent::__construct($wardService, env('APP_VIEW_PATH_HOME').'.address.ward');
    }

    public function getByProvince(Request $request): string
    {
        $data = $this->wardService->getByProvince($request);
        return view($this->viewPath.'.option', $data)->render();
    }
}
