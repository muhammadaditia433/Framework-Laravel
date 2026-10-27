@extends('layouts.app')
@section('title', $genre['name'])

@section('content')
    <h1>{{ $genre['name'] }}</h1>
    <p>{{ $genre['description'] }}</p>
    <a href="{{ route('genres.index') }}">&larr; Kembali</a>
@endsection
