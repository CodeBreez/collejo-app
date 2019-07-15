<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('base::layouts.partials.head')

<body class="auth-body">

<div class="col-md-12 setup-page">

	<div class="col-lg-8 offset-2">

		@yield('content')

	</div>
</div>

@include('base::layouts.partials.footer')

</body>
</html>
