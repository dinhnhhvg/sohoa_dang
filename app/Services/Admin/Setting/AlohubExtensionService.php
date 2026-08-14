<?php

namespace App\Services\Admin\Setting;

use App\Repositories\AlohubExtensionRepository;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class AlohubExtensionService extends BaseService
{
    public function __construct(
        protected AlohubExtensionRepository $alohubExtensionRepository,
        protected UserRepository $userRepository
    )
    {
        parent::__construct($alohubExtensionRepository);
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['users'] = $this->userRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $createData = $request->validated();
        unset($createData['user_id']);
        $alohubExtension = $this->alohubExtensionRepository->create($createData);
        if ($request->input('user_id')) {
            $alohubExtension->users()->attach($request->input('user_id'));
        }
        return $alohubExtension;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['alohubExtension'] = $this->alohubExtensionRepository->find($id);
        $data['users'] = $this->userRepository->get();
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $request->validated();
        unset($updateData['user_id']);
        $alohubExtension = $this->alohubExtensionRepository->find($id);
        if ($request->input('user_id')) {
            $alohubExtension->users()->sync($request->input('user_id'));
        }
        return $this->alohubExtensionRepository->update($id, $updateData);
    }
}
