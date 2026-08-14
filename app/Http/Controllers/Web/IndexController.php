<?php

namespace App\Http\Controllers\Web;

use App\Services\Admin\DashboardService;

class IndexController extends Controller
{
    public function __construct(DashboardService $dashboardService)
    {
        parent::__construct($dashboardService, env('APP_VIEW_PATH_HOME'));
    }
}
