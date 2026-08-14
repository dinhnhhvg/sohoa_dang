<?php

namespace App\Services\Root;

use App\Repositories\SettingRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class AuthService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository
    )
    {
        parent::__construct($settingRepository);
    }

    public function checkLogin(): bool
    {
        $setting = $this->settingRepository->getByKey('root_password');
        return $setting && $setting['value'] && $setting['value'] === session('root_password');
    }

    public function login(Request $request): bool
    {
        $password = $request->password;
        $setting = $this->settingRepository->getByKey('root_password');
        if ($setting && $setting['value'] && $password && $setting['value'] === $password) {
            session(['root_password' => $password]);
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        session()->forget('root_password');
    }
}
