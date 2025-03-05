## Cómo instalar Breeze en tu proyecto

[Starter Kits](https://laravel.com/docs/11.x/starter-kits)

Breeze es un paquete oficial de Laravel que proporciona un sistema de autenticación simple y liviano para aplicaciones web. Aprenderás cómo instalar Breeze en tu proyecto Laravel 10 y cómo configurarlo para autenticar usuarios en tu aplicación.

Para empezar, abre la terminal y navega hasta el directorio de tu proyecto Laravel 10. A continuación, ejecuta el siguiente comando para instalar Breeze:

```bash
composer require laravel/breeze --dev
```

Este comando instala el paquete Breeze como una dependencia de desarrollo en tu proyecto Laravel 10. A continuación, ejecuta el siguiente comando para publicar los archivos de configuración y vistas de Breeze:

```bash
php artisan breeze:install
```

Este comando crea los archivos de configuración y vistas necesarios para utilizar Breeze en tu aplicación. También crea las rutas y controladores necesarios para gestionar la autenticación de los usuarios.

Una vez instalado Breeze, puedes configurarlo para adaptarlo a las necesidades de tu aplicación. Por ejemplo, si quieres utilizar un sistema de autenticación de dos factores, puedes activarlo en el archivo de configuración de Breeze.

Para configurar la autenticación de los usuarios en tu aplicación, abre el archivo de rutas de tu proyecto Laravel 10 y añade las rutas de autenticación proporcionadas por Breeze:

```bash
// Authentication Routes...
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Registration Routes...
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Password Reset Routes...
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
```

Estas rutas utilizan los controladores proporcionados por Breeze para gestionar la autenticación de los usuarios. Puedes personalizar los controladores y las vistas de Breeze para adaptarlos a las necesidades de tu aplicación.

En resumen, instalar Breeze en tu proyecto Laravel 10 es sencillo y te proporciona un sistema de autenticación simple y liviano para tus aplicaciones web. Puedes configurarlo y personalizarlo según tus necesidades para adaptarlo a la estructura de tu aplicación.

## Estructura de Breeze

Breeze es un paquete oficial de Laravel que permite implementar la autenticación de usuarios de manera rápida y sencilla en tu aplicación. Exploraremos la estructura de Breeze y cómo implementa la autenticación en Laravel 10.

Cuando instalas Breeze en tu proyecto Laravel, se agregan varios archivos y directorios que contienen el código fuente necesario para manejar la autenticación. El archivo principal es routes/web.php, donde se definen las rutas para la autenticación, el registro y la recuperación de contraseñas. También se incluyen vistas y controladores en los siguientes directorios:

-   app/Http/Controllers/Auth: Contiene los controladores de autenticación para manejar el inicio de sesión, el registro y la recuperación de contraseñas.
-   resources/views/auth: Contiene las vistas para los formularios de inicio de sesión, registro y recuperación de contraseñas.
-   resources/views/layouts: Contiene la plantilla de diseño principal de la aplicación, que se utiliza para envolver todas las vistas de la aplicación, incluyendo las vistas de autenticación.

En cuanto a la personalización de la apariencia de los formularios de inicio de sesión y registro, Breeze utiliza las vistas Blade de Laravel para generar el HTML de los formularios. Esto significa que puedes personalizar el HTML de los formularios modificando las vistas Blade en resources/views/auth. Además, también puedes personalizar los estilos CSS de los formularios agregando tus propias reglas CSS en tus archivos CSS personalizados.

En resumen, la estructura de Breeze en Laravel 10 es simple y bien organizada. Con los archivos y directorios predeterminados, puedes implementar la autenticación de usuarios en tu aplicación con muy poco esfuerzo. Y si deseas personalizar la apariencia de los formularios de autenticación, simplemente debes modificar las vistas y los estilos CSS.

## Cómo instalar Jetstream en tu proyecto

[Installing Jetstream](https://jetstream.laravel.com/installation.html)

Cómo instalar Jetstream en tu proyecto Laravel 10 para autenticar usuarios en tu aplicación. Jetstream es un paquete de Laravel que te proporciona un sistema de autenticación de usuarios y una interfaz de usuario para administrar las cuentas de los usuarios. Además, también te brinda características como la verificación en dos pasos, la gestión de sesiones y la protección contra ataques de fuerza bruta.

Para instalar Jetstream, primero debes tener instalado Laravel en tu máquina. Luego, abre una terminal y navega hasta el directorio de tu proyecto Laravel. Una vez allí, ejecuta el siguiente comando para instalar Jetstream:

```bash
composer require laravel/jetstream
```

Este comando descargará e instalará todas las dependencias de Jetstream en tu proyecto.

Una vez que Jetstream esté instalado, debes configurarlo. Ejecuta el siguiente comando para generar los archivos de configuración de Jetstream:

```bash
php artisan jetstream:install livewire
```

Este comando creará los archivos necesarios para la autenticación de usuarios y la interfaz de usuario en tu proyecto. También instalará las dependencias de Livewire, que es una biblioteca de Laravel que te permite crear interfaces de usuario dinámicas y reactivas en tiempo real.

Finalmente, debes ejecutar el siguiente comando para instalar las dependencias de NPM:

```bash
npm install && npm run dev
```

Este comando instalará todas las dependencias de NPM necesarias para el uso de Jetstream en tu proyecto. Luego, podrás iniciar el servidor de Laravel y acceder a la interfaz de usuario de Jetstream.

En resumen, Jetstream es un paquete de Laravel que te brinda un sistema de autenticación de usuarios y una interfaz de usuario para administrar las cuentas de los usuarios. Para instalar Jetstream, debes ejecutar unos pocos comandos en la terminal. Una vez instalado, debes configurarlo y luego podrás usar todas las características de Jetstream en tu aplicación.
