@extends('base::layouts.setup')

@section('title', trans('base::setup.title'))

@section('content')

<section class="text-center">

	<div class="card setup-required-card">

		<div class="card-body p-5">

			<i class="fa fa-tv fa-10x text-muted mb-4"></i>
			<h1 class="mb-5">{{ trans('base::setup.incomplete') }}</h1>
			<a href="https://github.com/codebreez/collejo-docs/tree/master/installation-guide" target="_blank">{{ trans('base::setup.guide') }}</a> <i class="fa fa-ellipsis-v text-muted"></i>
			<a target="_blank" href="https://github.com/codebreez/collejo-docs">{{ trans('base::setup.documentation') }}</a>

		</div>

	</div>

</section>

@endsection