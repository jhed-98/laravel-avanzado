## Directiva @json

En ocasiones, es posible que desee pasar una matriz a una vista con la intención de representarla como JSON para inicializar una variable de JavaScript. Una forma común de hacerlo es llamando a la función de PHP **json_encode** para convertir la matriz en una cadena JSON. Sin embargo, Laravel proporciona una forma más conveniente de hacer esto usando la directiva **Illuminate\Support\Js::from**.

La directiva **Illuminate\Support\Js::from** acepta los mismos argumentos que la función **json_encode** de PHP, pero se asegurará de que el JSON resultante se escape correctamente para su inclusión dentro de las comillas HTML. Además, el método from devolverá una declaración de cadena JSON.parse de JavaScript que convertirá el objeto o la matriz dados en un objeto JavaScript válido.

Por ejemplo, en lugar de llamar a **json_encode** manualmente como en este ejemplo:

```js
<script>
    var app = <?php echo **json_encode**($array); ?>;
</script>

<script>
    var app = {!! json_encode($array) !!};
</script>
```

Se puede usar la directiva **Illuminate\Support\Js::from** de la siguiente manera:

```js
<script>
    var app = {{ **Illuminate\Support\Js::from**($array) }};
</script>
```

Además, en las últimas versiones del esqueleto de la aplicación Laravel, se incluye una fachada Js que proporciona un acceso más conveniente a esta funcionalidad dentro de las plantillas Blade:

```js
<script>
    var app = {{ Js::from($array) }};
</script>
```

Usando esta sintaxis, se puede asegurar que el JSON generado esté correctamente escapado para su uso en la salida HTML y se puede inicializar fácilmente una variable de JavaScript con los datos de la matriz pasada a la vista.

Otra forma de usar **@json** es de la siguiente manera

```js
<script> var array = @json($array); </script>
```

## Directivas condicionales

En Blade, puedes construir sentencias condicionales utilizando las directivas @if, @elseif, @else y @endif, que funcionan de manera similar a sus contrapartes en PHP. Por ejemplo:

```php
@if (count($records) === 1)
Tengo un registro.
@elseif (count($records) > 1)
Tengo varios registros.
@else
No tengo registros.
@endif
```

Además, Blade proporciona una directiva @unless para mayor comodidad:

```php
@unless (Auth::check())
	No has iniciado sesión.
@endunless
```

Otras directivas útiles son @isset y @empty, que son atajos convenientes para las funciones de PHP correspondientes:

```php
@isset($records)
// $records está definido y no es nulo...
@endisset

@empty($records)
// $records está "vacío"...
@endempty
```

## Directivas Environments

En Blade, puedes verificar si la aplicación se está ejecutando en el entorno de producción utilizando la directiva @production:

```php
@production
// Contenido específico para producción...
@endproduction
```

También puedes determinar si la aplicación se está ejecutando en un entorno específico utilizando la directiva @env. Por ejemplo:

```php
@env('staging')
// La aplicación se está ejecutando en "staging"...
@endenv

@env(['staging', 'production'])
// La aplicación se está ejecutando en "staging" o "production"...
@endenv
```

## Directiva @foreach

Además de las declaraciones condicionales, Blade proporciona directivas simples para trabajar con las estructuras de bucle de PHP. Cada una de estas directivas funciona de manera idéntica a sus contrapartes de PHP:

```php
@for ($i = 0; $i < 10; $i++)
    El valor actual es {{ $i }}
@endfor

@foreach ($users as $user)
    <p>Este es el usuario {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No hay usuarios</p>
@endforelse

@while (true)
    <p>Estoy en un bucle infinito.</p>
@endwhile
```

Con estas directivas, puedes recorrer arrays y ejecutar código repetidamente en base a una condición. En este ejemplo, @for se ejecutará 10 veces, @foreach recorrerá un array de usuarios, @forelse mostrará una lista de usuarios o un mensaje si el array está vacío, y @while ejecutará un bucle infinito.

## Continue y break

Al usar bucles, también puede omitir la iteración actual o finalizar el bucle usando las directivas @continue y @break:

```php
@foreach ($users as $user)
    @if ($user->type == 1)
        @continue
    @endif

    <li>{{ $user->name }}</li>

    @if ($user->number == 5)
        @break
    @endif
@endforeach
```

También puede incluir la condición de continuación o interrupción dentro de la declaración de la directiva:

```php
@foreach ($users as $user)
    @continue($user->type == 1)

    <li>{{ $user->name }}</li>

    @break($user->number == 5)
@endforeach
```

Estas directivas son útiles para controlar el flujo de ejecución dentro de un bucle. Con @continue, puede omitir la iteración actual si se cumple una determinada condición, mientras que @break finaliza por completo el bucle si se cumple una determinada condición.

## Variable $loop

Al utilizar un bucle foreach en Laravel, se crea automáticamente una variable de bucle llamada $loop que proporciona información valiosa sobre la iteración actual. Con esta variable, se puede acceder al índice de la iteración actual, así como verificar si es la primera o la última iteración del ciclo con las propiedades $loop->first y $loop->last respectivamente.

En el siguiente ejemplo, se utiliza el bucle foreach para iterar sobre una matriz de usuarios y mostrar su ID en un párrafo HTML.

```php
@foreach ($users as $user)
    @if ($loop->first)
        This is the first iteration.
    @endif

    @if ($loop->last)
        This is the last iteration.
    @endif

    <p>This is user {{ $user->id }}</p>
@endforeach
```

Si se está en un bucle anidado, se puede acceder a la variable $loop del bucle principal a través de la propiedad "parent". En el siguiente ejemplo, se utiliza un bucle anidado para iterar sobre los posts de cada usuario.

```php
@foreach ($users as $user)
    @foreach ($user->posts as $post)
        @if ($loop->parent->first)
            This is the first iteration of the parent loop.
        @endif
    @endforeach
@endforeach
```

Además, la variable $loop contiene otras propiedades útiles como $loop->index, que devuelve el índice de la iteración actual, $loop->iteration, que devuelve la iteración actual, $loop->remaining, que devuelve las iteraciones restantes en el ciclo, $loop->count, que devuelve el número total de elementos en la matriz que se está iterando, $loop->even, que devuelve true si se trata de una iteración par y $loop->odd, que devuelve true si es una iteración impar. Finalmente, $loop->depth devuelve el nivel de anidamiento del bucle actual.

## Directiva @class

La directiva @class permite compilar condicionalmente una cadena de clase CSS. Se le puede pasar una matriz de clases donde la clave de la matriz contiene la clase o clases que deseas agregar, mientras que el valor es una expresión booleana. Si el elemento de la matriz tiene una clave numérica, siempre se incluirá en la lista de clases representadas.

En el siguiente ejemplo, se utiliza la directiva @class para agregar diferentes clases según el estado de las variables $isActive y $hasError. También se incluye una versión estática de las clases para comparar:

```php
@php
    $isActive = false;
    $hasError = true;
@endphp

<span @class([
    'p-4',
    'font-bold' => $isActive,
    'text-gray-500' => ! $isActive,
    'bg-red' => $hasError,
])></span>

<span class="p-4 text-gray-500 bg-red"></span>
```

De manera similar, la directiva @style se puede utilizar para agregar estilos CSS en línea de forma condicional a un elemento HTML. En este ejemplo, se agrega la propiedad background-color: red y se cambia la propiedad font-weight según el valor de la variable $isActive:

```php
@php
    $isActive = true;
@endphp

<span @style([
    'background-color: red',
    'font-weight: bold' => $isActive,
])></span>

<span style="background-color: red; font-weight: bold;"></span>
```

Recuerda que utilizar estas directivas puede mejorar la legibilidad y el mantenimiento de tu código, y también puede tener un impacto positivo en la optimización para motores de búsqueda al permitirte agregar clases y estilos de forma condicional.

## Atributos adicionales

Puedes utilizar la directiva @checked para indicar si una casilla de verificación HTML está marcada, proporcionando una forma fácil de hacerlo. Esta directiva se repetirá si la condición proporcionada se evalúa como verdadera:

```php
<input type="checkbox"
        name="active"
        value="active"
        @checked(old('active', $user->active)) />
```

De manera similar, la directiva @selected puede usarse para indicar si una opción específica debe ser seleccionada en un menú desplegable. En el siguiente ejemplo, se utiliza la directiva @selected para seleccionar la opción que coincide con el valor proporcionado:

```php
<select name="version">
    @foreach ($product->versions as $version)
        <option value="{{ $version }}" @selected(old('version') == $version)>
            {{ $version }}
        </option>
    @endforeach
</select>
```

La directiva @disabled se puede utilizar para indicar si un elemento específico debe estar deshabilitado. En el siguiente ejemplo, se utiliza la directiva @disabled para deshabilitar un botón si hay errores en el formulario:

```php
<button type="submit" @disabled($errors->isNotEmpty())>Submit</button>
```

De manera similar, la directiva @readonly puede usarse para indicar si un elemento específico debe ser de solo lectura. En el siguiente ejemplo, se utiliza la directiva @readonly para hacer que un campo de correo electrónico sea de solo lectura si el usuario no es un administrador:

```php
<input type="email"
        name="email"
        value="email@laravel.com"
        @readonly($user->isNotAdmin()) />
```

Finalmente, la directiva @required se puede utilizar para indicar si un elemento específico es obligatorio. En el siguiente ejemplo, se utiliza la directiva @required para hacer que un campo de título sea obligatorio si el usuario es un administrador:

```php
<input type="text"
        name="title"
        value="title"
        @required($user->isAdmin()) />
```

Recuerda que utilizar estas directivas puede mejorar la legibilidad y el mantenimiento de tu código, y también puede tener un impacto positivo en la optimización para motores de búsqueda al permitirte indicar de manera más clara el estado y la funcionalidad de los elementos HTML en tu sitio web.

## Directiva include

La directiva @include de Blade en Laravel te permite incluir una vista de Blade dentro de otra vista. Al incluir una vista, todas las variables disponibles en la vista principal estarán disponibles en la vista incluida. Además, puedes pasar datos adicionales que deberían estar disponibles en la vista incluida.

Por ejemplo, para incluir una vista que no siempre está presente, utiliza la directiva @includeIf. Si quieres evaluar una expresión booleana y luego incluir una vista basada en el resultado, utiliza las directivas @includeWhen y @includeUnless. Por último, si deseas incluir la primera vista que existe de una matriz dada de vistas, utiliza la directiva @includeFirst.

Es importante tener en cuenta que si intentas incluir una vista que no existe, Laravel mostrará un error. Para evitar este problema, asegúrate de utilizar la ruta correcta de la vista que deseas incluir. Con la directiva @include, puedes estructurar tu código de Blade de manera más eficiente y reutilizar las vistas en múltiples lugares dentro de tu aplicación Laravel.

## Componentes de clase

Los componentes de clase en Laravel 10 son una herramienta útil para encapsular la funcionalidad de la vista en clases reutilizables y fáciles de mantener. En lugar de definir toda la lógica de presentación en una vista Blade, puedes crear un componente de clase que maneje la lógica y la reutilice en varias vistas.

Para crear un componente de clase en Laravel 10, debes crear una nueva clase que extienda la clase base de componentes de Laravel, que es Illuminate\View\Component. Esta clase debe definir un método render que devuelva la vista Blade que representa el componente.

Por ejemplo, supongamos que quieres crear un componente de clase para mostrar una lista de tareas. Primero, puedes crear una nueva clase llamada TaskList que extienda la clase base de componentes de Laravel:

```php
namespace App\View\Components;
use Illuminate\View\Component;
class TaskList extends Component
{
   public function render()
   {
       return view('components.task-list');
   }
}
```

Luego, puedes crear una vista Blade llamada 'task-list.blade.php

```php
<ul>
   @foreach ($tasks as $task)
       <li>{{ $task->name }}</li>
   @endforeach
</ul>
```

Finalmente, puedes incluir el componente de clase en una vista Blade existente llamando a la directiva 'x

```php
<x-task-list :tasks="$tasks" />
```

En este ejemplo, la variable '$tasks se pasa al componente de clase como un parámetro a través del atributo 'tasks. El componente de clase procesa los datos y muestra la lista de tareas utilizando la vista Blade 'task-list.blade.phptask-list.blade.php.

Los componentes de clase en Laravel 10 son una forma poderosa de mejorar la organización y la reutilización del código de la vista. Pueden simplificar el mantenimiento de la aplicación al encapsular la funcionalidad de la vista en clases separadas, lo que facilita la lectura y la modificación del código.

## Componentes anónimos

Los componentes en Laravel se definen como clases y se registran en un proveedor de servicios. Puedes crear componentes anónimos utilizando la sintaxis de plantilla anónima de Blade, pero no se les puede llamar componentes de clase en Laravel 10.

En versiones más recientes de Laravel, como Laravel 8 y 9, se introdujo una funcionalidad de componentes Blade anónimos. Estos componentes permiten definir plantillas Blade en línea, sin necesidad de crear una clase para cada componente. En su lugar, se puede utilizar la sintaxis de plantilla anónima para definir el componente y utilizarlo en la vista.

Para definir un componente anónimo, se utiliza la directiva @component de Blade y se proporciona el contenido del componente dentro de la directiva:

```php
@component('alert')
   <strong>¡Alerta!</strong> Algo salió mal.
@endcomponent
```

En este ejemplo, se define un componente llamado "alert" utilizando la sintaxis de plantilla anónima. El contenido del componente se proporciona entre la directiva @component y @endcomponent.

Para utilizar el componente en una vista, simplemente se llama al nombre del componente como si fuera una función:

```php
<div>
   @component('alert')
       <strong>¡Alerta!</strong> Algo salió mal.
   @endcomponent
</div>
```

Este ejemplo mostrará el componente "alert" en la vista, con el contenido proporcionado dentro de la directiva @component.

Es importante tener en cuenta que la funcionalidad de componentes anónimos se introdujo en versiones posteriores de Laravel a la versión 10.

## Componentes como plantilla

En Laravel 10, los componentes como plantilla son una forma de definir plantillas de vista reutilizables que pueden ser utilizadas en toda tu aplicación. Puedes pensar en ellos como plantillas que contienen la estructura HTML y la lógica de presentación necesarias para representar un conjunto específico de datos.

Para crear un componente como plantilla en Laravel 10, puedes utilizar el comando 'make:component

```bash
php artisan make:component MiPlantilla
```

Esto creará un archivo de clase 'MiPlantilla.php

Dentro del archivo 'MiPlantilla.php

```php
public function render()
{
   return view('components.mi-plantilla', [
       'items' => $this->items,
   ]);
}
```

En este ejemplo, el método 'render

Para utilizar el componente en una vista, puedes incluirlo utilizando la directiva 'x

```php
<x-mi-plantilla :items="$items" />
```

En este ejemplo, el componente 'MiPlantilla

En resumen, los componentes como plantilla en Laravel 10 son una forma poderosa de crear plantillas de vista reutilizables que pueden ser utilizadas en toda tu aplicación. Con la sintaxis Blade de Laravel 10 y el comando 'make:component

## Herencia de plantillas Blade

En Laravel 10, la herencia de plantillas Blade es una forma poderosa de estructurar y organizar las vistas de tu aplicación. La herencia de plantillas te permite crear una plantilla base para tus vistas, con secciones que se pueden rellenar con contenido específico en cada vista.

Para utilizar la herencia de plantillas en Laravel 10, debes seguir los siguientes pasos:

1.  Crear una plantilla base: Crea una plantilla base para tus vistas, que contenga el contenido común que deseas mostrar en todas las páginas de tu aplicación. Esta plantilla base puede ser tan simple o compleja como desees, pero debe contener las secciones que deseas rellenar con contenido específico en cada vista.
    Por ejemplo, puedes crear un archivo 'app.blade.phpresources/views/layouts con el siguiente contenido:

        ```php
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        </head>
        <body>
        <div class="container">
            @yield('content')
        </div>
        </body>
        </html>
        ```

        Este archivo define una plantilla base que contiene un título y un contenedor principal que se rellenará con contenido específico en cada vista.

2.  Extender la plantilla base: Crea una nueva vista que extienda la plantilla base que acabas de crear. Para extender la plantilla base, utiliza la directiva '@extends

    Por ejemplo, puedes crear una nueva vista llamada 'welcome.blade.php

    ```php
    @extends('layouts.app')
    @section('title', 'Welcome')
    @section('content')
    <h1>Welcome to my app!</h1>
    <p>This is the home page.</p>
    @endsection
    ```

    Este archivo extiende la plantilla base 'app.blade.php

3.  Rellenar las secciones: En la plantilla base, utiliza la directiva '@yield

    En el ejemplo anterior, la plantilla base 'app.blade.php

    Al utilizar la herencia de plantillas en Laravel 10, puedes crear vistas reutilizables y fáciles de mantener en tu aplicación. Puedes crear una plantilla base con la estructura y el diseño de tu aplicación, y luego extenderla en cada vista para proporcionar el contenido específico de la página.
