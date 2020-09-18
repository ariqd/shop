<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('customers', 'CustomersController');
    Route::get('customers/search-cities/{id}', 'CustomersController@searchCities');

    Route::resource('products', 'ProductsController');
    Route::put('products/update-stock/{product}', 'ProductsController@updateStock')->name('products.update.stock');
    Route::resource('stocks', 'StocksController');

    Route::resource('sales', 'SalesController');
    Route::get('sales/search/{id}', 'SalesController@search');
    Route::get('sales/search-customer/{id}', 'SalesController@searchCustomer');
    Route::post('sales/cost', 'SalesController@cost');
    Route::get('sales/lunas/{id}', 'SalesController@makeLunas');
    Route::get('sales/dikirim/{id}', 'SalesController@makeDikirim');
    Route::get('sales/finish/{id}', 'SalesController@makeFinish');
    Route::get('sales/cancel/{id}', 'SalesController@makeCancel');
    Route::delete('sales/delete/detail/{id}', 'SalesController@deleteDetail');

    Route::resource('sales-toko', 'SalesTokoController');
    Route::get('sales-toko/search/{id}', 'SalesTokoController@search');
    Route::get('sales-toko/search-customer/{id}', 'SalesTokoController@searchCustomer');
    Route::post('sales-toko/cost', 'SalesTokoController@cost');
    Route::post('sales-toko/delete-detail/{id}', 'SalesTokoController@deleteDetail');

    Route::resource('users', 'UsersController');
    Route::post('users/change-password/{id}', 'UsersController@changePassword');

    Route::get('settings', 'SettingsController@index')->name('setting.index');
    Route::post('settings', 'SettingsController@update')->name('setting.update');

    // Route::get('sales-toko', 'SalesTokoController@create');
});
