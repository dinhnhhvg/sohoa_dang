<?php

namespace App\Services\Admin\Category;

use App\Repositories\LevelRepository;
use App\Repositories\TypeRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class LevelService extends BaseService
{
    public function __construct(
        protected LevelRepository $levelRepository,
        protected TypeRepository $typeRepository
    )
    {
        parent::__construct($levelRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['modules'] = $this->typeRepository->getActiveByModule('order');
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['modules'] = $this->typeRepository->getActiveByModule('order');
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['level'] = $this->levelRepository->find($id);
        $data['modules'] = $this->typeRepository->getActiveByModule('order');
        return $data;
    }
}
