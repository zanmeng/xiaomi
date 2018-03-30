<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    // 后台首页
    public function index(){
        // 引入后台首页模板
        return view('admin.index');
    }

    public  function info(){
        return view('admin.welcome');
    }

    //退出登录
    public function logout()
    {
        session()->forget('user');
        return redirect('admin/login');
    }
}
