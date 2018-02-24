<!DOCTYPE html>
<html lang="en">

	@include('base::layouts.partials.head')

	<body class="setup-layout">

		<div class="container">
			<div class="header">
				<nav class="navbar navbar-toggleable-md navbar-light">
                  <a href="/" class="navbar-brand brand-text"><span class="brand-name">{{config('app.name')}}</span></a>
					<ul class="nav nav-pills pull-right">
						<li><a target="_blank" href="https://github.com/codebreez/collejo-docs">{{ trans('base::setup.documentation') }}</a></li>
					</ul>
				</nav>
			</div>

		  @yield('content')

		</div>

	</body>
</html>
