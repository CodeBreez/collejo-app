@extends('dashboard::layouts.dash')

@section('title', 'Dashboard')

@section('styles')
	<link href="{{ mix('/assets/dashboard/css/module.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<section class="section section-content section-content-transparent">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				{{-- Widget::renderByLocation('dash.col1') --}}
			</div>

			<div class="col-md-4">
				{{-- Widget::renderByLocation('dash.col2') --}}
			</div>
		</div>
	</div>
</div>

</section>

@endsection