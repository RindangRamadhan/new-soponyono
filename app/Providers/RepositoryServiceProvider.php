<?php

namespace App\Providers;

use App\Interfaces\RoleInterface;
use App\Interfaces\CustomerInterface;
use App\Interfaces\UidInterface;
use App\Interfaces\Up3Interface;
use App\Interfaces\UlpInterface;
use App\Interfaces\ManagerUlpInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\OrderInterface;
use App\Repositories\RoleRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\UidRepository;
use App\Repositories\Up3Repository;
use App\Repositories\UlpRepository;
use App\Repositories\ManagerUlpRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
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
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(UidInterface::class, UidRepository::class);
        $this->app->bind(Up3Interface::class, Up3Repository::class);
        $this->app->bind(UlpInterface::class, UlpRepository::class);
        $this->app->bind(ManagerUlpInterface::class, ManagerUlpRepository::class);
        $this->app->bind(OrderInterface::class, OrderRepository::class);
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
