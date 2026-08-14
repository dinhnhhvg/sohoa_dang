<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniqueCompositeRule extends BaseRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parameters = $this->parameters;
        $data = $this->data;

        $tableName = array_shift($parameters);
        $query = DB::table($tableName);

        if ($this->handleParam($query, $parameters, $data)->first()) {
            $fail(__(
                'validation.custom.unique_composite',
                ['attribute' => __('app.'.$attribute), 'table' => __('app.'.Str::singular($tableName))]
            ));
        }
    }
}
