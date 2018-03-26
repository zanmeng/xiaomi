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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/index','Admin\indexController@index');
//    后台信息页
Route::get('/admin/info','Admin\indexController@info');


//orders订单主表
    Route::get('/admin/order/list','Admin\ordersController@list');

//    文件上传路由
    Route::post('/admin/upload','uploadController@upload');