@extends('collejo::layouts.dash')

@section('content')

<section class="section">

@yield('scripts')

@yield('tools')

<h2>@yield('title')</h2>

<div class="row">
  
    <div class="col-xs-2">
        
        @yield('tabs')

    </div>

    <div class="col-xs-10">
        <div class="tab-content">
            <div class="tab-pane active">

                @yield('tab')

            </div>
        </div>
    </div>

</div>

</section>

@endsection