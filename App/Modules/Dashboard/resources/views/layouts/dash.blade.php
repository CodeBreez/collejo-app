<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    @include('base::layouts.partials.head')

    <body>

        @include('dashboard::menu.menubar')

        <div class="dash-content container-fluid">
            @yield('content')
        </div>

        @include('base::layouts.partials.footer')

    </body>
</html>
