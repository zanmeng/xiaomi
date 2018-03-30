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


    //商品列表
//停用启用
    Route::post('good/changestatus','GoodController@changestatus');

//批量删除
    Route::get('good/delall','GoodController@delall');

//图片上传
    Route::post('good/upload','GoodController@upload');

//商品控制器
    Route::resource('good','GoodController');


//商品分类
    Route::get('cate/index','CateController@index');
//添加分类
    Route::get('cate/cate','CateController@create');


});




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



