<?php

namespace App\Providers;

use App\Constants\UsersRoles;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        $this->registerPolicies();


        Gate::define('super_admin', function (User $user)
        {
            return $user->getActiveRoles()->role_code === UsersRoles::SUPER_ADMIN;
        });

        Gate::define('moderator', function (User $user)
        {
            return $user->getActiveRoles()->role_code === UsersRoles::MODERATOR;
        });

        Gate::define('editor', function (User $user)
        {
            return $user->getActiveRoles()->role_code === UsersRoles::EDITOR;
        });

        Gate::define('user', function (User $user)
        {
            return $user->getActiveRoles()->role_code === UsersRoles::USER;
        });

        Gate::define('super_user', function (User $user)
        {
            return $user->getActiveRoles()->role_code === UsersRoles::SUPER_USER;
        });

        Gate::define('new_user', function (User $user)
        {
            return $user->getActiveRoles()->role_code === UsersRoles::NEW_USER;
        });
    }
}
