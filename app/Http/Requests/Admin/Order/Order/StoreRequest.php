<?php

namespace App\Http\Requests\Admin\Order\Order;

use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[0-9]{9,10}$/',
            'avatar' => 'required|string|file_exist|file_type_valid:image',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date_format:d-m-Y',
            'center_id' => 'nullable|integer|exists:centers,id',
            'agency_id' => 'nullable|integer|exists:agencies,id',
            'province_id' => 'required|integer|exists:provinces,id',
            'ward_id' => 'nullable|integer|exists:wards,id',
            'address' => 'nullable|string',
            'customer_tag_id' => 'nullable|integer|exists:customer_tags,id',
            'channel_id' => 'nullable|integer|exists:channels,id',
            'type_id' => 'required|integer|exists:types,id',
            'contact_id' => 'nullable|integer|exists:contacts,id',
            'content' => 'nullable|string',
            'note' => 'nullable|string',
            'discount_amount' => 'nullable|string',
            'coupon_code' => 'nullable|exists:coupons,code',
            'course_type_id' => 'nullable|array',
            'course_type_id.*' => 'required|integer|exists:course_types,id',
            'product_id' => 'nullable|array',
            'product_id.*' => 'required|integer|exists:products,id',
            'price' => 'nullable|array',
            'price.*' => 'required|string',
            'quantity' => 'nullable|array',
            'quantity.*' => 'required|integer',
            'item_content' => 'nullable|array',
            'item_content.*' => 'nullable|string',
        ];
    }
}
