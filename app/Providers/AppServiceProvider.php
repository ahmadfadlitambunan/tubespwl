<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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

        // Format Rupiah
        Blade::directive('currency', function ( $expression ) { return "Rp<?php echo number_format($expression,2,',','.'); ?>"; });
        Paginator::useBootstrap();
    }   
}
