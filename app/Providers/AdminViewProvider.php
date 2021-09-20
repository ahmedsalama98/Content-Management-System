<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AdminViewProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if(request()->is('admin/*')){


            Paginator::defaultView('vendor.pagination.bootstrap-4');

         //global categories cache handle

                if(!Cache::has('global_categories')){

                    $global_categories = Category::whereStatus(1)
                    ->latest()->get();
                    Cache::remember('global_categories', 3600, function ()use($global_categories) {
                        return $global_categories;
                    });

                }

         //global categories cache handle

                $global_categories = Cache::get('global_categories');

       //path cache ito view
                view()->composer('*' , function($view) use( $global_categories){
                    return $view->with([

                        'global_categories'=>$global_categories,
                    ]);
                });


}
    }
}
