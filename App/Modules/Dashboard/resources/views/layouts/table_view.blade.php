@extends('dashboard::layouts.dash')

@section('content')

    <section class="section">

        @include('dashboard::layouts.partials.toolbar')

        @hasSection('breadcrumbs')

            @yield('breadcrumbs')

        @endif

        <div class="row">

            <div class="col-md-12">

                <div class="card table-view-table">
                    @yield('table')
                </div>

            </div>
        </div>
        </div>

    </section>

@endsection