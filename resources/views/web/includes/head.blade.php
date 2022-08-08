<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

    <title>{{ $page_title }} | {{ str_replace(' ','',$app_settings['application_name']) }}</title>

    <meta name="keywords" content="{{ $app_settings['keywords'] }}" />
    <meta name="description" content="{{ $app_settings['description'] }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($app_settings['fav_icon']) }}">

    <link rel="preload" href="{{ asset('web_assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('web_assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('web_assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('web_assets/fonts/wolmart-png09e.woff') }}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/css/demo8.min.css') }}">

    <script src="{{ asset('web_assets/vendor/perfect-scroll-bar/perfect-scroll-bar.min.js') }}"></script>

    <livewire:styles />

    @stack('extra-css')
</head>
