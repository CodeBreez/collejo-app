<!DOCTYPE html>
<html lang="en">

    @include('collejo::layouts.partials.head')

    <body>

        @include('collejo::dash.menu.menubar')

        <div class="dash-content container-fluid">
            @yield('content')
        </div>
    
    </body>
</html>
