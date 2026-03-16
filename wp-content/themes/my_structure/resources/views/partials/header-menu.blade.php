@php($branding = get_theme_branding())

<header x-data="{ open: false }" class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex min-h-16 max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ $branding['home_url'] }}" class="flex items-center gap-3 text-gray-900">
            @if (!empty($branding['logo_url']))
                <img src="{{ $branding['logo_url'] }}" alt="{{ $branding['logo_alt'] }}" class="h-10 w-auto" loading="eager">
            @endif
            <span class="text-lg font-semibold">{{ $branding['title'] }}</span>
        </a>

        <button @click="open = !open" class="rounded-md p-2 lg:hidden" type="button" aria-label="Toggle menu">
            <span x-show="!open">Menu</span>
            <span x-show="open">Close</span>
        </button>

        @include('components.navigation-menu', [
            'menu' => $menu,
            'navClass' => 'hidden lg:block',
            'listClass' => 'flex items-center gap-6',
            'linkClass' => 'text-sm font-medium text-gray-700 hover:text-gray-900',
        ])
    </div>

    <div x-show="open" class="border-t border-gray-100 px-4 py-4 lg:hidden">
        @include('components.navigation-menu', [
            'menu' => $menu,
            'listClass' => 'flex flex-col gap-3',
            'linkClass' => 'text-sm font-medium text-gray-700 hover:text-gray-900',
        ])
    </div>
</header>
