@extends('layouts.app')
@section('title', 'Daftar Author')

@section('content')
    <h1>Daftar Author</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>Nama</th><th>Foto</th><th>Bio</th><th>Jumlah Buku</th></tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->photo }}</td>
                    <td>{{ $author->bio }}</td>
                    <td>{{ $author->books_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
