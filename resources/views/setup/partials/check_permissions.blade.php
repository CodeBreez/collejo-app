<div>

    <h2>{{ trans('collejo::setup.pre_install_checkup') }}</h2>

	@if($results->canContinue())
		<p>{{ trans('collejo::setup.checkup_success') }}</p>
	@else
		<p>{{ trans('collejo::setup.checkup_fail') }}</p>
	@endif

	<ul class="list-group">

	@foreach($results as $result)

	<li class="list-group-item">
	
		<h4>

			@if($result->status)
				<i class="fa fa-check text-success"></i>
			@else
				<i class="fa fa-times text-danger"></i>
			@endif

			{{ $result->result }}

		</h4>

		@if($result->status)
			<p>{{ $result->description }}</p>
		@else
			<p>{{ $result->help }}</p>
		@endif
			
	</li>

	@endforeach

	</ul>

	@if($results->canContinue())

		<a href="/setup/admin" data-target="content" class="btn btn-lg btn-success pull-right" data-toggle="ajax-link">{{ trans('collejo::common.continue') }}</a>	

	@else

		<a href="/setup/pre-check" data-target="content" class="btn btn-lg btn-success pull-right" data-toggle="ajax-link">{{ trans('collejo::common.try_again') }}</a>	

	@endif
</div>