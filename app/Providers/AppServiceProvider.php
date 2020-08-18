<?php

namespace App\Providers;

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
        // view()->composer('layouts.includes.side',function($view)
        // {
        //     $mail   =   DB::table('contact_messages')->select('*')->get();
        //     $mailCount   =   count($mail);

        //     $view->with('mailCount',$mailCount)->with('mail',$mail);
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
