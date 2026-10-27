@extends('layouts.app')
@section('title', 'Daftar Book')

@section('content')
    <h1>Daftar Book</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th><th>Judul</th><th>Penulis</th><th>Harga</th>
                <th>Stok</th><th>Genre ID</th><th>Cover</th><th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ $book->genre_id }}</td>
                    <td>{{ $book->cover_photo }}</td>
                    <td>{{ $book->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
