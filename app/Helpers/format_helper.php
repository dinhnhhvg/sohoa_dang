<?php

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('createLoginSession')) {
    function createLoginSession(string $account, Model $data): bool
    {
        if ($account === 'user') {
            session([
                'is_admin' => true,
                'account' => $account,
                'member_id' => $data->id,
                'user_id' => $data->id,
                'user_name' => $data->name,
                'user_phone' => $data->phone,
                'user_email' => $data->phone,
                'user_avatar' => $data->avatar,
                'role_id' => $data->role->id,
                'role_code' => $data->role->code,
                'role_name' => $data->role->name,
            ]);
        }
        if ($account === 'customer') {
            session([
                'account' => $account,
                'member_id' => $data->id,
                'is_customer' => true,
                'customer_id' => $data->id,
                'customer_name' => $data->name,
                'customer_phone' => $data->phone,
                'customer_email' => $data->phone,
                'customer_avatar' => $data->avatar,
            ]);
        }
        return true;
    }
}

if (!function_exists('formatSizeUnit')) {
    function formatSizeUnit($size): string
    {
        if (!$size) {
            return '0';
        }
        if ($size < 1024) {
            return $size . ' bytes';
        }
        if ($size < 1048576) { // 1024 * 1024
            return numberFormat($size / 1024, 2) . ' KB';
        }
        if ($size < 1073741824) { // 1024 * 1024 * 1024
            return numberFormat($size / 1048576, 2) . ' MB';
        }
        if ($size < 1099511627776) { // 1024^4
            return numberFormat($size / 1073741824, 2) . ' GB';
        }
        return numberFormat($size / 1099511627776, 2) . ' TB';
    }
}

if (!function_exists('formatSlug')) {
    function formatSlug($string, $key = '-'): string
    {
        if (is_string($string)) {
            return Str::slug($string, $key);
        }
        return '';
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice(string $string): string|int
    {
        return preg_replace('/\D/', '', $string);
    }
}

if (!function_exists('formatCamelCase')) {
    function formatCamelCase(string $string): string
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }
}

if (! function_exists('numberFormat')) {
    function numberFormat(string|int|null $number, $decimals = 0): ?string
    {
        if ($number === null) {
            return null;
        }
        return number_format($number, $decimals, ',', '.');
    }
}

if (! function_exists('cleanExcelValue')) {
    function cleanExcelValue(array|string|int $value, null|string|int $maxKey = null): array|string
    {
        if (!is_array($value)) {
            $value = (string) $value;
            $value = trim($value, "\xEF\xBB\xBF");
            $value = trim(preg_replace('/\s+/u', ' ', $value));
            return mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        }

        if ($maxKey) {
            for ($k = 0; $k <= $maxKey; $k++) {
                $value[$k] = cleanExcelValue($value[$k] ?? '');
            }
            return $value;
        }

        foreach ($value as $k => $v) {
            $value[$k] = cleanExcelValue($v);
        }
        return $value;
    }
}

if (! function_exists('getNextSaleId')) {
    function getNextSaleId(array $saleIds, string|int|null $lastUsedId = null): string|int
    {
        if ($lastUsedId === null) {
            return $saleIds[0];
        }
        $index = array_search($lastUsedId, $saleIds);
        if ($index === false) {
            return $saleIds[0];
        }
        $nextIndex = ($index + 1) % count($saleIds);
        return $saleIds[$nextIndex];
    }
}

if (! function_exists('calculateRate')) {
    function calculateRate(string|int|null $part, string|int|null $total): string|int
    {
        return $total ? round($part/$total*100) : 0;
    }
}
