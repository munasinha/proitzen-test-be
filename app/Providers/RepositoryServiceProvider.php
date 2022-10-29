<?php

namespace App\Providers;

use App\Repositories\TitleRepository;
use App\Repositories\SalaryRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EmployeeRepository;
use App\Repositories\Contracts\TitleRepositoryInterface;
use App\Repositories\Contracts\SalaryRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class,
        );

        $this->app->bind(
            SalaryRepositoryInterface::class,
            SalaryRepository::class,
        );

        $this->app->bind(
            TitleRepositoryInterface::class,
            TitleRepository::class,
        );

    }
}
