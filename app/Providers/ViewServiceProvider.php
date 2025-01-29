<?php

namespace App\Providers;

use App\View\Composers\CompanyComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //* Enviar parametros a todas las vistas
        View::share('prueba', 'Este es un mensaje de prueba');

        //* Enviar parametro a una vista especifica
        /* View::composer(['welcome'], function ($view) {
            $view->with('prueba2', 'Este es un mensaje de prueba 2');
        }); */
        View::composer(['welcome'], CompanyComposer::class);
    }
}
