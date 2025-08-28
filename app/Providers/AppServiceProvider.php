<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        // Global money formatting directive for BDT (Taka)
        Blade::directive('money', function ($expression) {
            return "<?php echo '৳ ' . number_format((float) $expression, 2); ?>";
        });

        // Share cart count with all views
        view()->composer('*', function ($view) {
            if (!app()->runningInConsole()) {
                $cartCount = 0;
                try {
                    $sessionId = session()->getId();
                    $userId = auth()->id();

                    $cartCount = \App\Models\Cart::where(function ($query) use ($sessionId, $userId) {
                        if ($userId) {
                            $query->where('user_id', $userId);
                        } else {
                            $query->where('session_id', $sessionId);
                        }
                    })->sum('quantity');
                } catch (\Exception $e) {
                    // Ignore database errors during migrations
                }

                $view->with('cartCount', $cartCount);
            }
        });
    }
}
