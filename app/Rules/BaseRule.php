<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;

class BaseRule implements ValidationRule
{
    public function __construct(
        protected array $parameters,
        protected array $data
    ) {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    protected function handleParam(Builder $query, array $parameters, array $data): Builder
    {
        $id = end($parameters);
        if ($id && is_numeric($id)) {
            $query->where('id', '<>', $id);
            array_pop($parameters);
        }

        $wheres = [];
        foreach ($parameters as $parameter) {
            $wheres[$parameter] = $data[$parameter];
        }

        if (isset($wheres) && $wheres) {
            $query->where($wheres);
        }
        return $query;
    }
}
