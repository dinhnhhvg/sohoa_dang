<?php

namespace App\Services\Admin\Category;

use App\Repositories\CategoryRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class CategoryService extends BaseService
{
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected TypeRepository $typeRepository
    )
    {
        parent::__construct($categoryRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['modules'] = $this->typeRepository->getForCategory();
        return $data;
    }

    public function filter(Request $request): array
    {
        return [
            'categories' => $this->categoryRepository->get($request->all(), ['parent', 'topics'])
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['modules'] = $this->typeRepository->getForCategory();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $category = $this->categoryRepository->find($id);
        $parents = $this->categoryRepository->getParentByModule($category->module);

        $data = $request->all();
        $data['category'] = $category;
        $data['parents'] = $parents;
        $data['modules'] = $this->typeRepository->getForCategory();
        return $data;
    }
}
