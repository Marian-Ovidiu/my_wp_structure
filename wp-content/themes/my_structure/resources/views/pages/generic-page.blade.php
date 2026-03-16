@extends('layouts.mainLayout')

@section('content')
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl sm:text-4xl font-bold text-custom-dark-green mb-6">
                {{ $title }}
            </h1>
            <div class="prose max-w-none">
                {!! $content !!}
            </div>
        </div>
    </section>
@stop
