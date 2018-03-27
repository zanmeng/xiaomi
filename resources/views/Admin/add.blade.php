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
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">
    <form class="layui-form" enctype="multipart/form-data" id="art_form" method="post">
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

        <div class="layui-form-item">
            <label for="desc" class="layui-form-label">
                <span class="x-red">*</span>缩略图上传
            </label>
            <div class="layui-input-inline">
                <input type="file" id="file_upload" name="gpic" value="" required="" lay-verify=""
                       autocomplete="off" class="layui-input">
            </div>
            <div>
                <img src="" id="art_thumb" alt="" width="100" height="100">
                <input type="hidden" name="goodspic" id="goods_hidden" >
            </div>
        </div>

           {{--<div>--}}
               {{----}}
           {{--</div> 缩略图上传--}}
        {{--<input id="file_upload" type="file" name="gpic" value="">--}}

        {{--<div>--}}
            {{--<img src="" id="art_thumb" alt="" width="100" height="100">--}}
            {{--<input type="hidden" name="goodspic" id="goods_hidden" >--}}
        {{--</div>--}}

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

   <script type="text/javascript">
                $(function () {
                    $("#file_upload").change(function () {
                        uploadImage();
                    })
                })
                function uploadImage() {
        //  判断是否有选择上传文件
                    var imgPath = $("#file_upload").val();
                    if (imgPath == "") {
                        alert("请选择上传图片！");
                        return;
                    }
                    //判断上传文件的后缀名
                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                    if (strExtension != 'jpg' && strExtension != 'gif'
                        && strExtension != 'png' && strExtension != 'bmp') {
                        alert("请选择图片文件");
                        return;
                    }
                    // var formData = new FormData($('#art_form')[0]);
                    var formData = new FormData();
                    formData.append('gpic',$('#file_upload')[0].files[0]);
                    // console.log($('#file_upload')[0].files[0]);
                    $.ajax({
                        type: "POST",
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/good/upload",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            // console.log(data);
                            $('#art_thumb').attr('src', '/upload/'+data);
                            $("#goods_hidden").val('/upload/'+data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("上传失败，请检查网络后重试");
                        }
                    });
                }
            </script>


<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //
        //
        //监听提交
        form.on('submit(add)', function (data) {
            console.log(data.field);
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
    });

</script>
{{--<script>var _hmt = _hmt || []; (function() {--}}
        {{--var hm = document.createElement("script");--}}
        {{--hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";--}}
        {{--var s = document.getElementsByTagName("script")[0];--}}
        {{--s.parentNode.insertBefore(hm, s);--}}
    {{--})();</script>--}}
</body>

</html>