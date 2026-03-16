<footer class="border-t border-gray-200 bg-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-900">{{ get_bloginfo('name') }}</p>
                <p class="text-sm text-gray-600">{{ get_bloginfo('description') }}</p>
            </div>

            <nav class="flex flex-wrap gap-4">
                @foreach ($menu as $item)
                    <a href="{{ $item->url }}" class="text-sm text-gray-700 hover:text-gray-900">
                        {{ $item->title }}
                    </a>
                @endforeach
            </nav>
        </div>

        <p class="mt-8 text-xs text-gray-500">
            &copy; {{ date('Y') }} {{ get_bloginfo('name') }}.
        </p>
    </div>
</footer>
