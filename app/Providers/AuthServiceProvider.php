<?php

namespace App\Providers;

use App\Order;
use App\Policies\OrderPolicy;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\Types\False_;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.S
     *
     * @var array
     */
    protected $policies = [
//       'App\Order' => "App\Policies\OrderPolicy"
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();
        Gate::define('create_order',function ($user){
            return $user->orders()->whereDate('created_at', Carbon::today())->count() < (int)setting('account.'.$user->type.'_number');
        });
Gate::before(function (User $user){
    if($user->isAdmin == true){
        return true;
    }
});

    }
}
