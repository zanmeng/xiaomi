<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ordersController extends Controller
{
    //显示页面
    public function list()
    {


        return view('admin.order.list');
    }
}
