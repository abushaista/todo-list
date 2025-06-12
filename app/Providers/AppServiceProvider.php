<?php

namespace App\Providers;

use App\Contracts\TodoServiceInterface;
use App\Services\TodoService;
use App\Contracts\TodoExportInterface;
use App\Services\TodoExport;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(TodoServiceInterface::class, TodoService::class);
        $this->app->bind(TodoExportInterface::class, TodoExport::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
