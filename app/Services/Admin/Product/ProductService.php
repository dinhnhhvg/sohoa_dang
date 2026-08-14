<?php

namespace App\Services\Admin\Product;

use App\Models\Product;
use App\Repositories\CategoryAttributeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemTopicRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TopicRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductService extends BaseService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryRepository $categoryRepository,
        protected TopicRepository $topicRepository,
        protected ItemTopicRepository $itemTopicRepository,
        protected CategoryAttributeRepository $categoryAttributeRepository
    )
    {
        parent::__construct($productRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['categories'] = $this->categoryRepository->getByModule('product');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['products'] = $this->productRepository->get($request->all(), ['category']);
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
        $product = $this->productRepository->create($this->handleData($request->validated()));
        $this->itemTopicRepository->syncTopic(Product::class, $product->id, $request->input('topic_id'));
        if ($request->input('value_id')) {
            $product->values()->attach($request->input('value_id'));
        }
        return $product;
    }

    private function handleData(?array $data): array
    {
        if (isset($data['name'])) {
            $data['slug'] = formatSlug($data['name']);
        }
        if (isset($data['price'])) {
            $data['price'] = formatPrice($data['price']);
        }
        if (isset($data['old_price'])) {
            $data['old_price'] = formatPrice($data['old_price']);
        }
        unset($data['topic_id'], $data['value_id'], $data['product_addon_id']);
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $product = $this->productRepository->find($id);

        $data = $request->all();
        $data['product'] = $this->productRepository->find($id, ['topics', 'values']);
        $data['products'] = $this->productRepository->get();
        $data['categories'] = $this->categoryRepository->getByModule('product');
        $data['topics'] = $this->topicRepository->get(['category_id' => $product->category_id]);
        $data['categoryAttributes'] = $this->categoryAttributeRepository->get(['category_id' => $product->category_id]);
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        $product = $this->productRepository->find($id);
        if (isset($updateData['topic_id'])) {
            $this->itemTopicRepository->syncTopic(Product::class, $id, $updateData['topic_id']);
        }
        if (isset($updateData['value_id'])) {
            $product->values()->sync($updateData['value_id']);
        }
        if (isset($updateData['product_addon_id'])) {
            $product->addons()->sync($updateData['product_addon_id']);
        }
        return $this->productRepository->update($id, $this->handleData($updateData));
    }
}
