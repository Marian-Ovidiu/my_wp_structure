@extends('layouts.mainLayout')

@section('content')
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $siteName }}</h1>
            @if (!empty($siteDescription))
                <p class="text-lg text-gray-700 mb-8">{{ $siteDescription }}</p>
            @endif

            <div class="rounded-xl border border-gray-200 bg-white p-6 mb-10">
                <h2 class="text-xl font-semibold text-gray-900 mb-3">{{ __('Starter Theme Demo', 'my_structure') }}</h2>
                <p class="text-gray-700">
                    {{ __('If you can see this page, WordPress bootstrap, Blade rendering, and the main asset bundle are working.', 'my_structure') }}
                </p>
            </div>

            <h3 class="text-2xl font-semibold text-gray-900 mb-4">{{ __('Latest Posts', 'my_structure') }}</h3>
            @if (empty($posts))
                @include('components.empty-state', ['message' => __('Create your first post to test archive rendering.', 'my_structure')])
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($posts as $postItem)
                        @include('components.card', [
                            'title' => get_the_title($postItem->ID),
                            'href' => get_permalink($postItem->ID),
                            'meta' => get_the_date('', $postItem),
                        ])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@stop
