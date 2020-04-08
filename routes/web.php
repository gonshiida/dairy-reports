<?php


Route::get('/', 'ReportsController@index');

Route::resource('reports', 'ReportsController');