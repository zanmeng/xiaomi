<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
</head>

<body>
<div class="x-body">
    <form class="layui-form">

        <div class="layui-form-item">
                          {{--{{ csrf_field() }}--}}
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>用户名
            </label>
            <div class="layui-input-inline">
                <input type="text" value="{{ $user->userName }}" id="L_username" name="username" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>

            <input type="hidden" name="userId" value="{{ $user->userId }}">
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="x-red">*</span>性别</label>
            <div class="layui-input-inline">
                <select name="sex">

                    <option value="1" @if($user->sex==1) selected @endif>小鲜肉</option>
                    <option value="2" @if($user->sex==2) selected @endif>小仙女</option>
                    <option value="3" @if($user->sex==3) selected @endif>不告诉你</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>手机
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" value="{{$user->phone}}" name="phone" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>邮箱
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="email"  value="{{ $user->email }}" required="" lay-verify="email"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><span class="x-red">*</span>角色</label>
            <div class="layui-input-inline">
                <select name="userType">

                    <option value="1" @if($user->status==1) selected @endif>超级管理员</option>
                    <option value="2" @if($user->status==2) selected @endif>编辑人员</option>
                    <option value="3" @if($user->status==3) selected @endif>问题维护</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="edit" lay-submit="">
                修改
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form,
         layer = layui.layer;

        //自定义验证规则
        form.verify({
             nikename: function(value){
               if(value.length < 5){
                 return '昵称至少得5个字符啊';
               }
             }
             ,pass: [/(.+){6,12}$/, '密码必须6到12位']
             ,repass: function(value){
                 if($('#L_pass').val()!=$('#L_repass').val()){
                     return '两次密码不一致';
                 }
             }
        });

        //监听提交
        form.on('submit(edit)', function(data){

            //获取当前要修改的用户的id
            var userId = $("input[type='hidden']").val();

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/user/"+userId,
                data: data.field,
                dataType: "json",
                success: function(data){
                    // 如果添加成功
                    if(data.status == 1){
                        layer.alert(data.msg,{icon:6,time:2000},function(){
                            //关闭弹层，刷新父页面
                            parent.location.reload(true);
                        })
                    }else{
                        layer.alert(data.msg,{icon:6,time:2000},function(){
                            //关闭弹层，刷新父页面
                            parent.location.reload(true);
                        })
                    }
                }
            });

            return false;
        });


    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>