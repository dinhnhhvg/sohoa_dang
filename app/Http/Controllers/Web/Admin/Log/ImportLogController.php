<?php

namespace App\Http\Controllers\Web\Admin\Log;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\Log\ImportLogService;

class ImportLogController extends Controller
{
    public function __construct(
        protected ImportLogService $importLogService
    )
    {
        parent::__construct($importLogService, env('APP_VIEW_PATH_ADMIN').'.log.import_log');
    }
}
