<?php

namespace App\Services\Admin\Setting;

use App\Repositories\CustomerTagRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class CustomerTagService extends BaseService
{
    public function __construct(
        protected CustomerTagRepository $customerTagRepository
    )
    {
        parent::__construct($customerTagRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['customerTags'] = $this->customerTagRepository->get($request->all(), [], ['customers']);
        return $data;
    }
}
