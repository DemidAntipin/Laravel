<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormController extends Controller {

    public function __construct() {
        $_POST = [];
    }

    public function index() {
        return view('form');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+?[78]\d{10}$/',
            'message' => 'required',
            'agree' => 'accepted',
        ],[
	    'name.required' => 'Пожалуйста, введите ваше имя.',
            'email.required' => 'Пожалуйста, введите ваш электронный адрес.',
            'email.email' => 'Пожалуйста, введите корректный электронный адрес.',
            'phone.required' => 'Пожалуйста, введите ваш номер телефона.',
            'phone.regex' => 'Номер телефона должен быть в формате 89000000000 или +79000000000.',
            'message.required' => 'Пожалуйста, введите ваше сообщение.',
            'agree.accepted' => 'Вы должны согласиться с условиями.',
        ]);

        // Получение данных из запроса
        $data = $request->except('_token');

        // Генерация уникального имени файла
        $filename = Str::uuid() . '.json';

        // Сохранение данных в файл
        Storage::disk('local')->put($filename, json_encode($data, JSON_PRETTY_PRINT));

        // Сообщение об успешном сохранении
        return redirect()->back()->with('success', 'Данные успешно сохранены!');
    }
}

