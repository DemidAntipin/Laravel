<form method="POST" action="{{ $book->id ? route('edit_book') }}">
    @csrf

    <label>Name
        <input type="text" name="name" id="">
    </label>
    <br>
    @error('name') 
        <div style="color: red;">{{ $message}}</div>
    @enderror
    <br>
    <label>Year
        <input type="text" name="year" id="">
    </label>
    <br>
    <br>
    <label>ISBN
        <input type="text" name="isbn" id="">
    </label>
    <br>
    <br>
    <label>Price
        <input type="text" name="cost" id="">
    </label>
    <br>
    <br>
    <button type="submit">Save</button>
</form>
</body>