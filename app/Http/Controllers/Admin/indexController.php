<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    //后台首页
    public function index()
    {
        return view('admin.index');
    }

    // 内容欢迎页
    public function info()
    {
        return view('admin.welcome');
    }
}
