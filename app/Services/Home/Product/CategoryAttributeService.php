<?php

namespace App\Services\Home\Product;

use App\Repositories\CategoryAttributeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class CategoryAttributeService extends BaseService
{
    public function __construct(
        protected CategoryAttributeRepository $categoryAttributeRepository
    )
    {
        parent::__construct($categoryAttributeRepository);
    }

    public function getByCategory(Request $request): array
    {
        $data = $request->all();
        $data['categoryAttributes'] = $this->categoryAttributeRepository->get(['category_id' => $request->input('category_id')]);
        return $data;
    }
}
