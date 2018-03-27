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

//后台页面
Route::resource('admin/goods','Admin\GoodsController');

//商品列表
//停用启用
Route::post('admin/good/changestatus','Admin\GoodController@changestatus');

//批量删除
Route::get('admin/good/delall','Admin\GoodController@delall');

//图片上传
Route::post('admin/good/upload','Admin\GoodController@upload');

//商品控制器
Route::resource('admin/good','Admin\GoodController');


//商品分类
Route::get('admin/cate/index','Admin\CateController@index');
//添加分类
Route::get('admin/cate/cate','Admin\CateController@create');

