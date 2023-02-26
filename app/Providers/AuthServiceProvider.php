<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Product'=>'App\Policies\ProductPolicy',
        'App\User'=>'App\Policies\UserPolicy',
        'App\Category'=>'App\Policies\CategoryPolicy',
        'App\Order'=>'App\Policies\OrderPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('update-product', function($user,$product){
        //     return $user->id == $product->user_id;
        // });
        //
    }
}
