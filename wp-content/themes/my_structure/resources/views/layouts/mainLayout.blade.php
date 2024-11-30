<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Sito ufficiale PAC - Project Africa Conservation, dedicato alla protezione della fauna e allo sviluppo sociale.')">
    <title>@yield('title', 'PAC - Project Africa Conservation')</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    @yield('head')
</head>
<body class="flex flex-col min-h-screen font-nunitoSansRegular">
   <?php wp_head(); ?>
    @widget('LanguageMenu')
    @switch(pll_current_language())
        @case('it')
            @widget('HeaderMenu')
            @break
        @case('en')
            @widget('HeaderMenuEnglish')
            @break
        @case('fr')
            @widget('HeaderMenuFrancais')
            @break
        @case('de')
            @widget('HeaderMenuDeutsch')
            @break
        @default
            @widget('HeaderMenu')
            @break
    @endswitch

    <main class="flex-grow main">
        @yield('content')
    </main>

    <footer class="text-white">
        @widget('FooterMenu')
    </footer>
    @yield('scripts')
   <?php wp_footer(); ?>
</body>
</html>
