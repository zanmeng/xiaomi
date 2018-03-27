<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}}">

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" enctype="multipart/form-data" id="art_form" >
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>商品名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="gname" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>商品类别
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="tid" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>价格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="price" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>库存
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="stock" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>销量
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="salecnt" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>浏览量
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="vcnt" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        {{--<div class="layui-form-item">--}}
            {{--<label for="link" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>商品图片--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<div class="site-demo-upbar">--}}
                    {{--<input type="file" name="gpic" class="layui-upload-file" id="test">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="layui-upload" >
            <label class="layui-form-label">缩略图上传</label>

            <div class="layui-upload-list" style="position: relative;">
             <button style="width:70px;"> <input id="file_upload" type="file" name="gpic" value="">
                <img style="with:60px;height:30px;position: absolute;left:120px;top:0px;z-index:1;" class="layui-upload-img" id="demo1" >
                <p id="demoText"></p>
             </button>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>商品描述
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="gdesc" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                增加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //自定义验证规则
        // form.verify({
        //     nikename: function(value){
        //         if(value.length < 5){
        //             return '昵称至少得5个字符啊';
        //         }
        //     }
        //     ,pass: [/(.+){6,12}$/, '密码必须6到12位']
        //     ,repass: function(value){
        //         if($('#L_pass').val()!=$('#L_repass').val()){
        //             return '两次密码不一致';
        //         }
        //     }
        // });

        //监听提交
        form.on('submit(add)', function (data) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/good',
                data: data.field,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status == 0) {
                        layer.alert(data.msg, {icon: 6}, function () {
                            parent.location.reload(true);
                        });
                    } else {
                        layer.alert(data.msg, {icon: 6, time: 2000}, function () {
                            parent.location.reload(true);
                        });
                    }
                }
            });
            return false;
        });

        // console.log(data);
        //发异步，把数据提交给php
        // layer.alert("增加成功", {icon: 6},function () {
        //     // 获得frame索引
        //     var index = parent.layer.getFrameIndex(window.name);
        //     //关闭当前frame
        //     parent.layer.close(index);
        // });

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