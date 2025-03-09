<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    session()->flash('swal', [
        'title'             => 'Error!',
        'text'              => 'Do you want to continue',
        'icon'              => 'error',
        'confirmButtonText' => 'Cool',
        'footer'            => '<a href="#">Why do I have this issue?</a>',
    ]);
    return view('admin.index');
});
