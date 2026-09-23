<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // 'default' resolves to resources/views/default.blade.php, which does
        // not exist — every ->links() call threw "View [default] not found".
        // The published paginator view lives at views/vendor/pagination.
        Paginator::defaultView('pagination::default');

        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        // Add this line to resolve any potential mixed content warnings
        if(request()->isSecure()) {
            URL::forceScheme('https');
        }
    }

}
