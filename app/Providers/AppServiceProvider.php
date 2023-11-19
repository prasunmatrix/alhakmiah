<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Button;
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
        $data_txt=Button::all();

if($data_txt->isEmpty())
{

	$data['button_txt'] = [];
} else {
$data['button_txt'] = $data_txt[0];
}
        View::composer('*', function ($view) use ($data) {
           $view->with($data);
        });
    }
}
