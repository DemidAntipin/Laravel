<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>  

    <h1>Books</h1>

    <a href="{{ route('create_book') }}">Новая книга</a>

    <ul>
        @foreach($books as $book)
            <li>
                <a href="{{ route('show_book', $book->id) }}">{{ $book->name }}</a> {{ $book->author ? $book->author->name : 'Ноунейм какой-то' }}
            </li>
        @endforeach
    </ul>
</body>
</html>
