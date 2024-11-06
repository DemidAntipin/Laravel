@extends('layout')

@section('title', 'Новости')

@section('content')

    <h1>Новости</h1>
    <ul>
    @foreach ($news as $item)
        <li>{{ $item }}</li>
    @endforeach
    </ul>
@endsection
