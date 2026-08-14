<?php

namespace App\Http\Requests\Admin\Batch\Judgment;

use App\Http\Requests\BaseRequest;

class ReportFilterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ];
    }
}
