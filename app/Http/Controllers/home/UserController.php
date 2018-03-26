<?php

namespace App\Http\Controllers\home;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //用户信息
    public function userinfo()
    {
        //获取用户的所有信息
        $id = Session()->get('user')->login_id;
        $user = User::with('userinfo')->find($id);
//        dd($user);
        return view('home.userinfo',compact('user'));
    }

    //显示订单
    public function orderGoods()
    {
        return view('home.orderGoods');
    }
}
