<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="token" content="{{ csrf_token() }}">
    <link rel="icon" href="/favicon.ico">

    <title>@yield('title') - Collejo</title>

    <link href="{{ mix('/assets/base/css/app.css') }}" rel="stylesheet" type="text/css">

    @yield('styles')

    <script type="text/javascript" src="{{ mix('/assets/base/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ mix('/assets/base/js/routes.js') }}"></script>

</head>