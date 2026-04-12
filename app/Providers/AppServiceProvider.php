<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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
    
    /*Only Admin can manage stations*/
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Gate::define('manage-stations', function (User $user)
        {
            return $user->is_admin === true;
        });
    }
}
