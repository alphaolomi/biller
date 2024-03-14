<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('show-profile', function (User $user) {
            return $user->id === auth()->id();
        });

        Gate::define('edit-profile', function (User $user) {
            return $user->id === auth()->id();
        });
    }
}
