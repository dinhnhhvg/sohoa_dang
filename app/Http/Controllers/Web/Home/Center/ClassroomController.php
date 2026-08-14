<?php

namespace App\Http\Controllers\Web\Home\Center;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Center\ClassroomService;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(
        protected ClassroomService $classroomService
    )
    {
        parent::__construct($classroomService, env('APP_VIEW_PATH_HOME').'.center.classroom');
    }

    public function getByCenter(Request $request): string
    {
        $data = $this->classroomService->getByCenter($request);
        return view($this->viewPath.'.option', $data)->render();
    }
}
