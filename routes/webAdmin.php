<?php
Route::group(
    [
        'prefix' => 'dashboard',
        'namespace' => 'Admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'role:admin'],
    ], function () {
        Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
        Route::resource('user', 'UserController', ['except' => ['show']]);
        Route::resource('role', 'RoleController', ['except' => ['show']]);
        Route::resource('ticket', 'TicketController');
        Route::resource('ticket-owner', 'AssignedTicketController');
    });
