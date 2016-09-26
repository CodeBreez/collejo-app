<!DOCTYPE html>
<html lang="en">
  
  @include('collejo::layouts.partials.head')

  <body class="error-layout">

    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted"><a href="/" class="brand-text"><img src="{{ asset(elixir('/images/collejo_sml.png')) }}"> Collejo</a></h3>
      </div>

      @yield('content')

    </div> 

    
    @include('collejo::layouts.partials.footer')

  </body>
</html>
