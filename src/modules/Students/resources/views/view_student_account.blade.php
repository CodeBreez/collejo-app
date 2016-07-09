@extends('collejo::dash.sections.tab_view')

@section('title', $student->name)

@section('tools')

<a href="{{ route('student.account.edit', $student->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Edit</a>  

@endsection

@section('tabs')

    @include('students::partials.view_tabs')

@endsection

@section('tab')


@endsection