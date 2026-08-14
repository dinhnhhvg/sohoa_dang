<?php

namespace App\Services\Admin\Log;

use App\Repositories\ImportLogRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ImportLogService extends BaseService
{
    public function __construct(
        protected ImportLogRepository $importLogRepository,
        protected UserRepository $userRepository
    )
    {
        parent::__construct($importLogRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['users'] = $this->userRepository->get();
        return $data;
    }

    public function storeImportLog(?string $module, ?string $filePath, ?array $value): Model|array|null
    {
        $createData = [
            'module' => $module,
            'file_path' => $filePath,
            'value' => json_encode($value),
            'user_id' => session('user_id')
        ];
        return $this->importLogRepository->create($createData);
    }
}
