<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-neutral-900 bg-neutral-50 dark:text-neutral-50 dark:bg-neutral-950">
        <x-banner />

        <x-ui.layout variant="sidebar-main" collapsable>
            <x-ui.sidebar>
                <x-slot name="brand">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-2 py-2">
                        <x-application-mark class="block h-8 w-auto" />
                        <span data-slot="brand-name" class="text-sm font-semibold text-neutral-900 dark:text-white">
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </a>
                </x-slot>

                <x-ui.navlist class="mt-2">
                    <x-ui.navlist.item
                        icon="home"
                        :label="__('Dashboard')"
                        href="{{ route('dashboard') }}"
                        :active="request()->routeIs('dashboard')"
                        x-on:click="closeSidebar()"
                    />

                    <x-ui.navlist.item
                        icon="user-circle"
                        :label="__('Profile')"
                        href="{{ route('profile.show') }}"
                        :active="request()->routeIs('profile.show')"
                        x-on:click="closeSidebar()"
                    />

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-ui.navlist.item
                            icon="key"
                            :label="__('API Tokens')"
                            href="{{ route('api-tokens.index') }}"
                            :active="request()->routeIs('api-tokens.index')"
                            x-on:click="closeSidebar()"
                        />
                    @endif
                </x-ui.navlist>

                <x-ui.sidebar.push />
            </x-ui.sidebar>

            <x-ui.layout.main>
                <x-ui.layout.header>
                    <div class="flex items-center w-full gap-3 px-2">
                        <x-ui.sidebar.toggle class="lg:hidden" />

                        @if (isset($header))
                            <x-ui.heading size="md">
                                {{ $header }}
                            </x-ui.heading>
                        @endif

                        <div class="flex-1"></div>

                        <x-ui.navbar class="flex-1">
                            <x-ui.navbar.item
                                icon="home"
                                :label="__('Dashboard')"
                                href="{{ route('dashboard') }}"
                                :active="request()->routeIs('dashboard')"
                            />

                            <x-ui.navbar.item
                                icon="user-circle"
                                :label="__('Profile')"
                                href="{{ route('profile.show') }}"
                                :active="request()->routeIs('profile.show')"
                            />

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-ui.navbar.item
                                    icon="key"
                                    :label="__('API Tokens')"
                                    href="{{ route('api-tokens.index') }}"
                                    :active="request()->routeIs('api-tokens.index')"
                                />
                            @endif
                        </x-ui.navbar>

                        <div class="flex items-center gap-2">
                            <x-ui.theme-switcher variant="dropdown" />

                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        type="button"
                                        class="inline-flex items-center justify-center size-9 rounded-full border border-black/10 bg-white dark:bg-neutral-900 dark:border-white/10 hover:bg-neutral-900/5 dark:hover:bg-white/10 transition"
                                        aria-label="{{ __('Account menu') }}"
                                    >
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                            <img class="size-7 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        @else
                                            <x-ui.icon name="user-circle" class="size-6" />
                                        @endif
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-neutral-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-black/10 dark:border-white/10 my-1"></div>

                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}"
                                                 @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </x-ui.layout.header>

                <div class="p-6">
                    {{ $slot }}
                </div>
            </x-ui.layout.main>
        </x-ui.layout>

        @stack('modals')

        @livewireScripts
    </body>
</html>
