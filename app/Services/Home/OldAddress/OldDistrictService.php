<?php

namespace App\Services\Home\OldAddress;

use App\Repositories\OldDistrictRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class OldDistrictService extends BaseService
{
    public function __construct(
        protected OldDistrictRepository $oldDistrictRepository
    )
    {
        parent::__construct($oldDistrictRepository);
    }

    public function getByOldProvince(Request $request): array
    {
        $filters['old_province_id'] = [$request->old_province_id];
        return [
            'oldDistricts' => $this->oldDistrictRepository->get($filters)
        ];
    }
}
