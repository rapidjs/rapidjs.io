<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/docs', function () {
    return view('pages.documentation');
})->name('docs');

Route::get('/documentation', function () {
    return redirect('docs');
});

Route::get('/contribute', function () {
    return view('pages.contribute');
})->name('contribute');

Route::get('/support', function () {
    return view('pages.support');
})->name('support');


Route::prefix('/indexes')->group(function () {

    Route::get('/configuration', function () {
        return array_values(data('configuration'));
    });

    Route::get('/methods', function () {
        return array_values(data('methods'));
    });

});
