<section class="bg-white">
    <div class="container flex flex-col items-center px-4 py-8 mx-auto text-center">
        @if($titolo)
            <h2 class="text-2xl font-bold tracking-tight text-custom-dark-green xl:text-3xl">
                {{$titolo}}
            </h2>
        @endif
        @if($sottotitolo)
            <p class="block max-w-4xl mt-4 text-gray-500">
                {{$sottotitolo}}
            </p>
        @endif
    </div>
</section>