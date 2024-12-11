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
    <h1>Create new book</h1>

    <form method="POST" action="{{ route('books') }}">
        @csrf


        <label>Name
            <input type="text" name="name" id="" value="{{ old('name')}}">
        </label>
        <br>
        @error('name') 
            <div style="color: red;">{{ $message}}</div>
        @enderror
        <br>
        <label>Year
            <input type="text" name="year" id="" value="{{ old('year')}}">
        </label>
        <br>
	@error('year')
            <div style="color: red;">{{ $message}}</div>
        @enderror
        <br>
        <label>ISBN
            <input type="text" name="isbn" id="" value="{{ old('isbn')}}">
        </label>
        <br>
	@error('isbn')
            <div style="color: red;">{{ $message}}</div>
        @enderror
        <br>
        <label>Price
            <input type="text" name="cost" id="" value="{{ old('cost')}}">
        </label>
        <br>
	@error('cost')
            <div style="color: red;">{{ $message}}</div>
        @enderror
        <br>
	<label>Author
            <select name="author_id">
                <option value="">Select an author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </label>
        <br>
        @error('author_id')
            <div style="color: red;">{{ $message}}</div>
        @enderror
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
