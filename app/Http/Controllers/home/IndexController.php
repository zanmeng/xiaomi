<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('home.index');
    }

    //退出登录
    public function logout()
    {
        session()->forget('user');
        return redirect('home/index');
    }
}
