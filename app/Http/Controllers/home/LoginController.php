<?php

namespace App\Http\Controllers\home;

use App\Model\homeUser;
use App\Org\code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Session;

class LoginController extends Controller
{
    //前台登录
    public function login()
    {
        return view('home.login');
    }

//    生成验证码
    public function code()
    {
        $code = new Code;
        return $code->make();
    }


    //登录验证
    public function dologin(Request $request)
    {
        //1.获取提交的数据
        $input = $request->except('_token');
//        dd($input);
        //2.对数据进行验证
        $rule = [
            'username'=>'required|between:6,10',
            'password'=>'required|between:6,10',
        ];
        //留言
        $msg = [
            'username.required'=>'用户名不能为空',
            'username.between'=>'用户名格式不正确',
            'password.required'=>'密码不能为空',
            'password.between'=>'密码格式不正确',
        ];
        //验证
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('home/login')
                ->withErrors($validator)
                ->withInput();
        }

        //3.对验证验证
        if(strtolower($input['code']) != strtolower(session()->get('code'))){
            return redirect('home/login')->with('errors','验证码错误');
        }
        //4.对账号进行验证
        $user = homeUser::where('userName',$input['username'])->first();

        if(!$user){
            return redirect('home/login')->with('errors','用户名不存在');
        }

        //5.对密码进行验证
        if($input['password'] != Crypt::decrypt($user->userPwd)){

            return redirect('home/login')->with('errors','用户密码错误');
        }

        //6.获取用户存入session
        Session::put('user',$user);

        //7.成功后跳转
        return redirect('home/index');



    }



    //注册页面
    public function reg()
    {
        return view('home.reg');
    }


    //验证ajax传过来的账号
    public function ajax(Request $request)
    {
        $uname = $_GET['uname'];

        $user = homeUser::where('userName',$uname)->first();

        if($user){
            echo 1;
        }
    }


    //注册验证
    public function doreg(Request $request)
    {
        //1.获取提交的数据
        $input = $request->except('_token');


        $str = Crypt::encrypt( $input['password']);

         //执行添加数据库
        $user = new homeUser;

        homeUser::create(['userName'=>$input['username'],'userPwd'=>$str]);

        $user = homeUser::where('userName',$input['username'])->first();

        //
        //6.获取用户存入session
        Session()->put('user',$user);

        return redirect('home/index');
    }


}
