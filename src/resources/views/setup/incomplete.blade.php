@extends('collejo::layouts.setup')

@section('title', 'Setup')

@section('content')

<section class="setup-incomplete text-center">
	<i class="fa fa-television"></i>
	<h1>{{ trans('setup.incomplete') }}</h1>
	<a href="https://github.com/codebreez/collejo-docs/tree/master/installation-guide" target="_blank">{{ trans('setup.guide') }}</a>
</section>

@endsection