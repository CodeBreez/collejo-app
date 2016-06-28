@extends('collejo::layouts.dash')

@section('content')

<section class="section">

    @yield('tools')

    <h2>@yield('title')</h2>

    <div class="panel panel-default section-content">
        <div class="table-responsive">
            
            @yield('table')

        </div>
    </div>

</section>

@endsection