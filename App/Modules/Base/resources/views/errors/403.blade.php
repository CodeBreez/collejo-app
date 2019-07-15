@extends('base::layouts.errors')

@section('title', '403')

@section('content')

<section class="error-page text-center">
	<i class="fa fa-meh-o"></i>
	<h2>{{ trans('errors.403') }}</h2>
	<br>
	<a href="/" class="btn btn-primary btn-sm">{{ trans('common.go_to_dashboard') }}</a>
</section>

@endsection