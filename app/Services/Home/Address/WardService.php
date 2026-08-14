<?php

namespace App\Services\Home\Address;

use App\Repositories\WardRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class WardService extends BaseService
{
    public function __construct(
        protected WardRepository $wardRepository
    )
    {
        parent::__construct($wardRepository);
    }

    public function getByProvince(Request $request): array
    {
        $filters['province_id'] = [$request->province_id];
        return [
            'wards' => $this->wardRepository->get($filters)
        ];
    }
}
