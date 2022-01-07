<?php

namespace App\Providers;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('handle-student', function (User $user) {
            return $user->isReferent() || $user->isAdmin();
        });

        Gate::define('create-offer', function (User $user) {
            return $user->isStudent();
        });

        Gate::define('manage-offer', function (User $user, Offer $offer) {
            return $user->isAdmin() ||
            ($user->id === $offer->user_id);
        });
    }
}
