<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/projects', function () {
    return view('projects');
});

Route::get('/', function () {

    // ini_set('memory_limit', '5120M');
    // $path = storage_path('test/2.csv');
    // if (file_exists($path)) {
    //     $x = User::limit(114051)->get()->toArray();
    //     $f = fopen($path, "w");
    //     foreach ($x as $line) {
    //         fputcsv($f, $line);
    //     }
    //     fclose($f);
    // }

    // dd('Done CSV');

    return view('users');
});
