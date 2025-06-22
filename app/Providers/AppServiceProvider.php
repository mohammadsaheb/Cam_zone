<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        // Share cart data with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                $cartItemCount = 0;
                
                if ($cart) {
                    $cartItemCount = $cart->items()->sum('quantity');
                }
                
                $view->with('cartItemCount', $cartItemCount);
            } else {
                $view->with('cartItemCount', 0);
            }
        });
    }
}