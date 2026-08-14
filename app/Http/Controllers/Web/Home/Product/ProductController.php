<?php

namespace App\Http\Controllers\Web\Home\Product;

use App\Http\Controllers\Web\Controller;
use App\Services\Home\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
    )
    {
        parent::__construct($productService, env('APP_VIEW_PATH_HOME').'.product.product');
    }

    public function show(int|string $id, Request $request): View|string {
        $data = $this->productService->show($id, $request);
        if ($request->render_type === 'modal') {
            return view($this->viewPath.'.modal', $data);
        }
        if ($request->render_type === 'tr') {
            return view($this->viewPath.'.tr', $data);
        }
        return view($this->viewPath.'.show', $data);
    }
}
