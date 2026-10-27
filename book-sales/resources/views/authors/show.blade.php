@extends('layouts.app')
@section('title', $author['name'])

@section('content')
    <h1>{{ $author['name'] }}</h1>
    <p><strong>Foto:</strong> {{ $author['photo'] }}</p>
    <p>{{ $author['bio'] }}</p>
    <a href="{{ route('authors.index') }}">&larr; Kembali</a>
@endsection
