<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('users');
	/*try {
		DB::connection()->getPdo();
		$caught = false;
	} catch (Exception $e) {
		$caught = true;
		die("Could not connect to the database.  Please check your configuration. error:" . $e );
	}

	if(!$caught){
		echo 'Hello, world!';
	}*/
});

Route::get('users/fetchData', 'UserController@fetchData');
Route::get('users/searchName', 'UserController@searchName');
Route::get('users/moreOrLessAccess', 'UserController@moreOrLessAccess');
Route::resource('users', 'UserController');
