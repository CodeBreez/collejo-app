@extends('collejo::layouts.dash')

@section('title', $profile->name)

@section('content')

<section class="section">

    <div class="panel panel-default section-content dashboard-section">
        
        <div class="col-md-3">    
        	@if($profile->picture)
				<img class="img-lazy thumbnail img-responsive" src="{{ $profile->picture->url('small') }}">
			@else
				<img class="thumbnail img-responsive" src="{{ asset(elixir('/images/user_avatar_small.png')) }}">
			@endif
        </div>

        <div class="col-md-9">
            <h1>{{ $profile->name }}</h1>   
        </div>

    </div>

</section>

@endsection

