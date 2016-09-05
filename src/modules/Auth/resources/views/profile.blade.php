@extends('collejo::layouts.dash')

@section('title', $profile->name)

@section('content')

<section class="section">

    <div class="panel panel-default section-content dashboard-section">
        
        <div class="col-md-4">    

        </div>

        <div class="col-md-8">
            <h1>{{ $profile->name }}</h1>   
        </div>

    </div>

</section>

@endsection

