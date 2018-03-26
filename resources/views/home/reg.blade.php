<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="/home/css/login.css">

    <script src='{{url('home/css/jquery-min.js')}}'></script>

    <style>
        .cur{border:solid 2px blue}

        body{
            margin-top:100px;
            background-color:white;
            font-size: 50px;
            font-family: arial,"Hiragino Sans GB", "Microsoft YaHei","微軟正黑體","儷黑 Pro", sans-serif;
        }
    </style>
</head>
<body>
<div>
    <div style="color:red; font-size:20px;">


    </div>
    <form  method="post" action="{{url('home/doreg')}}" id="forms">
        {{csrf_field()}}
        <div class="regist">
            <div class="regist_center">
                <div class="regist_top">
                    <div class="left fl">会员注册</div>
                    <div class="right fr"><a href="{{url('home/index')}}">小米商城</a></div>
                    <div class="clear"></div>
                    <div class="xian center"></div>
                </div>
                <div class="regist_main center">
                    <div class="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;<input class="shurukuang" type="text" name="username" {{old('username')}} placeholder="请输入你的用户名"/><span id="text">请不要输入汉字</span></div>
                    <div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="password" placeholder="请输入你的密码"/><span>请输入6位以上字符</span></div>

                    <div class="username">确认密码:&nbsp;&nbsp;<input class="shurukuang" type="password" name="repassword" placeholder="请确认你的密码"/><span>两次密码要输入一致哦</span></div>
                    <div class="username">手&nbsp;&nbsp;机&nbsp;&nbsp;号:&nbsp;&nbsp;<input class="shurukuang" type="text" name="phone" {{old('phone')}} placeholder="请填写正确的手机号"/><span>填写下手机号吧，方便我们联系您！</span></div>
                    <div class="username">
                        <div class="left fl">验&nbsp;&nbsp;证&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="yanzhengma" type="text" name="code" placeholder="请输入验证码"/></div>
                        <div class="right fl"><img src="{{url('home/code')}}" onclick="this.src='{{url('admin/code')}}?'+Math.random()" alt="" >
                            <span style="color:red;">
                                @if (count($errors) > 0)
                                    <ul>
                                            <li>{{ $errors }}</li>
                                    </ul>
                                @endif
                            </span></div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="regist_submit">
                    <input class="submit" type="submit" name="submit" value="立即注册" >
                </div>

            </div>
        </div>
    </form>
</div>

<script>

    var UV = true;
    var PV = true;
    var RPV = true;
    var NV = true;

    //获取用户名
    //获取焦点
    $('input[name=username]').focus(function(){
        $(this).addClass('cur');
    })

    //失去焦点
    $('input[name=username]').blur(function(){
        //获取用户输入的值
        var tv = $(this).val();
        //准备正则
        var reg = /^\w{6,12}$/;
        var us = $(this);
        //检测
        if(!reg.test(tv)){
            //让边框变红
            $(this).css('border','solid 2px red');
            //让后边的字变化
            $('#text').text(' *用户名格式不正确').css('color','red');
            UV = false;
        } else {
            //发送ajax
            $.get('{{url('home/ajax')}}',{uname:tv},function(data){

                if(data == 1){
                    //让边框变颜色
                    us.css('border','solid 2px red');
                    $('#text').text(' *用户名已存在').css('color','red');

                    UV = false;

                } else {

                    us.css('border','solid 2px green');
                    $('#text').text(' √').css('color','green');

                    UV = true;
                }

            })


        }
    })

    //密码
    $('input[name=password]').focus(function(){

        $(this).addClass('cur');
    })

    //失去焦点
    $('input[name=password]').blur(function(){
        //获取值
        var pv = $(this).val();
        //正则
        var reg = /^\S{6,12}$/;
        //检测
        if(!reg.test(pv)){

            $(this).css('border','solid 2px red');
            $(this).next().text(' *密码格式不正确').css('color','red');

            PV = false;
        } else {

            $(this).css('border','solid 2px green');
            $(this).next().text(' √').css('color','green');

            PV = true;
        }
    })

    //确认密码
    $('input[name=repassword]').focus(function(){

        $(this).addClass('cur');
    })

    //失去焦点
    $('input[name=repassword]').blur(function(){
        //获取输入的密码
        var rpv = $(this).val();
        //获取输入的密码
        var pv  =$('input[name=password]').val();
        if(rpv != pv){

            $(this).css('border','solid 2px red');
            $(this).next().text(' *两次密码不一致').css('color','red');
            RPV = false;
        } else {

            $(this).css('border','solid 2px green');
            $(this).next().text(' √').css('color','green');

            RPV = true;
        }
    })


    //手机号码
    $('input[name=phone]').focus(function(){

        $(this).addClass('cur');
    })

    $('input[name=phone]').blur(function(){

        var nv = $(this).val();

        var reg = /^1[3456789]\d{9}$/;

        if(!reg.test(nv)){

            $(this).css('border','solid 2px red');
            $(this).next().text(' *手机号格式不正确').css('color','red');

            NV = false;
        } else {

            $(this).css('border','solid 2px green');
            $(this).next().text(' √').css('color','green');

            NV = true;
        }
    })


    //判断
    $('#forms').submit(function(){

        if(UV && PV && RPV && NV){

            return true;
        }

        return false;
    })



</script>
</body>
</html>