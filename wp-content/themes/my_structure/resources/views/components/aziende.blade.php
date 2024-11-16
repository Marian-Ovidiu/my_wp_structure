<section class="relative py-10 overflow-hidden bg-black sm:py-16 lg:py-24 xl:py-32">
    <div class="absolute inset-0">
        <img class="object-cover w-full h-full md:object-left md:scale-150 md:origin-top-left" src="{{$immagine['url']}}" alt="" />
    </div>
    <div class="absolute inset-0 hidden bg-gradient-to-r md:block from-black to-transparent"></div>
    <div class="absolute inset-0 block bg-black/60 md:hidden"></div>

    <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="text-center {{  $class ?? 'md:w-2/3 lg:w-1/2 xl:w-1/3' }} md:text-left">
            <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">{{$titolo}}</h2>
            <p class="mt-4 text-base text-gray-200"> {!! $descrizione !!}</p>
            @if(isset($cta))
                <div class="flex items-center justify-center px-3 py-2">
                    <a href="{{$cta['url']}}"
                       class="inline-flex items-center justify-center w-full px-4 py-2.5 overflow-hidden text-sm
                   text-custom-dark-green transition-colors duration-300 bg-custom-light-green rounded-lg
                   shadow sm:w-auto sm:mx-2 sm:mt-0 hover:bg-custom-green hover:text-white focus:ring
                   focus:bg-custom-light-green focus:ring-opacity-80">
                        @include('svg.gallery')
                        <span class="mx-2">
                        {{$cta['title']}}
                    </span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>