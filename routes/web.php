<?php


Route::get('/', 'ReportsController@index');

// ユーザ機能
Route::group(['middleware' => 'auth'], function () {
   Route::resource('reports', 'ReportsController');
});

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::delete('reportTypes/{id}', 'ReportsController@delete')->name('reportTypes.destroy');

Route::get('/searches', 'SearchesController@index')->name('reports.search');
