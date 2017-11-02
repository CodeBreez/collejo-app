<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

  @include('base::layouts.partials.head')

  <body class="error-layout">

    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted"><a href="/" class="brand-text"><img src="{{ asset(elixir('/images/collejo_sml.png')) }}"> Collejo</a></h3>
      </div>

      @yield('content')

    </div>


    @include('base::layouts.partials.footer')

  </body>
</html>
