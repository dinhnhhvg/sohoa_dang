<?php

namespace App\Http\Controllers\Web\Home\Course;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Course\CourseTypeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseTypeController extends Controller
{
    public function __construct(
        protected CourseTypeService $courseTypeService
    )
    {
        parent::__construct($courseTypeService, env('APP_VIEW_PATH_HOME').'.course.course_type');
    }

    public function show(int|string $id, Request $request): View|string {
        $data = $this->courseTypeService->show($id, $request);
        if ($request->render_type === 'tr') {
            return view($this->viewPath.'.tr', $data);
        }
        return view($this->viewPath.'.show', $data);
    }
}
