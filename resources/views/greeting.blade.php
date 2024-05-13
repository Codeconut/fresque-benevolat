<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('/images/favicon.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    Hello World

    Image test with URL::asset
    <img src="{{URL::asset('/images/illustrations/hero-green.png')}}" alt="Image test">
    Image test with absolute path
    <img src="/images/illustrations/hero-green.png" alt="Image test">
</body>

</html>
