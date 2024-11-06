@extends('layout')

@section('title', 'Таблица записей')

@section('css')
         @vite(['resources/css/app.css', 'resources/css/data.css'])
@endsection

@section('content')
    <div class="container mt-5">
        <h1>Полученные данные</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Телефон</th>
                    <th>Сообщение</th>
                    <th>Согласие</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item['name'] ?? 'N/A' }}</td>
                        <td>{{ $item['email'] ?? 'N/A' }}</td>
                        <td>{{ $item['phone'] ?? 'N/A' }}</td>
                        <td>{{ $item['message'] ?? 'N/A' }}</td>
                        <td>{{ $item['agree'] ? 'Да' : 'Нет' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
