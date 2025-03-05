## Conexión a base de datos

Para conectar tu aplicación Laravel 10 a una base de datos, primero debes configurar la conexión en el archivo .env de tu aplicación. Abre el archivo .env y busca las variables de entorno que comienzan con "DB\_". Asegúrate de que estas variables se ajusten a la configuración de tu base de datos:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_la_base_de_datos
DB_USERNAME=nombre_de_usuario
DB_PASSWORD=contraseña
```

En el ejemplo anterior, se utiliza la base de datos MySQL. Si estás utilizando otra base de datos, como PostgreSQL o SQLite, debes cambiar el valor de DB_CONNECTION.

Una vez que hayas configurado la conexión a la base de datos, puedes utilizar el ORM Eloquent de Laravel para interactuar con la base de datos. Eloquent te permite definir modelos que representan tablas de la base de datos y realizar operaciones de CRUD (crear, leer, actualizar y eliminar) en ellas de forma fácil y elegante.

Para comenzar a utilizar Eloquent, primero debes crear un modelo. Puedes generar un modelo utilizando el comando artisan make:model seguido del nombre del modelo. Por ejemplo, si quieres crear un modelo para la tabla "users", puedes ejecutar el siguiente comando:

```bash
php artisan make:model User
```

Esto creará un archivo User.php en el directorio app/Models de tu aplicación Laravel 10. Abre el archivo y asegúrate de que la clase tenga el siguiente código:

```bash
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
   use HasFactory;
}
```

Este modelo representa la tabla "users" en la base de datos y utiliza el trait HasFactory, que proporciona algunos métodos de fábrica útiles para la creación de registros de modelo.

Una vez que hayas creado el modelo, puedes utilizar Eloquent para realizar operaciones de CRUD en la tabla correspondiente. Por ejemplo, para crear un nuevo registro de usuario, puedes hacer lo siguiente:

```bash
$user = new User;
$user->name = 'John Doe';
$user->email = 'john@example.com';
$user->save();
```

Este código crea un nuevo objeto User, establece los valores de las propiedades "name" y "email" y luego guarda el objeto en la base de datos utilizando el método save().

Para recuperar todos los registros de usuarios de la tabla "users", puedes hacer lo siguiente:

```bash
$users = User::all();
```

Este código recupera todos los registros de la tabla "users" y los devuelve como una colección de objetos User.

Para actualizar un registro de usuario existente, puedes hacer lo siguiente:

```bash
$user = User::find(1);
$user->name = 'Jane Doe';
$user->email = 'jane@example.com';
$user->save();
```

Este código busca el registro de usuario con el ID 1, actualiza los valores de las propiedades "name" y "email" y luego guarda el objeto en la base de datos utilizando el método save().

Para eliminar un registro de usuario existente, puedes hacer lo siguiente:

```bash
$user = User::find(1);
$user->delete();
```

Este código busca el registro de usuario con el ID 1 y lo elimina de la base de datos utilizando el método delete().

Con Eloquent, puedes realizar operaciones de CRUD en tu base de datos de forma elegante y fácil.

## Actualizar tabla con migraciones

En Laravel 10, puedes revertir cambios en la base de datos utilizando las migraciones. Las migraciones te permiten deshacer y reaplicar los cambios en la base de datos de forma ordenada y controlada.

Para revertir una migración específica, puedes utilizar el comando "rollback" de Artisan. Por ejemplo, si tienes una migración llamada "create_users_table" y deseas revertirla, puedes ejecutar el siguiente comando en la terminal:

```bash
php artisan migrate:rollback --step=1
```

El parámetro "--step=1" indica que solo se debe revertir la última migración. Si deseas revertir varias migraciones, puedes aumentar el valor de "--step" según el número de migraciones que deseas revertir.

También puedes utilizar el comando "rollback" sin el parámetro "--step" para revertir todas las migraciones que se hayan aplicado. Por ejemplo:

```bash
php artisan migrate:rollback
```

Si deseas eliminar completamente todas las tablas de la base de datos y revertir todas las migraciones, puedes utilizar el comando "reset". Este comando elimina todas las tablas de la base de datos y luego ejecuta todas las migraciones de nuevo. Para utilizar el comando "reset", puedes ejecutar el siguiente comando en la terminal:

```bash
php artisan migrate:reset
```

Ten en cuenta que el comando "reset" eliminará todos los datos de la base de datos, por lo que debes tener cuidado al utilizarlo en entornos de producción.

## Eliminar tablas

### [Renaming / Dropping Tables](https://laravel.com/docs/11.x/migrations#renaming-and-dropping-tables)

Al comienzo del vídeo se borra una migración llamada rename_posts_table que no realizamos en la unidad anterior, pero que no tiene misterio alguno.

Se trata de renombrar nuestra tabla posts por el nombre articles, siguiendo estos pasos:

1. Creamos una nueva migración con artisan make:migration rename_posts_table
2. En el cuerpo de la función up() incluímos:

    ```bash
    Schema::rename('posts', 'articles');
    ```

3. En el cuerpo de la función down() incluímos:

    ```bash
    Schema::rename('articles', 'posts');
    ```

Son la misma función, pero invirtiendo los nombres.

Y listo! Ejecutamos la migración con artisan migrate y habremos renombrado nuestra tabla.

## Modificadores de columna

Los modificadores de columna en las migraciones de Laravel 10. Los modificadores de columna son una forma poderosa de definir restricciones y valores predeterminados para los campos de la tabla en la base de datos de tu aplicación Laravel.

Los modificadores de columna te permiten especificar restricciones para los campos de la tabla, como la longitud máxima de un campo o si un campo es obligatorio o no. Además, también puedes utilizar los modificadores de columna para establecer valores predeterminados para los campos, lo que significa que si no se proporciona ningún valor, se utilizará el valor predeterminado que hayas establecido.

En Laravel 10, puedes utilizar varios tipos de modificadores de columna para definir las restricciones y valores predeterminados de los campos de la tabla. Algunos de los modificadores más comunes incluyen "nullable", que permite que un campo tenga un valor nulo, "unique", que asegura que un campo tenga un valor único, y "default", que establece un valor predeterminado para un campo.

Además, Laravel también ofrece modificadores de columna personalizados que puedes utilizar para definir restricciones y valores predeterminados específicos para tu aplicación. Con los modificadores de columna personalizados, puedes definir tus propias reglas de validación y valores predeterminados para los campos de la tabla.

En resumen, los modificadores de columna en las migraciones de Laravel 10 son una herramienta poderosa para definir restricciones y valores predeterminados para los campos de la tabla en la base de datos de tu aplicación. Con los modificadores de columna, puedes establecer reglas de validación específicas y asegurarte de que los datos almacenados en tu base de datos cumplan con tus requisitos. Si deseas definir reglas de validación y valores predeterminados para los campos de la tabla en tu aplicación Laravel, es fundamental que aprendas cómo utilizar los modificadores de columna.

-   [Available Column Types](https://laravel.com/docs/11.x/migrations#available-column-types)
-   [Column Modifiers](https://laravel.com/docs/11.x/migrations#column-modifiers)
-   [Modifying Columns](https://laravel.com/docs/11.x/migrations#column-modifiers)
-   [Renaming Columns](https://laravel.com/docs/11.x/migrations#renaming-columns)
    ```bash
    Schema::table('users', function (Blueprint $table) {
    $table->renameColumn('from', 'to');
    });
    ```
-   [Dropping Columns](https://laravel.com/docs/11.x/migrations#dropping-columns)
-   [Indexes](https://laravel.com/docs/11.x/migrations#indexes)
-   [Foreign Key Constraints](https://laravel.com/docs/11.x/migrations#foreign-key-constraints)

### TIP para errores

El proyecto creaba por defecto las tablas de tipo **MyISAM** y no permite relaciones.
Para cambiarlo, en el fichero: PROYECTO/config/database.php
Buscar tu tipo de conexión y sustituir:

```bash
'engine' => 'null', Por: 'engine' => 'InnoDB',
```

### TIPS para ejecutar migraciones de algunas tablas

-   git pull origin master
-   composer install
-   php artisan migrate --path=/database/migrations/2024_12_04_223833_create_non_working_days_table.php
-   php artisan migrate --path=/database/migrations/2024_12_15_235540_create_claim_options_table.php
-   php artisan migrate --path=/database/migrations/2024_12_16_002448_create_claim_specification_options_table.php
-   php artisan db:seed --class=ClaimOptionSeeder
-   php artisan db:seed --class=ClaimSpecificationOptionSeeder
-   php artisan holidays:sync
-   php artisan weekends:add

### Tools

-   [Calculate public holidays for a country](https://github.com/spatie/holidays?tab=readme-ov-file)
-   [Carousel AlpineJS](https://alpinejs.dev/component/carousel)
