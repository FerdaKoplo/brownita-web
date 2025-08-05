<?php

namespace App\Providers;

use App\Models\Keranjang;
use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer('*', function ($view) {
            $keranjangCount = 0;

            if (auth()->check()) {
                $keranjangCount = Keranjang::where('user_id', auth()->id())->sum('quantity');
            }

            $view->with('keranjangCount', $keranjangCount);
        });
    }
}
