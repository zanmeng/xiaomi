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
/*
Route::get('/', function () {
    return view('admin/index');
});*/



Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){

    //后台登录
    Route::get('login','LoginController@login');
    //生成验证码
    Route::get('code','LoginController@code');
    // 第三方组件生成验证码的路由
    Route::get('code/captcha/{userId}','LoginController@captcha');

    //登录处理路由
    Route::post('dologin','LoginController@dologin');

    Route::get('jiami','LoginController@jiami');
});


    //后台
Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>'isLogin'],function(){

    //后天首页
    Route::get('index','IndexController@index');

    //后天信息页
    Route::get('info','IndexController@info');

    //退出  登录
    Route::get('logout','IndexController@logout');

    //后台用户模块
    //启用  禁用
    Route::post('user/changestatus','UserController@changestatus');

    //批量删除
    Route::get('user/delall','UserController@delall');

    Route::resource('user','UserController');
});

