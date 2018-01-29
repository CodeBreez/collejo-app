<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    @section('styles')
        @parent
        <link href="{{ mix('/assets/dashboard/css/module.css') }}" rel="stylesheet" type="text/css">
    @endsection

    @include('base::layouts.partials.head')

    <body>

        @include('dashboard::menu.menubar')

        <div class="breadcrumbs">

            @yield('breadcrumbs')

        </div>

        <div class="dash-content container-fluid">

            @yield('content')

        </div>

        @section('scripts')
            @parent
            <script type="text/javascript" src="{{ mix('/assets/dashboard/js/navbar.js') }}"></script>
        @endsection

        @include('base::layouts.partials.footer')

    </body>
</html>
