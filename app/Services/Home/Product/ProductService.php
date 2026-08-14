<?php

namespace App\Services\Home\Product;

use App\Repositories\ProductRepository;
use App\Services\BaseService;

class ProductService extends BaseService
{
    public function __construct(
        public ProductRepository $productRepository
    )
    {
        parent::__construct($productRepository);
    }
}
