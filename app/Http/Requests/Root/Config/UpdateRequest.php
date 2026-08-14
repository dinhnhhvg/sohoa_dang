<?php

namespace App\Http\Requests\Root\Config;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'app_file_manage_disk' => 'sometimes|required|string',

            'mail_mailer' => 'sometimes|required|string',
            'mail_host' => 'sometimes|required|string',
            'mail_port' => 'sometimes|required|string',
            'mail_username' => 'sometimes|nullable|string',
            'mail_password' => 'sometimes|nullable|string',
            'mail_encryption' => 'sometimes|nullable|string',
            'mail_form_address' => 'sometimes|required|string',
            'mail_form_name' => 'sometimes|required|string',

            'aws_access_key_id' => 'sometimes|nullable|string',
            'aws_secret_access_key' => 'sometimes|nullable|string',
            'aws_default_region' => 'sometimes|nullable|string',
            'aws_bucket' => 'sometimes|nullable|string',
            'aws_use_path_style_endpoint' => 'sometimes|required|boolean',

            'vdocipher_api_secret' => 'sometimes|nullable|string',
            'vdocipher_api_url' => 'sometimes|nullable|string',
            'vdocipher_upload_base_url' => 'sometimes|nullable|string',
            'vdocipher_webhook_secret' => 'sometimes|nullable|string',

            'bunny_library_id' => 'sometimes|nullable|string',
            'bunny_api_key' => 'sometimes|nullable|string',
            'bunny_api_url' => 'sometimes|nullable|string',
        ];
    }
}
