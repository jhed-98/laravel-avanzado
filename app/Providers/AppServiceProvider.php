<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

//! Pagination
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //! Usar paginacion personalizada
        Paginator::defaultView('components.pagination');

        //! Usar paginacion con Boostrap
        // Paginator::useBootstrapFive();

        //! Establecer el prefijo de las rutas
        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
        ]);

        //! Gates
        // Gate::define('author', function ($user, $post) {
        //     return $user->id === $post->user_id;
        // });
        Gate::after(function ($user, $ability) {
            return $user->hasRole('Prueba');
            if ($user->hasRole('Prueba')) {
                return $user->hasPermissionTo($ability); // Respeta los permisos asignados
            }
        });
    }
}
