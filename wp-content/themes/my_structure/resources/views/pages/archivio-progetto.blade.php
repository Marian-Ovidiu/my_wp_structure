@extends('layouts.mainLayout')
@section('content')
    @php
        $img = $opzioniArchivio->immagine_hero ?? [];
        $typingTextHero = array_filter(['una missione', 'una passione', 'una dedizione']);
        $typingTitoliH3 = array_filter([
            $opzioniArchivio->highlights_frase_1 ?? null,
            $opzioniArchivio->highlights_frase_2 ?? null,
            $opzioniArchivio->highlights_frase_3 ?? null,
        ]);
    @endphp

    <section class="relative bg-black">
        @if (!empty($img['url']))
            <div class="absolute inset-0 z-0">
                <img src="{{ $img['url'] }}" alt="{{ $img['alt'] ?? '' }}" title="{{ $img['title'] ?? '' }}"
                    width="{{ $img['width'] ?? '' }}" height="{{ $img['height'] ?? '' }}"
                    aria-label="{{ $img['description'] ?? ($img['alt'] ?? '') }}" loading="lazy"
                    class="w-full h-full object-cover brightness-[.7] transition-all duration-300 ease-in-out" />
            </div>
        @endif

        <div class="absolute inset-0 bg-black/10 sm:bg-black/20 z-10"></div>
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36">
            <div class="text-center sm:text-left max-w-3xl">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white drop-shadow-md mb-4 leading-tight">
                    {{ $opzioniArchivio->titolo_hero }}
                </h1>
                <div x-data="typingEffect({{ json_encode($typingTextHero) }})" class="relative text-white">
                    <p x-text="displayText"
                        class="text-xl sm:text-2xl lg:text-3xl font-medium transition-opacity duration-300"></p>
                    <span class="absolute opacity-0 pointer-events-none text-xl sm:text-2xl lg:text-3xl font-medium">
                        {{ collect($typingTextHero)->sortByDesc(fn($t) => strlen($t))->first() }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <div class="container flex justify-center pt-6">
        <h3 class="sr-only">{{ $typingTitoliH3[0] ?? '' }}</h3>
        <div x-data="typingEffect({{ json_encode($typingTitoliH3) }})" class="mb-2 h-8 text-center">
            <template x-for="(text, index) in texts" :key="index">
                <span x-show="currentText === index" x-text="displayText"
                    class="text-lg sm:text-xl lg:text-2xl font-semibold text-custom-dark-green" x-transition.opacity></span>
            </template>
            <span class="text-lg sm:text-xl lg:text-2xl text-custom-dark-green animate-blink">|</span>
        </div>
    </div>

    @include('components.testo-sottotesto', [
        'titolo' => '',
        'sottotitolo' => $opzioniArchivio->testo_sotto_hero,
        'immagine_url' => $opzioniArchivio->immagine_sotto_hero['url'] ?? null,
        'immagine_alt' => $opzioniArchivio->immagine_sotto_hero['alt'] ?? null,
        'immagine_title' => $opzioniArchivio->immagine_sotto_hero['title'] ?? null,
        'immagine_caption' => $opzioniArchivio->immagine_sotto_hero['caption'] ?? null,
        'immagine_description' => $opzioniArchivio->immagine_sotto_hero['description'] ?? null,
    ])

    @foreach ($progetti as $progetto)
        <section class="py-10 sm:py-16 lg:py-24">
            <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 md:items-stretch gap-y-5">
                    <figure class="relative py-4">
                        <img src="{{ $progetto->featured_image }}" alt="{{ $progetto->titolo_card }}"
                            title="{{ $progetto->titolo_card }}"
                            class="object-cover w-full h-full md:object-left md:origin-top-left" loading="lazy"
                            decoding="async" />
                        <div class="absolute inset-0 bg-black/10 sm:bg-black/20 z-10"></div>
                        <div
                            class="absolute inset-0 z-20 flex items-center justify-center md:justify-start px-4 sm:px-6 lg:px-8">
                            <div class="max-w-3xl text-center md:text-left">
                                <h4 class="font-bold text-white text-3xl lg:text-4xl leading-tight">
                                    {{ $progetto->titolo_card }}
                                </h4>
                                <p class="mt-4 text-sm text-gray-200">{!! $progetto->content !!}</p>
                            </div>
                        </div>
                    </figure>

                    <div class="w-full max-w-xl mx-auto bg-white rounded-xl shadow-xl py-8 px-6">
                        <h2 class="text-2xl font-bold text-custom-dark-green mb-4">
                            {{ load_static_strings('Support this project') }}
                        </h2>
                        <p class="text-gray-700 mb-6">
                            {{ load_static_strings('Donations are currently unavailable in this theme build.') }}
                        </p>
                        <a href="{{ $progetto->url }}"
                            class="inline-block rounded-full px-6 py-3 bg-custom-dark-green text-white font-bold transition hover:translate-y-1">
                            {{ load_static_strings('Read project details') }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@stop
