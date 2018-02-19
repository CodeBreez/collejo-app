@extends('base::layouts.setup')

@section('title', trans('base::setup.title'))

@section('content')

<section class="landing-screen text-center">
	<i class="fa fa-television"></i>
	<h1>{{ trans('base::setup.incomplete') }}</h1>
	<a href="https://github.com/codebreez/collejo-docs/tree/master/installation-guide" target="_blank">{{ trans('base::setup.guide') }}</a>
</section>

@endsection