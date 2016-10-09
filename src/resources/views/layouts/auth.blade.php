<!DOCTYPE html>
<html lang="en">

  	@include('collejo::layouts.partials.head')

  	<body class="auth-body">

	  	<div class="col-md-12 auth-row">

		    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">

		      <div class="col-lg-10 col-lg-offset-1 col-md-12 col-md-offset-1 col-sm-12">

		      @yield('content')

		      </div>

		    </div>
		</div>

	    @include('collejo::layouts.partials.footer')

  	</body>
</html>
