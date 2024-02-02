<?php

namespace App\Providers;

use App\Repositories\Read\UnitReadRepository;
use App\Repositories\Read\UnitReadRepositoryInterface;
use App\Repositories\Write\UnitWriteRepository;
use App\Repositories\Write\UnitWriteRepositoryInterface;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UnitReadRepositoryInterface::class,
            UnitReadRepository::class
        );

        $this->app->bind(
            UnitWriteRepositoryInterface::class,
            UnitWriteRepository::class
        );
    }
}
