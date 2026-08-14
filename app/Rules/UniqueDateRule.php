<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniqueDateRule extends BaseRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $parameters = $this->parameters;
        $data = $this->data;

        $tableName = array_shift($parameters);
        $query = DB::table($tableName);

        $date = array_shift($parameters);
        $query->where($date, '=', Carbon::parse($data[$date])->format('Y-m-d'));

        if ($this->handleParam($query, $parameters, $data)->first()) {
            $fail(__(
                'validation.custom.unique_date',
                ['attribute' => __('app.'.$attribute), 'table' => __('app.'.Str::singular($tableName))]
            ));
        }
    }
}
