@php($branding = get_theme_branding())

<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex min-h-16 w-full max-w-5xl items-center px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ $branding['home_url'] }}" class="flex items-center gap-3 text-gray-900">
            @if (!empty($branding['logo_url']))
                <img src="{{ $branding['logo_url'] }}" alt="{{ $branding['logo_alt'] }}" class="h-10 w-auto" loading="eager">
            @endif
            <span class="text-lg font-semibold">{{ $branding['title'] }}</span>
        </a>
    </div>
</header>
