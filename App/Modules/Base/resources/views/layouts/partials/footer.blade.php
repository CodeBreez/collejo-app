<footer class="text-center text-muted">
	{{ date('Y', time()) }} {!! trans('common.copyright_text', ['link' => trans('common.copyright_link')]) !!}

	@if(env('APP_DEBUG') && Auth::user())
		<!--pre>
		{{ print_r(['email' => Auth::user()->email, 'roles' => Auth::user()->roles->only('role')->all()]) }}
		</pre-->
	@endif

		@foreach (Modules::getLangScriptFiles() as $script)
		<script type="application/javascript" src="{{ $script }}"></script>
		@endforeach

	@yield('scripts')

</footer>