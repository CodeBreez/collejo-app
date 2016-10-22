@extends('collejo::layouts.dash')

@section('content')

<section class="section">

    @yield('tools')

    <h2>@yield('title') 
        @hasSection('count')
            <small>(@yield('count'))</small>
        @endif
    </h2>

    @if(isset($criteria))

    <div class="panel panel-default criteria-filter">
    	<div class="panel-body">

    		<form class="form-inline" action="{{ url()->current() }}" method="GET"> 			

    			@foreach($criteria->formElements() as $element)

    				@if($element['type'] == 'text')

		    		<div class="form-group">
					    <label>{{ $element['label'] }}</label>
					    <input type="text" class="form-control input-sm" name="{{ $element['name'] }}" value="{{ Request::get($element['name']) }}"> 
					</div>

					@endif

                    @if($element['type'] == 'select')

                    <div class="form-group">
                        <label>{{ $element['label'] }}</label>
                        <select class="form-control input-sm" name="{{ $element['name'] }}" data-toggle="select-dropdown" data-allow-clear="true">
                            <option></option>
                            @foreach($criteria->callback($element['itemsCallback']) as $item)
                                @if(Request::get($element['name']) == $item->id)
                                    <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    @endif

    			@endforeach

                <div class="form-group pull-right btn-col">
                    <a class="btn btn-sm btn-link" href="{{ url(Request::path()) }}">{{ trans('common.clear_search') }}</a>
                </div>

                <div class="form-group pull-right btn-col">
                    <button class="btn btn-sm btn-default" type="submit">{{ trans('common.search') }}</button>
                </div>                   

	    	</form>
    	</div>
    </div>

    @endif

    <div class="panel panel-default section-content">
        <div class="table-responsive">
            
            @yield('table')

        </div>
    </div>

</section>

@endsection