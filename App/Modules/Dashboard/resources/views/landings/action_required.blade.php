@extends('dashboard::layouts.dash')

@section('title', trans('base::common.action_required'))

@section('content')

<section class="landing-screen text-center col-md-6 offset-md-3">

	<i class="fa fa-tv"></i>
	<h1>{{ $message }}</h1>
	<p>{{ nl2br($help) }}</p>
	<a class="btn btn-primary" href="{{ $route }}">{{ $action }}</a>

</section>

@endsection