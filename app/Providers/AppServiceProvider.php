<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\Kost;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Transaction;
use App\Policies\GalleryPolicy;
use App\Policies\KostPolicy;
use App\Policies\RoomPolicy;
use App\Policies\TenantPolicy;
use App\Policies\TransactionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policies(Kost::class, KostPolicy::class);
        Gate::policies(Room::class, RoomPolicy::class);
        Gate::policies(Tenant::class, TenantPolicy::class);
        Gate::policies(Transaction::class, TransactionPolicy::class);
        Gate::policies(Gallery::class, GalleryPolicy::class);
    }
}
