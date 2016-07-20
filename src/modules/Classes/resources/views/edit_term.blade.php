@extends('collejo::dash.sections.tab_view')

@section('title', trans('classes::batch.edit_batch'))

@section('scripts')

<script type="text/javascript">
function afterDeleteTerm(link, response){
    if (response.success) {
        $(link).closest('.term-block').remove();
    }
}
</script>

@endsection

@section('tools')

<a href="{{ route('batch.term.new', $batch->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> {{ trans('classes::term.new_term') }}</a>  

@endsection

@section('tabs')

    @include('classes::partials.batch_tabs')

@endsection

@section('tab')


<div id="addreses" class="columns">

    @if($batch->terms->count())

        @foreach($batch->terms as $term)

            @include('classes::partials.term')

        @endforeach

    @else

        <div class="col-md-6">
            <div class="placeholder">{{ trans('classes::terms.empty_list') }}</div>
        </div>

    @endif

</div>  

<div class="clearfix"></div>


@endsection