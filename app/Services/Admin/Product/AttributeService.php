<?php

namespace App\Services\Admin\Product;

use App\Repositories\AttributeRepository;
use App\Repositories\CategoryRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AttributeService extends BaseService
{
    public function __construct(
        protected AttributeRepository $attributeRepository,
        protected CategoryRepository $categoryRepository
    )
    {
        parent::__construct($attributeRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['attributes'] = $this->attributeRepository->get($request->all(), ['categoryAttributes']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['categories'] = $this->categoryRepository->getByModule('product');
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = [
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ];
        $attribute = $this->attributeRepository->create($createData);
        $attribute->categories()->attach($request->input('category_id'));
        return $attribute;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['attribute'] = $this->attributeRepository->find($id, ['categoryAttributes']);
        $data['categories'] = $this->categoryRepository->getByModule('product');
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = [
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ];
        $attribute = $this->attributeRepository->find($id, ['categoryAttributes']);
        $attribute->categories()->sync($request->input('category_id'));
        return $this->attributeRepository->update($id, $updateData);
    }
}
