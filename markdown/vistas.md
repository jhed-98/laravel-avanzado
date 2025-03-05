## Como crear y registrar un provider

Para escribir un proveedor de servicios en Laravel, debemos crear una nueva clase que implemente la Illuminate\Support\ServiceProvider interfaz. Esta interfaz define dos métodos que debemos implementar: register() y boot().

El método register() se usa para enlazar cosas en el contenedor de servicios de Laravel. Por ejemplo, podemos enlazar una instancia de una clase en el contenedor, lo que nos permitirá acceder a esa instancia en cualquier lugar de nuestra aplicación.

El método boot() se usa para realizar cualquier configuración que deba hacerse después de que se hayan registrado los enlaces del contenedor. Esto podría incluir la definición de rutas, la publicación de activos o la configuración de middleware.

Para registrar un proveedor de servicios con nuestra aplicación Laravel, debemos agregar la clase del proveedor a la providersmatriz en el config/app.phparchivo. Luego, cada vez que nuestra aplicación se inicie, se llamará automáticamente al register() y boot() métodos en nuestra clase de proveedor.

En resumen, los proveedores de servicios son una forma poderosa de extender y personalizar su aplicación Laravel. Al escribir sus propios proveedores de servicios, puede enlazar sus propias clases en el contenedor de servicios y realizar cualquier configuración necesaria para su aplicación.

## View Composer

Para crear un composer, creen un archivo PHP de la siguienta menera App\View\Composers\CompanyComposer.php

Asegurense que el nombre del archivo sea descriptivo y haga referencia al tipo de información que vas a compartir. La estructura del archivo debe ser la siguiente

```bash
<?php

namespace App\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class CompanyComposer
{

    public function compose(View $view): void
    {
        $view->with('prueba', 'Hola mundo');
    }
}
```

Luego, para compartirlo con una vista, debes dirigirte a cualquier provider, por ejemplo App\Providers\AppServiceProvider y ejecutar el siguiente codigo

```bash
<?php

namespace App\Providers;

use App\View\Composers\CompanyComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Using class based composers...
        Facades\View::composer('posts', CompanyComposer::class);

    }
}
```
