<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// リソースコントローラに対応するルートの定義
// Route::resource('/booklist', 'BookListController', ['except' => ['create', 'edit']]);
Route::get('/booklist/{std_date}', 'BookListController@getList');
Route::get('/booklist/1/{data}', 'BookListController@add');
Route::get('/booklist/2/{id}/{data}', 'BookListController@update');
Route::get('/booklist/3/{id}', 'BookListController@destroy');
