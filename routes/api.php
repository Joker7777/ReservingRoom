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
Route::get('/booklist/{std_date}/', 'BookListController@getList');
Route::post('/booklist/1/', 'BookListController@add');
Route::post('/booklist/2/', 'BookListController@update');
Route::delete('/booklist/3/{booklist}/', 'BookListController@destroy');
