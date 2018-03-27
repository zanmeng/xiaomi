@extends('layouts.login')
@section('body')
    <body class="login-bg">

    <div class="login">
        @if (count($errors)>0)

            @if (is_object($errors))
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
                @else
                <li>{{$errors}}</li>
            @endif

        @endif
        <div class="message">x-admin2.0-管理登录</div>
          <li></li>
        <div id="darkbsannerwrap"></div>

        <form  action="/login" method="post" class="layui-form" >
            {{csrf_field()}}
            <input name="userType" type="hidden" ></input>
            <input name="userName" placeholder="用户名" value="{{old('userName')}}" type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="userPwd" lay-verify="required" placeholder="密码"  value="{{old('userPwd')}}" type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="验证码"  type="text" class="layui-input" style="width: 200px ;float:left">
            <img src="{{url('/code')}}" onclick="this.src='{{url('/code')}}?'+Math.random()"  alt="" style="float:right;height:40px  ">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    {{--<script>--}}
        {{--$(function  () {--}}
            {{--layui.use('form', function(){--}}
                {{--var form = layui.form;--}}
                {{--// layer.msg('玩命卖萌中', function(){--}}
                {{--//   //关闭后的操作--}}
                {{--//   });--}}
                {{--//监听提交--}}
                {{--form.on('submit(login)', function(data){--}}
                    {{--// alert(888)--}}
                    {{--layer.msg(JSON.stringify(data.field),function(){--}}
                        {{--location.href='index.html'--}}
                    {{--});--}}
                    {{--return false;--}}
                {{--});--}}
            {{--});--}}
        {{--})--}}


    {{--</script>--}}


    <!-- 底部结束 -->
    <script>
        //百度统计可去掉
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    </body>

    @endsection