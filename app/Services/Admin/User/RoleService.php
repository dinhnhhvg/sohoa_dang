<?php

namespace App\Services\Admin\User;

use App\Exports\Admin\RoleExport;
use App\Repositories\AccountRepository;
use App\Repositories\MenuRepository;
use App\Repositories\RoleRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RoleService extends BaseService
{
    public function __construct(
        protected RoleRepository $roleRepository,
        protected MenuRepository $menuRepository,
        protected AccountRepository $accountRepository
    )
    {
        parent::__construct($roleRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['accounts'] = $this->accountRepository->get();
        return $data;
    }

    public function filter(Request $request): array
    {
        return [
            'roles' => $this->roleRepository->get($request->all() ,null, ['users']),
            'orderByName' => $request->orderByName,
            'orderByType' => $request->orderByType
        ];
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['accounts'] = $this->accountRepository->get();
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['role'] = $this->roleRepository->find($id);
        $data['accounts'] = $this->accountRepository->get();
        return $data;
    }

    public function permission(string|int $id): array
    {
        return [
            'role' => $this->roleRepository->find($id)
        ];
    }

    public function filterPermission(Request $request): array
    {
        return [
            'menus' => $this->menuRepository->getMenuByAccount($request->all()),
            'roleId' => $request->roleId
        ];
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->roleRepository->get($request->all() ,null, ['users']);
        return Excel::download(new RoleExport($data), 'roles.xlsx');
    }
}
