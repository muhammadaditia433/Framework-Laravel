@extends('layouts.app')
@section('title', 'Daftar Genre')

@section('content')
    <h1>Daftar Genre</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td>{{ $genre['id'] }}</td>
                    <td>{{ $genre['name'] }}</td>
                    <td>{{ $genre['description'] }}</td>
                    <td><a href="{{ route('genres.show', $genre['id']) }}">Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
