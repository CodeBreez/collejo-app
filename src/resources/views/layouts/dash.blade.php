<!DOCTYPE html>
<html lang="en">

    @include('collejo::layouts.partials.head')

    <body>

        @include('collejo::dash.menu.menubar')

        <div class="dash-content container-fluid">
            @yield('content')
        </div>

        <footer class="text-center text-muted">
        	{{ date('Y', time()) }} {!! trans('common.copyright_text', ['link' => trans('common.copyright_link')]) !!}
        </footer>
    
    </body>
</html>
