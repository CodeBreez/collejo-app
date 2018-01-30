@extends('dashboard::layouts.dash')

@section('content')

    <section class="section">

        <h2>@yield('title')</h2>

        <div class="pull-right">
            @yield('tools')
        </div>

        @hasSection('breadcrumbs')

            @yield('breadcrumbs')

    @endif

        <div class="row">

            <div class="col-md-2 tabs-view-tabs">

                @yield('tabs')

            </div>
            <div class="col-md-10">
                <div class="tab-content">
                    <div class="tab-pane active">

                        @yield('tab')

                        <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    </section>

@endsection