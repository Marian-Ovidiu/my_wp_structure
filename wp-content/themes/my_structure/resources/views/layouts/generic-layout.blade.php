<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', get_locale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', get_bloginfo('description'))">
    <title>@yield('title', get_bloginfo('name'))</title>
    <?php wp_head(); ?>
</head>
<body class="flex min-h-screen flex-col font-sans">
    @include('partials.generic-header')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.generic-footer')
    <?php wp_footer(); ?>
</body>
</html>
