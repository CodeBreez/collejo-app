@extends('dashboard::layouts.dash')

@section('content')

    <section class="section">

    @hasSection('breadcrumbs')

        <h2>@yield('title')</h2>

        <div class="pull-right">
            @yield('tools')
        </div>

        @hasSection('breadcrumbs')

            @yield('breadcrumbs')

        @endif
    @else

        <div class="pull-right">
            @yield('tools')
        </div>

        <h2>@yield('title')</h2>

    @endif

    <div class="card tab-card">
        <div class="col-md-12">
            <div class="row">

                <div class="col-xs-2">

                    @yield('tabs')

                </div>
                <div class="col-xs-10">
                    <div class="tab-content">
                        <div class="tab-pane active">

                            @yield('tab')

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </section>

@endsection