<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Org\code\Code;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //登录页面
    public function login()
    {
        return view('admin.login');
    }
    //和验证码
    public function code()
    {
        $code = new Code;
        return $code->make();
    }

    //生成验证码方法
    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(255, 153, 0);
        $builder->setMaxAngle(35);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 90, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    //登录验证
    public function dologin(Request $request)
    {
        //1.获取登录信息
        $input = $request->except('_token');
        //2.对数据进行验证(validater)
        $rule = [
            'username'=>'required|between:4,16',
            'password'=>'required|between:4,16',
        ];
//        如果要求密码 必须输入、长度在6-18位之间、11位的电话号码
//        'username'=>'required|between:6,18',
//        'username'=>array('regex:/^13\d{9}$|^14\d{9}$|^15\d{9}$|^17\d{9}$|^18\d{9}$/i'),
//        'username'=>email,
        $msg = [
            'username.required'=>'用户名不能为空',
            'username.between'=>'用户名必须在4-16位之间',
            'password.required'=>'密码不能为空',
            'password.between'=>'密码必须在4-16位之间',
        ];

//        $validator = Validator::make(需要验证的数据,验证规则,提示信息)
        $validator = Validator::make($input,$rule,$msg);
        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
        //3.对验证验证
        if(strtolower($input['code']) != strtolower(session()->get('code'))){
            return redirect('admin/login')->with('errors','验证码错误');
        }
        //4.验证账号
       $user = User::where('userName',$input['username'])->first();

        if(!$user){
            return redirect('admin/login')->with('errors','用户名不存在');
        }

        //5.验证密码
         if($input['password'] != Crypt::decrypt($user->userPwd)){
             return redirect('admin/login')->with('errors','用户密码错误');
         }

        //6.获取用户信息到session
        Session::put('user',$user);

        //7.都正确的话进入后台首页

        return redirect('admin/index');



    }

    /**
     * @return string
     */

}
