<?php

namespace App\Providers;

use App\Services\Users\Repositories\UserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use App\Services\Roles\Repositories\RoleRepository;
use App\Services\Roles\Repositories\RoleRepositoryInterface;
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
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
