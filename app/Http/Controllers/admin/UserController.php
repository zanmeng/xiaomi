<?php

namespace App\Http\Controllers\admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取用户
        $users = User::get();
        //返回用户列表页面
//        return view('admin.user.list',compact('users'));

//       2.按页获取数据
//        $users = User::paginate(3);
//        return view('admin.user.list',compact('users'));

        //3.单条件分页并且搜索
//        $username = $request->input('username');
//        $users = User::where('userName','like','%'.$username.'%')->paginate(3);
//        return view('admin.user.list',compact('users','username'));

        //多条件加分页
        $user = User::orderBy('login_id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input('keywords1');
                $email = $request->input('keywords2');
                //如果用户名不为空
                if(!empty($username)) {
                    $query->where('userName','like','%'.$username.'%');
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num', 5));
        return view('admin.user.list',['users'=>$user, 'request'=> $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.接受提交的信息
        $input = $request->except('token');
        //2.表单验证,检查用户名是否已经注册,密码跟确认密码是否正确

//        $rule = [
//            'username'=>'required|between:6,12',
//            'password'=>'required|between:6,12',
//        ];
//
//        Validator::make($input,$rule);
//        if ($validator->fails()) {
//            return redirect('admin/user/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
        //判断账号是否存在
        $user = User::where('userName',$input['username'])->first();
        if($user){
            return redirect('admin/user/create')->with('errors','用户名已存在');
        }
        //判断密码
        if($input['password'] != $input['repassword']){
            return redirect('admin/user/create')->with('errors','俩次密码不一致');
        }

        //3.将数据添加到数据库
            //密码加密
            $pass = Crypt::encrypt($input['password']);

            $res = User::create(['userName'=>$input['username'],'userPwd'=>$pass,'email'=>$input['email']]);
        //4.根据添加是否成功,进行页面跳转
            if($res){

//                json格式借口信息 ['status':是否成功,'msg':提示信息]
                $arr = [
                    'status'=>0,
                    'msg'=>'添加成功'

                ];
            }else{
                $arr = [
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
