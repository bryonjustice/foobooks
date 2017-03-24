<?php

/**
* Book related routes
*/
Route::get('/books', 'BookController@index');

Route::get('/books/new', 'BookController@createNewBook');
Route::post('/books/new', 'BookController@storeNewBook');

Route::get('/books/{title?}', 'BookController@show');

Route::get('/search', 'BookController@search');

/**
* Log viewer
* (only accessible locally)
*/
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
