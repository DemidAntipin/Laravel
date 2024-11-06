<?php

namespace App\Http\Controllers;

class NewsController extends Controller {
    function index() {
        $news = [];
	$news[] = "Новость 1";
        $news[] = "Новость 2";
        $news[] = "Новость 3";
        return view('news', ['news' => $news]);
    }
}
