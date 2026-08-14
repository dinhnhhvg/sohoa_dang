<?php

namespace App\Rules;

use Closure;

class FileTypeValidRule extends BaseRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fileTypeConfig = config('lfm.file_type_config');
        $fileExtensionArray = [];

        foreach ($this->parameters as $type) {
            if (isset($fileTypeConfig[$type]) && is_array($fileTypeConfig[$type])) {
                foreach ($fileTypeConfig[$type] as $ext) {
                    $fileExtensionArray[] = $ext;
                }
            }
        }

        $fileExtension = pathinfo($value, PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $fileExtensionArray, true)) {
            $fail(__(
                'validation.custom.file_valid',
                ['attribute' => __('app.'.$attribute), 'types' => implode(', ', $this->validTypes)]
            ));
        }
    }
}
