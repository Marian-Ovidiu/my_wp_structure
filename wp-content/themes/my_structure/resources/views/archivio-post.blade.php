@extends('layouts.mainLayout')

@section('content')
    <section class="relative bg-gradient-to-b from-[#f5fef4] to-[#ffffff] py-20 sm:py-24 lg:py-28 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none"
            style="background-image: url('/images/pattern-leaves.svg'); background-repeat: repeat; background-size: 400px;">
        </div>

        <div class="relative z-10 px-4 mx-auto max-w-4xl text-center sm:px-6 lg:px-8 animate-fadeIn">
            <h1
                class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-custom-dark-green font-nunitoBold leading-tight drop-shadow-sm">
                Diario di bordo
            </h1>
            <div class="mx-auto mt-4 max-w-2xl">
                <p class="text-lg sm:text-xl text-custom-dark-green font-nunitoRegular opacity-90">
                    Storie vere, emozioni autentiche. Un viaggio tra le speranze e le sfide delle comunità africane.
                </p>
            </div>
            <div class="mt-6 mx-auto w-24 h-1 bg-custom-green rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 gap-10 mt-16 sm:grid-cols-2 lg:grid-cols-3">
            <article
                class="bg-white border border-[#e1f5d8] rounded-2xl shadow-sm hover:shadow-xl transition duration-300 ease-in-out overflow-hidden animate-fadeInUp">
                <a href="#" class="block w-full aspect-w-4 aspect-h-3 bg-gray-100 overflow-hidden">
                    <img src="https://cdn.rareblocks.xyz/collection/celebration/images/blog/1/blog-post-1.jpg"
                        alt="Blog Image" class="object-cover w-full h-full" />
                </a>
                <div class="p-6">
                    <span
                        class="inline-block px-3 py-1 text-xs font-medium text-custom-dark-green bg-custom-green bg-opacity-20 rounded-full uppercase tracking-wide font-nunitoSansLight">Ghana</span>
                    <h2
                        class="mt-3 text-xl font-semibold text-custom-dark-green hover:text-custom-green transition font-nunitoBold">
                        <a href="#">Ghana: un dormitorio per il futuro dell’educazione</a>
                    </h2>
                    <p class="mt-3 text-[#5c4433] text-sm leading-relaxed font-nunitoRegular">
                     In una piccola comunità scolastica del Ghana, un cambiamento concreto sta prendendo forma: convertire i dormitori esistenti con letti a castello, per garantire alloggio a un numero sempre maggiore di studenti.
                    </p>
                    <div class="mt-5 text-sm text-[#967148] font-nunitoSansRegular">
                        Scritto da <strong>Marian Ov.</strong> · 26 Mag 2025
                    </div>
                </div>
            </article>
            <article
                class="bg-white border border-[#e1f5d8] rounded-2xl shadow-sm hover:shadow-xl transition duration-300 ease-in-out overflow-hidden animate-fadeInUp">
                <a href="#" class="block w-full aspect-w-4 aspect-h-3 bg-gray-100 overflow-hidden">
                    <img src="http://pac.localhost/wp-content/uploads/2025/05/WhatsApp-Image-2025-05-26-at-16.00.51-2.jpeg"
                        alt="Blog Image" class="object-cover w-full h-full" />
                </a>
                <div class="p-6">
                    <span
                        class="inline-block px-3 py-1 text-xs font-medium text-custom-dark-green bg-custom-green bg-opacity-20 rounded-full uppercase tracking-wide font-nunitoSansLight">Ghana</span>
                    <h2
                        class="mt-3 text-xl font-semibold text-custom-dark-green hover:text-custom-green transition font-nunitoBold">
                        <a href="#">Infiltrazioni nei tetti in Ghana: come affrontiamo le sfide strutturali delle scuole</a>
                    </h2>
                    <p class="mt-3 text-[#5c4433] text-sm leading-relaxed font-nunitoRegular">
                        Dopo mesi di attesa, i bambini del villaggio possono finalmente bere acqua pulita. È solo l'inizio
                        di una nuova speranza.
                    </p>
                    <div class="mt-5 text-sm text-[#967148] font-nunitoSansRegular">
                         Scritto da <strong>Marian Ov.</strong> · 26 Mag 2025
                    </div>
                </div>
            </article>
    </section>

@stop
