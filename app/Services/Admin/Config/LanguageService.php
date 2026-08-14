<?php

namespace App\Services\Admin\Config;

use App\Libraries\LanguageLibrary;
use App\Repositories\LanguageRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class LanguageService extends BaseService
{
    public function __construct(
        protected LanguageRepository $languageRepository,
        protected LanguageLibrary $languageLibrary
    )
    {
        parent::__construct($languageRepository);
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['locales'] = array_keys($this->languageLibrary->get());
        $data['languages'] = $this->languageRepository->get($request->all());
        return $data;
    }

    public function show(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['locale'] = $id;
        $data['languages'] = $this->languageLibrary->get();
        return $data;
    }

    public function filterMessage(string $locale, Request $request): array
    {
        return $this->languageLibrary->filterMessage($locale, $request->all());
    }

    public function updateMessage(string $locale, Request $request): bool
    {
        return $this->languageLibrary->updateMessage($request->key, $request->value, $locale);
    }
}
