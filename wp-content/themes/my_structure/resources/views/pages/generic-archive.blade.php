@extends('layouts.mainLayout')

@section('content')
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-8">
                {{ $title ?: __('Archive', 'my_structure') }}
            </h1>

            @if (empty($posts))
                @include('components.empty-state')
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
