<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Cache::remember('categories', now()->addHour(24) ,function(){
            return Category::orderByRaw('name ASC')->get();
        });
        $newOrders = Order::where('status', 0)->count();
        View::share([
            'menu'=>$categories,
            'newOrders'=>$newOrders
        ]);
    }
}
