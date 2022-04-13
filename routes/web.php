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
Auth::routes();
Route::get('/closed', 'Site\ContactController@closed')->name('site.closed');

  Route::group(['namespace' => 'Admin' ,'middleware' => ['auth','admin']] , function() {
      require_once __DIR__ . '/admin.php';
  });

//   Route::group(['namespace' => 'Site', 'middleware' => ['closed']] , function() {

// 	  Route::group(['middleware' => ['auth']] , function() {
// 	      require_once __DIR__ . '/user.php';
// 	  });

//       require_once __DIR__.'/visitor.php';
//   });




