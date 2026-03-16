<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', get_locale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', get_bloginfo('description'))">
    <title>@yield('title', get_bloginfo('name'))</title>
    <link rel="canonical" href="{{ get_permalink() }}">
    @yield('head')
</head>
<body class="flex flex-col min-h-screen font-sans">
    <?php wp_head(); ?>
    @widget('HeaderMenu')

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
