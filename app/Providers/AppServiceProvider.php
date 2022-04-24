<?php

namespace App\Providers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale(getCurrentLocale());
        //URL::forceScheme('https');
        View::share('website', url('/') . '/website/');
        View::share('panel', url('/') . '/panel/');
        View::share('panel_assets', url('/') . '/panel/app-assets/');
        View::share('pLayout', 'admin.layouts.');
        View::share('sLayout', 'layouts.');

        view()->composer('*', function ($view) {
            $user = Auth::user();
            $view->with('userAuth', $user);
        });
        view()->composer('*', function ($view) {
            $langs = getAllLangFromDB();
            $view->with('dbLangs', $langs);
        });

        view()->composer('*', function ($view) {
            $currentLang = getCurrentLang();
            $currentDir = getCurrentDir();
            $view->with('currentLang', $currentLang);
            $view->with('currentDir', $currentDir);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
