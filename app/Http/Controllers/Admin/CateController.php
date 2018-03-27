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

        $fid = Cate::where('parentId',0)->get();
        return view('Admin.cateAdd',compact('fid'));
    }

    public function store(Request $request){
        $request->except('_token');
        $res=Cate::create(
            ['catName'=>$request['catName'],
            'parentId'=>$request['cid'],
        ]);
        if($res){
            echo '添加成功';
            return redirect(url('admin/cate/index'));
        }
    }

    //删除分类
    public function delete($id){

        $input=Cate::find('$id');
        dd($input);
        $res=$input->delete();
        if($res){
            echo '删除成功';
            return redirect(url('admin/cate/index'));
        }
    }
}
