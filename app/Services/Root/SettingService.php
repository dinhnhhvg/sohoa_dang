<?php

namespace App\Services\Root;

use App\Repositories\SettingRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class SettingService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository
    )
    {
        parent::__construct($settingRepository);
    }

    public function updateByKey(Request $request): bool
    {
        $post = $request->validated();
        foreach ($post as $key => $value) {
            $check = $this->settingRepository->getByKey($key);
            if ($check) {
                $this->settingRepository->update($check->id, ['value' => $value]);
            } else {
                $createData = [
                    'key' => $key,
                    'value' => $value
                ];
                $this->settingRepository->create($createData);
            }
        }
        return true;
    }
}
