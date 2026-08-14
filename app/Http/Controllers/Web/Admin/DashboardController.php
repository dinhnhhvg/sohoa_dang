<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Web\Controller;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function __construct(DashboardService $dashboardService)
    {
        parent::__construct($dashboardService, env('APP_VIEW_PATH_ADMIN').'.dashboard');
    }
}
