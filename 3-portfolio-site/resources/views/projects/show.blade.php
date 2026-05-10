@extends('layouts.app')

@section('content')
<h2>{{ $project->title }}</h2>
<div>{!! $project->description !!}</div>
<p><a href="{{ $project->link }}" target="_blank">{{ $project->link }}</a></p>
<a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
@endsection
