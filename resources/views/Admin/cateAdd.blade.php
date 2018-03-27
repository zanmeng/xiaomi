<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>商品分类添加</title>
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
    <form class="layui-form" action="/admin/cate/store" method="post">
        {{ csrf_field() }}
        <div class="layui-form-item">
            {{--<label for="desc" class="layui-form-label">--}}
                <label class="layui-form-label">父分类</label>
                <div class="layui-input-block" style="width:200px">
                    <select name="cid"  lay-filter="">
                        <option value=""></option>
                        <option value="0">顶级分类</option>
                        @foreach($fid as $v)
                            <option value="{{ $v->catId }}">{{ $v->catName }} </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        {{--<input type="hidden" value="{{$fid->parentId}}">--}}
    <!--     {{--<div class="layui-form-item">--}}
            {{--<label for="desc" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>父类--}}
            {{--</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="text" id="desc" name="pid" required="" lay-verify="required"--}}
                       {{--autocomplete="off" class="layui-input">--}}
            {{--</div>--}}
            {{--<div class="layui-form-mid layui-word-aux">--}}
                {{--<span class="x-red">*</span>--}}
            {{--</div>--}}
        {{--</div>--}} -->


        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>分类名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="desc" name="catName" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="submit">
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
        form.on('submit(add)', function () {
            // $.ajax({
            //     type: 'POST',
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: '/admin/good',
            //     data: data.field,
            //     dataType: 'json',
            //     success: function (data) {
            //         console.log(data);
            //         if (data.status == 0) {
            //             layer.alert(data.msg, {icon: 6}, function () {
            //                 parent.location.reload(true);
            //             });
            //         } else {
            //             layer.alert(data.msg, {icon: 6, time: 2000}, function () {
            //                 parent.location.reload(true);
            //             });
            //         }
            //     }
            // });
            // return false;
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