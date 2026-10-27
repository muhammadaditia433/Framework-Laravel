<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Book Sales</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 30px auto; padding: 0 16px; }
        nav a { margin-right: 14px; color: #4472c4; text-decoration: none; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #4472c4; color: #fff; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('genres.index') }}">Genre</a>
        <a href="{{ route('authors.index') }}">Author</a>
    </nav>
    <hr>
    @yield('content')
</body>
</html>
