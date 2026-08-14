<?php

namespace App\Http\Controllers\Web\Home\Category;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    )
    {
        parent::__construct($categoryService, env('APP_VIEW_PATH_HOME').'.category.category');
    }

    public function getParentByModule(Request $request): string
    {
        $data = $this->categoryService->getParentByModule($request);
        return view($this->viewPath.'.option', $data)->render();
    }
}
