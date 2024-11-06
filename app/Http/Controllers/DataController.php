<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function index(){
    	$files = Storage::disk('local')->files();
    	$data = [];

   	if (empty($files)) {
        	dd('No files found in the private storage directory.');
    	}

    	$jsonFiles = array_filter($files, function ($file) {return pathinfo($file, PATHINFO_EXTENSION) === 'json';});

	foreach ($jsonFiles as $file) {
        	$content = Storage::get($file);
        	$jsonData = json_decode($content, true);

        	if (json_last_error() !== JSON_ERROR_NONE) {
            		dd('JSON decode error: ' . json_last_error_msg());
        	}

        	$data[] = $jsonData;
    	}

    	return view('data', ['data' => $data]);
    }
}
