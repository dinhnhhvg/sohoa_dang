<?php

namespace App\Http\Controllers\Web\Admin\Resource;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\Resource\FileManageService;

class FileManageController extends Controller
{
    public function __construct(
        protected FileManageService $fileManageService
    )
    {
        parent::__construct($fileManageService, env('APP_VIEW_PATH_ADMIN').'.resource.file_manage');
    }
}
