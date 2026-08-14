<?php

namespace App\Libraries;

class LanguageLibrary
{
    public function get(): array
    {
        return config('app.supported_locales');
    }

    public function show(string $locale): string
    {
        $languages = $this->get();
        return $languages[$locale] ?? $languages['vi'];
    }

    public function filterMessage(string $locale, ?array $filters = null, string $filename = 'app'): array
    {
        $path = resource_path("lang/{$locale}/{$filename}.php");
        $messages = file_exists($path) ? include $path : [];

        if (isset($filters['search_key']) && $filters['search_key'] !== '') {
            $messages = $this->getMessageBySearchKey($messages, mb_strtolower($filters['search_key']));
        }

        return [
            'locale' => $locale,
            'language' => $this->show($locale),
            'messages' => $messages,
        ];
    }

    private function getMessageBySearchKey(array $messages, string $searchKey): array
    {
        foreach ($messages as $key => $message) {
            if (is_string($message)) {
                if (!str_contains(mb_strtolower($message), $searchKey)) {
                    unset($messages[$key]);
                }
            } else {
                $result = $this->getMessageBySearchKey($message, $searchKey);
                if ($result) {
                    $messages[$key] = $result;
                } else {
                    unset($messages[$key]);
                }
            }
        }
        return $messages;
    }

    public function updateMessage(string $key, string $value, string $locale, string $filename = 'app'): bool
    {
        $path = resource_path("lang/{$locale}/{$filename}.php");
        if (!file_exists($path)) {
            file_put_contents($path, "<?php\n\nreturn [\n];\n");
        }
        $translations = include $path;
        $keys = explode('.', $key);
        $ref = &$translations;
        foreach ($keys as $k) {
            if (!isset($ref[$k]) || !is_array($ref[$k])) {
                $ref[$k] = [];
            }
            $ref = &$ref[$k];
        }
        $ref = $value;
        $export = var_export($translations, true);
        file_put_contents($path, "<?php\n\nreturn {$export};\n");
        return true;
    }
}
