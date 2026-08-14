<?php

namespace App\Http\Controllers\Web\Home\OldAddress;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\OldAddress\OldDistrictService;
use Illuminate\Http\Request;

class OldDistrictController extends Controller
{
    public function __construct(
        protected OldDistrictService $oldDistrictService
    )
    {
        parent::__construct($oldDistrictService, env('APP_VIEW_PATH_HOME').'.old_address.old_district');
    }

    public function getByOldProvince(Request $request): string
    {
        $data = $this->oldDistrictService->getByOldProvince($request);
        return view($this->viewPath.'.option', $data)->render();
    }
}
