<?php

namespace App\Http\Controllers\Web\Home\OldAddress;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\OldAddress\OldWardService;
use Illuminate\Http\Request;

class OldWardController extends Controller
{
    public function __construct(
        protected OldWardService $oldWardService
    )
    {
        parent::__construct($oldWardService, env('APP_VIEW_PATH_HOME').'.old_address.old_ward');
    }

    public function getByOldDistrict(Request $request): string
    {
        $data = $this->oldWardService->getByOldDistrict($request);
        return view($this->viewPath.'.option', $data)->render();
    }
}
