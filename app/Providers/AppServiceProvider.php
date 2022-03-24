<?php

namespace App\Providers;

use App\Http\View\Composers\CategoryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer([
            'articles.index',
            'articles.create',
            'articles.edit'
        ],CategoryComposer::class);
    }
}
