<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ route('books') }}">Назад</a>



    <h1>{{ $book->name }}</h1>

    @if($book->year)
        <p>Year {{ $book->year }}</p>
    @endif

    @if($book->isbn)
        <p>Isbn {{ $book->isbn }}</p>
    @endif

    @if($book->cost)
        <p>Price {{ $book->cost }}</p>
    @endif

    <form method="POST" action="{{ route('show_book', $book->id) }}">
        @method('DELETE')
        @csrf

        <button type="submit">Удалить книгу</button>
    </form>
    <a href="{{ route('edit_book', $book->id) }}">Редактировать книгу</a>
</body>
</html>
