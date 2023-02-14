<?php

namespace App\Providers;

use App\Interfaces\RoleInterface;
use App\Interfaces\UidInterface;
use App\Interfaces\Up3Interface;
use App\Interfaces\UlpInterface;
use App\Interfaces\UserInterface;
use App\Repositories\RoleRepository;
use App\Repositories\UidRepository;
use App\Repositories\Up3Repository;
use App\Repositories\UlpRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(UidInterface::class, UidRepository::class);
        $this->app->bind(Up3Interface::class, Up3Repository::class);
        $this->app->bind(UlpInterface::class, UlpRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
