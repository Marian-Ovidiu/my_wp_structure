<?php
/**
 * @var object $progetto
 */
?>
@php
    $img = $progetto->immagine_hero ?? [];
@endphp
@extends('layouts.mainLayout')
@section('content')
    <section class="relative">
        <div class="absolute inset-0 -z-10">
            <img src="{!! $img['url'] !!}" alt="{{ $img['alt'] ?? $progetto->titolo_hero }}"
                class="w-full h-full object-cover object-top" loading="eager" decoding="async" width="1920" height="1080">
            <div class="absolute inset-0 bg-black/25"></div>
        </div>

        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 sm:py-40">
            <div class="max-w-3xl mx-auto text-center sm:text-left rounded-xl px-6 py-8 shadow-2xl">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight drop-shadow-xl">
                    {{ $progetto->titolo_hero }}
                </h1>
                <div class="mt-6 text-base sm:text-lg text-gray-200 prose prose-invert max-w-none">
                    {!! $progetto->testo_hero !!}
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto">
        @component('components.section', [
            'titolo' => $progetto->problemi_titolo_1,
            'items' => $progetto->getProblemi(),
        ])
        @endcomponent

        @component('components.section', [
            'titolo' => $progetto->soluzioni_titolo_1,
            'items' => $progetto->getSoluzioni(),
        ])
        @endcomponent
    </section>

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
                    <a href="{{ get_post_type_archive_link('progetto') }}"
                        class="inline-block rounded-full px-6 py-3 bg-custom-dark-green text-white font-bold transition hover:translate-y-1">
                        {{ load_static_strings('Back to projects') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@stop
