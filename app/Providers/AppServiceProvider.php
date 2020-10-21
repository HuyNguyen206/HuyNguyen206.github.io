<?php

namespace App\Providers;

use App\Category;
use App\Setting;
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
//        Collection::macro('byStatus', function ($status) {
//            return $this->filter(function ($value) use ($status) {
//                return $value->status == $status;
//            });
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $categoryMainMenu = Category::where('parent_id', 0)->latest()->take(3)->get();
        view()->composer('frontend.components.main-menu', function($view) use($categoryMainMenu){
            $view->with(compact('categoryMainMenu'));
        });

        $categories = Category::where('parent_id', 0)->get();
        view()->composer('frontend.components.left-sidebar', function($view) use($categories){
            $view->with(compact('categories'));
        });
        view()->composer('frontend.home.components.category-product', function($view) use($categories){
            $view->with(compact('categories'));
        });



    }
}
