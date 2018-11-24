<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ProfileHeaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'v1.site.profile.profile' , 'App\Http\ViewComposers\ProfileHeaderComposer'
        );



    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
