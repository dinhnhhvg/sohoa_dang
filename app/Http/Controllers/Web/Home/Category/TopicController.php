<?php

namespace App\Http\Controllers\Web\Home\Category;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Category\TopicService;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct(
        protected TopicService $topicService
    )
    {
        parent::__construct($this->topicService, env('APP_VIEW_PATH_HOME').'.category.topic');
    }

    public function getByCategory(Request $request): string
    {
        $data = $this->topicService->getByCategory($request);
        return view($this->viewPath.'.option', $data)->render();
    }
}
