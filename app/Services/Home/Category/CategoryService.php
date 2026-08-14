<?php

namespace App\Services\Home\Category;

use App\Repositories\CategoryRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class CategoryService extends BaseService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    )
    {
        parent::__construct($categoryRepository);
    }

    public function getParentByModule(Request $request): array
    {
        return [
            'categories' => $this->categoryRepository->getParentByModule($request->input('module'))
        ];
    }
}
