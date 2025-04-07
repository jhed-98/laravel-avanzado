@php
    $links = [
        [
            'name' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'active' => Route::is('admin.dashboard'),
            'icon' => 'fa-solid fa-gauge-high',
            'can' => ['Acceso panel'],
        ],
        [
            'name' => 'Categories',
            'url' => route('admin.categories.index'),
            'active' => Route::is('admin.categories.*'),
            'icon' => 'fa-solid fa-inbox',
            'can' => ['Gestion de categorias'],
        ],
        [
            'name' => 'Articulos',
            'url' => route('admin.posts.index'),
            'active' => Route::is('admin.posts.*'),
            'icon' => 'fa-solid fa-blog',
            'can' => ['Gestion de articulos'],
        ],
        [
            'name' => 'Roles',
            'url' => route('admin.roles.index'),
            'active' => Route::is('admin.roles.*'),
            'icon' => 'fa-solid fa-user-tag',
            'can' => ['Gestion de roles'],
        ],
        [
            'name' => 'Permisos',
            'url' => route('admin.permissions.index'),
            'active' => Route::is('admin.permissions.*'),
            'icon' => 'fa-solid fa-key',
            'can' => ['Gestion de permisos'],
        ],
        [
            'name' => 'Usuarios',
            'url' => route('admin.users.index'),
            'active' => Route::is('admin.users.*'),
            'icon' => 'fa-solid fa-users',
            'can' => ['Gestion de usuarios'],
        ],
    ];
@endphp
<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                @canany($link['can'] ?? [null])
                    <li>
                        <a href="{{ $link['url'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-300' : '' }}">
                            <i class="{{ $link['icon'] }}"></i>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    </li>
                @endcan
            @endforeach
        </ul>
    </div>
</aside>
