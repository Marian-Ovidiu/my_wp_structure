@php($branding = get_theme_branding())

<footer class="border-t border-gray-200 bg-white">
    <div class="mx-auto w-full max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold text-gray-900">{{ $branding['title'] }}</p>
        <p class="mt-2 text-xs text-gray-500">&copy; {{ date('Y') }} {{ $branding['title'] }}.</p>
    </div>
</footer>
