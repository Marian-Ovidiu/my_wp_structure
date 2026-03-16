<header x-data="{ open: false }" class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <a href="{{ home_url('/') }}" class="text-lg font-semibold text-gray-900">
            {{ get_bloginfo('name') }}
        </a>

        <button @click="open = !open" class="rounded-md p-2 lg:hidden" type="button" aria-label="Toggle menu">
            <span x-show="!open">Menu</span>
            <span x-show="open">Close</span>
        </button>

        <nav class="hidden items-center gap-6 lg:flex">
            @foreach ($menu as $item)
                <a href="{{ $item->url }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">
                    {{ $item->title }}
                </a>
            @endforeach
        </nav>
    </div>

    <nav x-show="open" class="border-t border-gray-100 px-4 py-4 lg:hidden">
        <div class="flex flex-col gap-3">
            @foreach ($menu as $item)
                <a href="{{ $item->url }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">
                    {{ $item->title }}
                </a>
            @endforeach
        </div>
    </nav>
</header>
