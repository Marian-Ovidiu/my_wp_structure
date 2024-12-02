<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Sito ufficiale PAC - Project Africa Conservation, dedicato alla protezione della fauna e allo sviluppo sociale.')">
    <title>@yield('title', 'PAC - Project Africa Conservation')</title>
    <link rel="manifest" href="/site.webmanifest">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
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
        @switch(pll_current_language())
            @case('it')
                @widget('FooterMenu')
                @break
            @case('en')
                @widget('FooterMenuEnglish')
                @break
            @case('fr')
                @widget('FooterMenuFrancais')
                @break
            @case('de')
                @widget('FooterMenuDeutsch')
                @break
            @default
                @widget('FooterMenu')
                @break
        @endswitch
    </footer>
    @yield('scripts')
   <?php wp_footer(); ?>
</body>
</html>
