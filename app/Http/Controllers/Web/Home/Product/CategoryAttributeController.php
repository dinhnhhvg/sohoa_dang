<?php

namespace App\Http\Controllers\Web\Home\Product;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Product\CategoryAttributeService;
use Illuminate\Http\Request;

class CategoryAttributeController extends Controller
{
    public function __construct(
        protected CategoryAttributeService $categoryAttributeService
    )
    {
        parent::__construct($categoryAttributeService, env('APP_VIEW_PATH_HOME').'.product.category_attribute');
    }

    public function getByCategory(Request $request): string
    {
        $data = $this->categoryAttributeService->getByCategory($request);
        return view($this->viewPath.'.form', $data)->render();
    }
}
