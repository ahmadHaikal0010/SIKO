<?php

namespace App\Providers;

use App\Models\Tenant;
use App\Models\Transaction;
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
        Gate::policies(Tenant::class, TenantPolicy::class);
        Gate::policies(Transaction::class, TransactionPolicy::class);
    }
}
