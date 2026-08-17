<?php

namespace App\Providers;

use App\Services\Admin\User\RoleService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \UniSharp\LaravelFilemanager\LfmItem::class,
            \App\Lfm\LfmItem::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(RoleService $roleService): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-5');
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-5');
    }
}
