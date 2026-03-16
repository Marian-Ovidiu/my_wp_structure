@props([
    'title' => null,
    'href' => null,
    'meta' => null,
])

<article class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
    @if ($title)
        <h3 class="mb-2 text-xl font-semibold text-gray-900">
            @if ($href)
                <a href="{{ $href }}" class="hover:underline">{{ $title }}</a>
            @else
                {{ $title }}
            @endif
        </h3>
    @endif

    @if ($meta)
        <p class="text-sm text-gray-600">{{ $meta }}</p>
    @endif

    {{ $slot }}
</article>
