<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    @include('base::layouts.partials.head')

    @section('styles')
        @parent
        <link href="{{ mix('/assets/dashboard/css/module.css') }}" rel="stylesheet" type="text/css">
    @endsection

    <body>

        @include('dashboard::menu.menubar')

        <div class="dash-content container-fluid">
            <div class="section">
                @yield('content')
            </div>
        </div>

        @section('scripts')
            @parent
            <script type="text/javascript" src="{{ mix('/assets/dashboard/js/navbar.js') }}"></script>
        @endsection

        @include('base::layouts.partials.footer')

    </body>
</html>
