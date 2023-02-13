<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $menuJson = file_get_contents(base_path('public/data/menu/menu.json'));
        $menus = json_decode($menuJson);

        View::share('menus', [$menus]);
    }
}
