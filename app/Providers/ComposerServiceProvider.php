<?php

namespace App\Providers;

use App\Eloquent\Contact;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('admin.main', function($view) {
            $view->with(['new_message' => Contact::select('status')->where('status', 1)->get()->count()]);
        });
    }
}
