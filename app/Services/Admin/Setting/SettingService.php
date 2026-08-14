<?php

namespace App\Services\Admin\Setting;

use App\Repositories\AgencyRepository;
use App\Repositories\CenterRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository,
        protected UserRepository $userRepository,
        protected CenterRepository $centerRepository,
        protected AgencyRepository $agencyRepository,
        protected ProvinceRepository $provinceRepository
    )
    {
        parent::__construct($this->settingRepository);
    }

    public function index(Request $request): array
    {
        return array_merge(
            $request->all(),
            [
                'users' => $this->userRepository->get(),
                'centers' => $this->centerRepository->get(),
                'agencies' => $this->agencyRepository->get(),
                'provinces' => $this->provinceRepository->get()
            ]
        );
    }

    public function updateConfig(Request $request): ?bool
    {
        $path = base_path('.env');
        if (File::exists($path)) {
            $envContent = File::get($path);
            foreach ($request->validated() as $key => $value) {
                $key = 'APP_'.strtoupper($key);
                $value = str_contains($value, ' ') ? '"'.$value.'"' : $value;
                $pattern = "/^{$key}=.*/m";
                $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
            }
            File::put($path, $envContent);
        }
        return true;
    }
}
