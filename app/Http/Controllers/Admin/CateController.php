<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Cate;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //分类列表
    public  function index(){
        $cate=Cate::all();
        return view('Admin.cateList',compact('cate'));
    }

    //添加子分类
    public function add(){
        $cid=empty($_GET['cid']) ? 0 : $_GET['cid']  ;
        $cates=$this->cates->orderBy(" concat(path,cid,',') ") ->select();
        return view('Admin.cateAdd',compact('cates'));
    }
}
