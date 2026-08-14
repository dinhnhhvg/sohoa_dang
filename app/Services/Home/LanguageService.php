<?php

namespace App\Services\Home;

use App\Libraries\LanguageLibrary;
use App\Repositories\SettingRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Cookie;

class LanguageService extends BaseService
{
    public function __construct(
        protected SettingRepository $settingRepository,
        protected LanguageLibrary $languageLibrary
    )
    {
        parent::__construct($settingRepository);
    }

    public function change(string $locale): bool
    {
        $languages = $this->languageLibrary->get();
        if (isset($languages[$locale]) && $languages[$locale]) {
            Cookie::queue('active_locale', $locale, 60 * 24 * 365 * 10);
            return true;
        }
        return false;
    }
}
