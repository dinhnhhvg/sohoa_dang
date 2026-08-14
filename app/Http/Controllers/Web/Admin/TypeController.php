<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct(
        protected TypeService $typeService,
    )
    {
        parent::__construct($typeService, env('APP_VIEW_PATH_ADMIN').'.type');
    }

    public function reportBatch(Request $request): string
    {
        $data = $this->typeService->reportBatch($request);
        return view($this->viewPath.'.report_batch', $data)->render();
    }
}
