@php($branding = get_theme_branding())

<footer class="border-t border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-900">{{ $branding['title'] }}</p>
                @if (!empty($branding['subtitle']))
                    <p class="text-sm text-gray-600">{{ $branding['subtitle'] }}</p>
                @endif
            </div>

            @include('components.navigation-menu', [
                'menu' => $menu,
                'listClass' => 'flex flex-wrap gap-4',
                'linkClass' => 'text-sm text-gray-700 hover:text-gray-900',
            ])
        </div>

        <p class="mt-8 text-xs text-gray-500">
            &copy; {{ date('Y') }} {{ $branding['title'] }}.
        </p>
    </div>
</footer>
