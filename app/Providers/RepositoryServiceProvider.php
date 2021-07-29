<?php

namespace App\Providers;

use App\Services\Companies\Repositories\CompanyRepository;
use App\Services\Companies\Repositories\CompanyRepositoryInterface;
use App\Services\Employees\Repositories\EmployeeRepository;
use App\Services\Employees\Repositories\EmployeeRepositoryInterface;
use App\Services\Users\Repositories\UserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
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
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
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
