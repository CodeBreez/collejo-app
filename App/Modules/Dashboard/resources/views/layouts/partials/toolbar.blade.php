@section('scripts')
    @parent
    <script type="text/javascript" src="{{ mix('/assets/dashboard/js/toolbar.js') }}"></script>
@endsection

<div id="toolbar">
    <toolbar
            @if(isset($criteria))
            :filters="{{$criteria->toJson()}}"
            @endif
    >
        @hasSection('tools')
            <template slot="tools">
                @yield('tools')
            </template>
        @endif

        <template slot="title">
            <h2>
                @yield('title')
                @hasSection('total')
                    <span v-b-tooltip
                          title="{!!trans('dashboard::dash.total_records')!!}"
                          class="badge badge-info badge-count">
                        @yield('total')
                    </span>
                @endif
            </h2>
        </template>

        <div class="toolbar-loader">
            <div class="preloader rounded title"></div>
            <div class="preloader rounded button"></div>
            <div class="preloader rounded button-mini"></div>
        </div>

    </toolbar>
</div>