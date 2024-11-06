@extends('layout')

@section('title', 'Форма')

@section('css')
	 @vite(['resources/css/app.css', 'resources/css/form.css'])
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
	    <br>
            <a href="{{ url('/') }}" class="btn btn-primary">Вернуться на главную</a>
        </div>
    @else
        <div>
            <form method="POST" action="/form">
                @csrf

                <label>Имя:</label>
                <br>
                <input type="text" name="name" value="{{ old('name') }}" class="{{ $errors->has('name') ? 'error-border' : '' }}">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <br>

                <label>Email:</label>
                <br>
                <input type="text" name="email" value="{{ old('email') }}" class="{{ $errors->has('email') ? 'error-border' : '' }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <br>

                <label>Телефон:</label>
                <br>
                <input type="text" name="phone" value="{{ old('phone') }}" class="{{ $errors->has('phone') ? 'error-border' : '' }}">
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <br>

                <label>Сообщение:</label>
                <br>
                <textarea name="message" style="resize: none;" class="{{ $errors->has('message') ? 'error-border' : '' }}">{{ old('message') }}</textarea>
                @error('message')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <br>

                <label>
                    <input type="checkbox" name="agree" {{ old('agree') ? "checked" : "" }} class="{{ $errors->has('agree') ? 'error-border' : '' }}">
                    Согласны?
                </label>
                @error('agree')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <br>

                <button type="submit">Отправить</button>
            </form>
        </div>
    @endif
@endsection

