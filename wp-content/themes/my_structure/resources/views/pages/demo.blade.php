@extends('layouts.generic-layout')

@section('content')
    <section class="px-4 py-16 sm:px-6 lg:px-12">
        <div class="mx-auto max-w-3xl rounded-xl border border-gray-200 bg-white p-8">
            <h1 class="text-3xl font-bold text-gray-900">{{ $siteName }}</h1>
            @if (!empty($siteDescription))
                <p class="mt-3 text-gray-700">{{ $siteDescription }}</p>
            @endif
            <p class="mt-6 text-sm text-gray-600">
                {{ __('Minimal runtime path is active: WordPress bootstrap, Blade rendering, and Vite assets are loaded without optional feature modules.', 'my_structure') }}
            </p>
        </div>
    </section>
@stop
