@php
    $rawGroups = [
        'Platform' => [
            [
                'name' => 'Dashboard',
                'icon' => 'home',
                'url' => route('dashboard'),
                'current' => request()->routeIs('dashboard'),
                'can' => 'dashboard'
            ],
            [
                'name' => 'Personal',
                'icon' => 'briefcase',
                'url' => route('admin.staffs.index'),
                'current' => request()->routeIs('admin.staffs.*'),
                'can' => 'admin.staffs.index'
            ],
            [
                'name' => 'Memorandums',
                'icon' => 'document-minus',
                'url' => route('admin.memos.index'),
                'current' => request()->routeIs('admin.memos.*'),
                'can' => 'admin.memos.index'
            ],
            [
                'name' => 'Proyectos',
                'icon' => 'presentation-chart-line',
                'url' => route('admin.projects.index'),
                'current' => request()->routeIs('admin.projects.*'),
                'can' => 'admin.projects.index'
            ],
            [
                'name' => 'Bienes Nacionales',
                'icon' => 'squares-plus',
                'url' => route('admin.national_assets.index'),
                'current' => request()->routeIs('admin.national_assets.*'),
                'can' => 'admin.national_assets.index'
            ],
            [
                'name' => 'Especificar Componentes',
                'icon' => 'squares-plus',
                'url' => route('admin.components.index'),
                'current' => request()->routeIs('admin.components.*'),
                'can' => 'admin.components.index'
            ],
            [
                'name' => 'Herramientas y Consumibles',
                'icon' => 'wrench-screwdriver',
                'url' => route('admin.tools.index'),
                'current' => request()->routeIs('admin.tools.*'),
                'can' => 'admin.tools.index'
            ]
        ],
        'Configuracion' => [
            [
                'name' => 'Unidades Administrativas',
                'icon' => 'building-office',
                'url' => route('admin.departments.index'),
                'current' => request()->routeIs('admin.departments.*'),
                'can' => 'admin.departments.index'
            ],
            [
                'name' => 'Categorias',
                'icon' => 'tag',
                'url' => route('admin.categories.index'),
                'current' => request()->routeIs('admin.categories.*'),
                'can' => 'admin.categories.index' // Changed to a more specific 'can' for categories
            ],
            [
                'name' => 'Clasificacion de Bienes',
                'icon' => 'tag',
                'url' => route('admin.classifications.index'),
                'current' => request()->routeIs('admin.classifications.*'),
                'can' => 'admin.classifications.index'
            ],
            [
                'name' => 'Responsables',
                'icon' => 'user-group',
                'url' => route('admin.managers.index'),
                'current' => request()->routeIs('admin.managers.*'),
                'can' => 'admin.managers.index'
            ],
            [
                'name' => 'Usuarios',
                'icon' => 'user',
                'url' => route('admin.users.index'),
                'current' => request()->routeIs('admin.users.*'),
                'can' => 'admin.users.index'
            ]
        ]
    ];

    $groups = []; // Initialize the filtered groups array

    foreach ($rawGroups as $groupName => $links) {
        $filteredLinks = [];
        foreach ($links as $link) {
            // Check if 'can' permission exists and the user has it, or if 'can' is not set
            if (!isset($link['can']) || (auth()->check() && auth()->user()->can($link['can']))) {
                $filteredLinks[] = $link;
            }
        }
        // Only add the group to the final $groups array if it has accessible links
        if (!empty($filteredLinks)) {
            $groups[$groupName] = $filteredLinks;
        }
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                @foreach ($groups as $group => $links)
                    {{-- The group heading will only appear if $links is not empty --}}
                    <flux:navlist.group :heading="$group" class="grid">
                        @foreach ($links as $link)
                            {{-- No need for @can here as the filtering is done above --}}
                            <flux:navlist.item :icon="$link['icon']" :href="$link['url']" :current="$link['current']" wire:navigate>{{$link['name']}}</flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                @endforeach
            </flux:navlist>

            <flux:spacer />

            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>