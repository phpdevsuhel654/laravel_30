@extends('layouts.app')

@section('content')
<h2>{{ $skill->name }}</h2>
<p>Level: {{ $skill->level }}</p>
<a href="{{ route('skills.index') }}" class="btn btn-secondary">Back</a>
@endsection
