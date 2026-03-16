@props([
    'title' => null,
    'containerClass' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8',
    'sectionClass' => 'py-12 md:py-20 bg-white',
])

<section class="{{ $sectionClass }}">
    <div class="{{ $containerClass }}">
        @if ($title)
            <h2 class="mb-10 text-3xl font-semibold text-gray-900 md:mb-12 md:text-4xl">
                {{ $title }}
            </h2>
        @endif

        {{ $slot }}
    </div>
</section>
