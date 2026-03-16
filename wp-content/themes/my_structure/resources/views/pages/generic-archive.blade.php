@extends('layouts.mainLayout')

@section('content')
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-bold text-custom-dark-green mb-8">
                {{ $title ?: load_static_strings('Archive') }}
            </h1>

            @if (empty($posts))
                <p>{{ load_static_strings('No content found.') }}</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($posts as $postItem)
                        <article class="border rounded-xl p-6 bg-white shadow-sm">
                            <h2 class="text-xl font-semibold mb-2">
                                <a href="{{ get_permalink($postItem->ID) }}">{{ get_the_title($postItem->ID) }}</a>
                            </h2>
                            <p class="text-sm text-gray-600">
                                {{ get_the_date('', $postItem) }}
                            </p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@stop
