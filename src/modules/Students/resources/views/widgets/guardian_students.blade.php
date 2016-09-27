@if(Auth::user()->guardian)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Children In School</h3>
        </div>
        <div class="panel-body">

            <div class="row">

                @foreach(Auth::user()->guardian->students as $student)

                    <div class="col-md-3">
                        @if($student->picture)
                            <img class="img-lazy thumbnail img-responsive" src="{{ $student->picture->url('small') }}">
                        @else
                            <img class="thumbnail img-responsive" src="{{ asset(elixir('/images/user_avatar_small.png')) }}">
                        @endif
                        <h4><a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a></h4>
                        @if($student->grade)
                            <div class="label label-warning">{{ $student->grade->name }}</div>
                        @endif
                        @if($student->class)
                            <div class="label label-info">{{ $student->class->name }}</div>
                        @endif
                    </div>

                @endforeach

            </div>
        </div>
    </div>
@endif