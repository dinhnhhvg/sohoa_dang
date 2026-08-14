<?php

namespace App\Services\Admin\Product;

use App\Repositories\AttributeValueRepository;
use App\Services\BaseService;

class AttributeValueService extends BaseService
{
    public function __construct(AttributeValueRepository $attributeValueRepository)
    {
        parent::__construct($attributeValueRepository);
    }
}
