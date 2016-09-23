<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Panel title</h3>
    </div>
    <div class="panel-body">

        <div class="row">

        @foreach(Auth::user()->guardian->students as $student)

            <div class="col-md-3">
                <img src="{{ $student->picture->url('small') }}">
                <h4><a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a></h4>
            </div>

        @endforeach

        </div>
    </div>
</div>