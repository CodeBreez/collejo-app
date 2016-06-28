@extends('collejo::dash.sections.tab_view')

@section('title', $student ? 'Edit Student': 'New Student')

@section('scripts')

<script type="text/javascript">
function afterDeleteAddress(link, response){
    if (response.success) {
        $(link).closest('.address-block').remove();
    }
}
</script>

@endsection

@section('tools')

<a href="{{ route('students.edit.address.new', $student->id) }}" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-primary pull-right" data-toggle="ajax-modal"><i class="fa fa-plus"></i> New Contact</a>  

@endsection

@section('tabs')

    @include('students::partials.tabs')

@endsection

@section('tab')


<input type="hidden" name="sid" value="{{ $student->id }}">
<input type="hidden" name="uid" value="{{ $student->user->id }}">

<div id="addreses">

    @if($student->addresses->count())

        @foreach($student->addresses as $address)

            @include('students::partials.address')

        @endforeach

    @else

        <div class="col-md-6">
            <div class="placeholder">This user does not have any contacts defined.</div>
        </div>

    @endif

</div>  

<div class="clearfix"></div>


@endsection