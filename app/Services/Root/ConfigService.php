<?php

namespace App\Services\Root;

use App\Repositories\SettingRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfigService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository
    )
    {
        parent::__construct($settingRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['root_password'] = $this->settingRepository->getByKey('root_password');
        $data['disks'] = array_keys(config('filesystems.disks'));
        return $data;
    }

    public function updateConfig(Request $request): ?bool
    {
        $path = base_path('.env');
        if (File::exists($path)) {
            $envContent = File::get($path);
            foreach ($request->validated() as $key => $value) {
                $key = strtoupper($key);
                $value = str_contains($value, ' ') ? '"'.$value.'"' : $value;
                $pattern = "/^{$key}=.*/m";
                $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
            }
            File::put($path, $envContent);
        }
        return true;
    }
}
