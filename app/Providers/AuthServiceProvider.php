<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gets
        Gate::resource('users', 'App\Policies\UserPolicy');
        Gate::resource('roles', 'App\Policies\RolePolicy');
        Gate::resource('settings', 'App\Policies\SettingPolicy');
        Gate::resource('contacts', 'App\Policies\ContactPolicy');
        Gate::resource('pages', 'App\Policies\PagePolicy');
        Gate::resource('page-categories', 'App\Policies\PageCategoryPolicy');
        Gate::resource('sliders', 'App\Policies\SliderPolicy');
        Gate::resource('menus', 'App\Policies\MenuPolicy');
        Gate::resource('socials', 'App\Policies\SocialPolicy');
        Gate::resource('product-categories', 'App\Policies\ProductCategoryPolicy');
        Gate::resource('products', 'App\Policies\ProductPolicy');
        Gate::resource('packages', 'App\Policies\PackagePolicy');
        Gate::resource('packagescategory', 'App\Policies\PackageCategoryPolicy');
        Gate::resource('portfoliocategory', 'App\Policies\PortfolioCategoryPolicy');
        Gate::resource('portfolio', 'App\Policies\PortfolioPolicy');
       
       
       Gate::resource('requests', 'App\Policies\RequestsPolicy');



    }
}
