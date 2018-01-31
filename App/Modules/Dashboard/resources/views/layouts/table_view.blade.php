@extends('dashboard::layouts.dash')

@section('content')

    <section class="section">

        @hasSection('tools')

            <div class="float-right">
                @yield('tools')
            </div>

        @endif

        <h2>@yield('title')</h2>


        @hasSection('breadcrumbs')

            @yield('breadcrumbs')

        @endif

        <div class="row">

            <div class="col-md-12">

                <div class="table-view-table">
                    @yield('table')
                </div>

            </div>
        </div>
        </div>

    </section>

@endsection