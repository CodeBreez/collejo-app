<!DOCTYPE html>
<html lang="en">
  
  @include('collejo::layouts.partials.head')

  <body class="setup-layout">

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="#">{{ trans('collejo::setup.about') }}</a></li>
            <li role="presentation"><a href="#">{{ trans('collejo::setup.documentation') }}</a></li>
          </ul>
        </nav>
        <h3 class="text-muted"><a href="/" class="brand-text"><img src="{{ Asset::getVersionedFile('/images/collejo_sml.png') }}"> Collejo</a></h3>
      </div>

      @yield('content')

    </div> 

  </body>
</html>
