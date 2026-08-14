<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileExistRule extends BaseRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkStorage = Storage::disk(env('APP_FILE_MANAGE_DISK'))->exists(str_replace('storage/', '', $value));
        $check = File::exists(public_path($value));
        if (!$checkStorage && !$check) {
            $fail(__('validation.custom.file_exist', ['attribute' => __('app.'.$attribute)]));
        }
    }
}
