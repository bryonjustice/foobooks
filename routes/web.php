<?php

/**
* Book related routes
*/
Route::get('/books', 'BookController@index');

Route::get('/books/{title?}', 'BookController@show');


if(config('app.env') == 'local') {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
}

/**
* Practice
*/
Route::any('/practice/{n?}', 'PracticeController@index');


/**
* Main homepage visitors see when they visit just /
*/
Route::get('/', 'WelcomeController');
