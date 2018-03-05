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
                @hasSection('count')
                    <span v-b-tooltip
                          title="{!!trans('dashboard::dash.total_records')!!}"
                          class="badge badge-info badge-count">
                        @yield('count')
                    </span>
                @endif
            </h2>
        </template>

    </toolbar>
</div>