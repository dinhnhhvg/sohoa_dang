<?php

namespace App\Providers;

use App\Rules\FileExistRule;
use App\Rules\FileTypeValidRule;
use App\Rules\UniqueCompositeRule;
use App\Rules\UniqueDateRule;
use App\Rules\UniqueDatetimeRule;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->extendValidator('file_exist', FileExistRule::class);
        $this->extendValidator('file_type_valid', FileTypeValidRule::class);
        $this->extendValidator('unique_composite', UniqueCompositeRule::class);
        $this->extendValidator('unique_date', UniqueDateRule::class);
        $this->extendValidator('unique_datetime', UniqueDatetimeRule::class);
    }

    private function extendValidator(string $name, string $ruleClass): void
    {
        Validator::extend($name, function ($attribute, $value, $parameters, $validator) use ($ruleClass) {
            $validator->getData();
            $rule = new $ruleClass($parameters ?? [], $validator->getData());
            $failCallback = function ($message) use ($validator, $attribute) {
                $validator->errors()->add($attribute, $message);
            };
            $rule->validate($attribute, $value, $failCallback);
            return !$validator->errors()->has($attribute);
        });
    }
}
