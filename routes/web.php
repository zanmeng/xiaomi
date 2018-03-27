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

<<<<<<< HEAD
//前台
//前台首页
Route::get('home/index','home\IndexController@index');
//登录页面
Route::get('home/login','home\LoginController@login');
//验证码
Route::get('home/code','home\LoginController@code');
//登录验证
Route::post('home/dologin','home\LoginController@dologin');

//注册页面
Route::get('home/reg','home\LoginController@reg');
//验证注册
Route::post('home/doreg','home\LoginController@doreg');
//验证账号
Route::get('home/ajax','home\LoginController@ajax');
//退出登录
Route::get('home/logout','home\IndexController@logout');

//个人中心
//显示用户信息
Route::get('home/userinfo','home\UserController@userinfo');
//我的订单
Route::get('home/orderGoods','home\UserController@OrderGoods');

=======
Route::get('/admin/index','Admin\indexController@index');
//    后台信息页
Route::get('/admin/info','Admin\indexController@info');


//orders订单主表
    Route::get('/admin/order/list','Admin\ordersController@list');

//    文件上传路由
    Route::post('/admin/upload','uploadController@upload');
>>>>>>> 8b95f112827938e1f709d3b93319acd2beee5958
