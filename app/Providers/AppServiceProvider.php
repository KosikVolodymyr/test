<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\UserSession;
use Validator;

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
        
        Validator::extend('username', function($attribute, $value, $parameters, $validator) {
            if (!empty($value) && preg_match('/^([A-ZА-ЯІЇЄЁ][a-zа-яіїєё]*)\ ([A-ZА-ЯІЇЄЁ][a-zа-яіїєё]*)$/u', $value) == 1) {
                return true;
            }
            
            return false;
        });
        
        view()->composer('pages._categories', function($view) {
            $view->with('categoriesList', Category::all());
        });
        
        view()->composer('layout', function($view) {
            $view->with('browsersList', UserSession::getBrowsersCount());
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
