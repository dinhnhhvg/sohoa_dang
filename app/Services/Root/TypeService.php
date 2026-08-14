<?php

namespace App\Services\Root;

use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class TypeService extends BaseService
{
    public function __construct(
        protected TypeRepository $typeRepository
    )
    {
        parent::__construct($this->typeRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['modules'] = $this->typeRepository->getForCategory();
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['modules'] = $this->typeRepository->getForCategory();
        return $data;
    }
}
