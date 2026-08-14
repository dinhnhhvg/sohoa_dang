<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseService
{
    public function __construct(
        protected BaseRepository $repository
    )
    {
    }

    public function index(Request $request): array
    {
        return $request->all();
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data[formatCamelCase($this->repository->getName())] = $this->repository->get($request->all());
        return $data;
    }

    public function create(Request $request): array
    {
        return $request->all();
    }

    public function store(Request $request): Model|array|null
    {
        return $this->repository->create($request->validated());
    }

    public function detail(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data[formatCamelCase($this->repository->getSingularName())] = $this->repository->find($id);
        return $data;
    }

    public function show(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data[formatCamelCase($this->repository->getSingularName())] = $this->repository->find($id);
        return $data;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data[formatCamelCase($this->repository->getSingularName())] = $this->repository->find($id);
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        return $this->repository->update($id, $request->validated());
    }

    public function destroy(string|int $id): ?bool
    {
        return $this->repository->delete($id);
    }

    public function destroyMany(Request $request): ?bool
    {
        return $this->repository->delete(explode(',', $request->ids));
    }

    public function createImport(Request $request): array
    {
        return $request->all();
    }

    public function handleFormatDate(array $data, array $keys, string $type = 'Y-m-d'): array
    {
        foreach ($keys as $key) {
            if (!empty($data[$key])) {
                $data[$key] = Carbon::createFromFormat('d-m-Y', str_replace('/', '-', $data[$key]))->format($type);
            }
        }
        return $data;
    }
}
