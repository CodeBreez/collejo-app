<!DOCTYPE html>
<html lang="en">

  @include('collejo::layouts.partials.head')

  <body>

    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-4 col-xs-12">

      <div class="col-lg-8 col-lg-offset-2 col-md-12 col-md-offset-1 col-sm-8">

      @yield('content')

      </div>

    </div> <!-- /container -->

  </body>
</html>
