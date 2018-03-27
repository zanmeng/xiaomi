<?php

namespace App\Http\Controllers\Admin;

use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class GoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $input=$request->input('gname');
//        $good=Goods::all();
//        $good=Goods::paginate(2);
//        return view('Admin.goods',compact('good'));


        $good = Goods::orderBy('gid','asc')
            ->where(function($query) use($request){
                //检测关键字
                $gname = $request->input('gname');
                $dprice = $request->input('sprice');
                $gprice = $request->input('dprice');

                //如果用户名不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
                //如果邮箱不为空
                if(!empty($dprice)) {
                    $query->where('price','>',$dprice);
                }
                if(!empty($gprice)) {
                    $query->where('price','<',$gprice);
                }
            })
            ->paginate($request->input('num', 2));
        return view('Admin.goods',['good'=>$good, 'request'=> $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加页面
        return view('Admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //保存数据
        $input=$request->all();
//         return $input;
        $res= Goods::create(['gname'=>$input['gname'],
                       'tid'=>$input['tid'],
                       'price'=>$input['price'],
                       'stock'=>$input['stock'],
                       'salecnt'=>$input['salecnt'],
                       'vcnt'=>$input['vcnt'],
                        'gpic'=>$input['goodspic'],
                       'gdesc'=>$input['gdesc'],
                    ]);

       //判断添加成功
        if($res){
            $arr=[
                'status'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $arr=[
                'status'=>1,
                'msg'=>'添加失败'
            ];
        }
        return $arr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $good=Goods::findOrFail($id);
        return view('Admin.edit',compact('good'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gid)
    {


        //修改数据
        $goods=$request->all();
//        dd($goods);
        $user=Goods::findOrFail($gid);

        $res=$user->update(['gname'=>$goods['gname'],
            'gid'=>$goods['gid'],
            'price'=>$goods['price'],
            'stock'=>$goods['stock'],
            'gdesc'=>$goods['gdesc'],
            'gpic'=>$goods['gpic'],
            ]);

        if($res){
            $arr=[
                'status'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $arr=[
                'status'=>1,
                'msg'=>'添加失败'
            ];
        }
        return $arr;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($gid)
    {
//        return $gid;
        $input=Goods::find($gid);
        $res=$input->delete();
        if($res){
            $arr=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $arr=[
                'status'=>1,
                'msg'=>'删除失败',
            ];
    }
    return $arr;
    }

    //启用停用
    public function changestatus(Request $request){
        //用户id
        $uid = $request->input('id');
        //用户的状态
        $status =  ($request->input('status') == 1)? 0:1;

        //修改状态
        $user = Goods::find($uid);
        $res = $user->update(['status'=>$status]);

        if($res){
//            json格式的接口信息  {'status':是否成功，'msg'：提示信息}
            $arr = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $arr = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }

        return $arr;
    }


    //批量删除
    public function delall(Request $request){
        //获取删除的ids
//        return 1;
        $ids=$request->input('ids');
        //删除操作
        $res=Goods::destroy($ids);

        if($res){
            $data=[
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

    //上传图片

    public function upload(Request $request)
    {
        $file = $request->file('gpic');
//        return 123;
//        return $file;
        //如果是有效的上传文件
        if($file->isValid()) {
//            获取原文件的文件类型
            $ext = $file->getClientOriginalExtension();    //文件拓展名
//            生成新文件名
            $newfile = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
//            1. 将文件上传到本地服务器
            //将文件从临时目录移动到制定目录
//           $path = $file->move(public_path().'/uploads',$newfile);
            $path = $file->move(public_path().'/upload',$newfile);
//
            //将上传文件的路径返回1给客户端
            return $newfile;
        }
        return 123;
    }

}
