<?php

/*
|--------------------------------------------------------------------------
| Documentation Routes
|--------------------------------------------------------------------------
*/
Route::get('/', 'DocumentationController@index');				// API Documentation

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'v1'], function() {
	Route::get('states', 'StatesController@index');							// ReadList of ALL States
	Route::get('states/{state}/cities', 'CitiesController@index');			// ReadList of ALL Cities
	Route::get('states/{state}/cities/{city}', 'CitiesController@radius');	// ReadList of ALL Cities within specified radius or 100 miles by default
	Route::get('users', 'UsersController@index');							// ReadList of ALL Users
	Route::post('users/{user}/visits', 'UsersController@addvisit');			// Mark a City as visited for the specified User
	Route::get('users/{user}/visits', 'UsersController@visits');			// ReadList of ALL Cities that the specified User has visited
});
