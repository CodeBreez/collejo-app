@extends('dashboard::layouts.dash')

@section('content')

    <section class="section">

        @include('dashboard::layouts.partials.toolbar')

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

                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection