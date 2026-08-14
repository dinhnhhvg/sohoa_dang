<?php

namespace App\Services\Home\OldAddress;

use App\Repositories\OldWardRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class OldWardService extends BaseService
{
    public function __construct(
        protected OldWardRepository $oldWardRepository
    )
    {
        parent::__construct($oldWardRepository);
    }

    public function getByOldDistrict(Request $request): array
    {
        $filters['old_district_id'] = [$request->old_district_id];
        return [
            'oldWards' => $this->oldWardRepository->get($filters)
        ];
    }
}
