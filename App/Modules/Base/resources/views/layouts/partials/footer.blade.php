<footer class="text-center text-muted">
	{{ date('Y', time()) }} {!! trans('base::common.copyright_text', ['link' => trans('base::common.copyright_link')]) !!}

	@if(env('APP_DEBUG') && Auth::user())
		<!--pre>
		{{ print_r(['email' => Auth::user()->email, 'roles' => Auth::user()->roles->only('role')->all()]) }}
		</pre-->
	@endif

</footer>

<div id="notification" class="notifications-wrap">
	<div class="notifications-list">
		<notification :notification="notification" :key="index"
					  v-for="(notification, index) in notifications"></notification>
	</div>
</div>

<script type="text/javascript" src="{{ mix('/js/commons.js') }}"></script>
<script type="text/javascript" src="{{ mix('/assets/base/js/bootstrap.js') }}"></script>
<script type="application/javascript" src="/assets/fe-assets.js"></script>

@yield('scripts')