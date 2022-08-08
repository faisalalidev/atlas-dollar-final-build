<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ $page_title }} | {{ str_replace(' ','',$app_settings['application_name']) }}</title>

    <link href="{{ asset($app_settings['fav_icon']) }}" rel="shortcut icon" type="image/x-icon">

    <link rel='stylesheet' href="{{ asset('admin_assets/admin/css/bootstrap.css') }}">

    <link rel='stylesheet' href={{ asset('admin_assets/admin/css/dataTables.bootstrap4.min.css') }}>

    <link href="{{ asset('admin_assets/admin/css/bootstrap-v=1.1.css') }}" rel="stylesheet" type="text/css"/>

    <!-- custom style -->
    <link href="{{ asset('admin_assets/admin/css/ui-v=1.1.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_assets/admin/css/responsive-v=1.1.css') }}" rel="stylesheet" />

    <!-- iconfont -->
    <link rel="stylesheet" href="{{ asset('admin_assets/admin/fonts/material-icon/css/round.css') }}"/>

    <link rel="stylesheet" href="{{ asset('admin_assets/admin/css/pace-theme-default.min.css') }}">

    <script src="{{ asset('admin_assets/admin/js/pace.min.js') }}"></script>

    @stack('extra-css')

</head>
