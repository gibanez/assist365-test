<?php

namespace App\Providers;

use App\Contracts\Repository\NotificationRepositoryInterface;
use App\Contracts\Repository\PassengerRepositoryInterface;
use App\Contracts\Repository\ReservationRepositoryInterface;
use App\Services\Common\NotificationRepositoryDB;
use App\Services\Passenger\PassengerRepositoryDB;
use App\Services\Reservation\ReservationRepositoryDB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PassengerRepositoryInterface::class, PassengerRepositoryDB::class);
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepositoryDB::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepositoryDB::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
