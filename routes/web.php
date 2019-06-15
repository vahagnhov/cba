<?php

Route::get('/', 'IndexController@index')->name('index');

Route::post('/parse-currencies', 'IndexController@parseCurrencies')->name('parseCurrencies');

Route::get('/iso-codes-by-date', 'IndexController@currenciesByDate')->name('currenciesByDate');

Route::post('/parse-currencies-by-date', 'IndexController@parseCurrenciesByDate')->name('parseCurrenciesByDate');

Route::get('/by-date', 'IndexController@byDate')->name('byDate');

Route::any('/iso-codes', 'SoapController@getISOCodes')->name('iso-codes');

Route::post('/get-rates', 'SoapController@getRates')->name('getRates');

Route::post('/get-rates-by-date', 'SoapController@getRatesByDate')->name('getRatesByDate');

Route::get('/charts', 'SoapController@charts')->name('charts');