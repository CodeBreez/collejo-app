<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

  	@include('base::layouts.partials.head')

  	<body class="auth-body">

	  	<div class="col-md-12 auth-row">

		    <div class="col-xl-4 offset-xl-4 col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-6 offset-sm-3">

		      @yield('content')

		    </div>
		</div>

	    @include('base::layouts.partials.footer')

  	</body>
</html>
