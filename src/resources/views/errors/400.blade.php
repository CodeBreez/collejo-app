@extends('collejo::layouts.errors')

@section('title', '400')

@section('content')

<section class="error-page text-center">
	<i class="fa fa-meh-o"></i>
	<h2>{{ trans('errors.400') }}</h2>
	<br>
	<a href="/" class="btn btn-primary btn-sm">{{ trans('common.go_to_dashboard') }}</a>
</section>

@endsection