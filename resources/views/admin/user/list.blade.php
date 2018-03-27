<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">




        <form class="layui-form layui-col-md12 x-so" action="/admin/user" method="get">
            <div class="layui-input-inline">
                <select name="num">
                    <option value="5"
                            @if($request['num'] == 5)  selected  @endif
                    >5
                    </option>
                    <option value="10"
                            @if($request['num'] == 10)  selected  @endif
                    >10
                    </option>
                </select>
            </div>
            <input type="text" name="keywords1" value="{{$request->keywords1}}" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            <input type="text" name="keywords2" value="{{$request->keywords2}}" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{ url('admin/user/create') }}',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>用户名</th>
            <th>性别</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>角色</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>

        @foreach($user as $v)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->userId}}'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{$v->userId}}</td>
                <td>{{ $v->userName }}</td>
                <td>
                    @if($v->sex==1)
                    小鲜肉
                        @elseif($v->sex==2)
                    小仙女
                        @elseif($v->sex==3)
                    不告诉你
                    @endif
                </td>
                <td>{{ $v->phone }}</td>
                <td>{{ $v->email }}</td>
                <td>
                    @if($v->userType==1)
                        超级管理员
                        @elseif($v->userType==2)
                        编辑人员
                        @elseif($v->userType==3)
                        问题维护
                    @endif
                </td>
                <td class="td-status">
                    <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                <td class="td-manage">
                    <a onclick="member_stop(this,'{{ $v->userId }}')" href="javascript:;" status="{{ $v->status }}"  title="启用">
                        <i class="layui-icon">&#xe601;</i>
                    </a>
                    <a title="编辑"  onclick="x_admin_show('编辑','{{  url('admin/user/'.$v->userId.'/edit') }}',600,400)" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a onclick="x_admin_show('修改密码','member-password.html',600,400)" title="修改密码" href="javascript:;">
                        <i class="layui-icon">&#xe631;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'{{ $v->userId }}')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <div class="page">

        {!! $user->appends($request->all())->render() !!}
    </div>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,userId){
        //获取要改变状态的用户的id

        //获取当前改变用户的状态
        var status = $(obj).attr('status');


        layer.confirm('确认吗？',function(index) {

            if ($(obj).attr('title') == '启用') {


                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/user/changestatus",
                    data: {'userId': userId, 'status': status},
                    dataType: "json",
                    success: function (data) {
                        //发异步把用户状态进行更改
                        $(obj).attr('title', '停用');
                        $(obj).find('i').html('&#xe62f;');

                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!', {icon: 5, time: 1000});
                    }
                });


            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "/admin/user/changestatus",
                    data: {'userId': userId, 'status': status},
                    dataType: 'json',
                    success: function (data) {
                        $(obj).attr('title', '启用');
                        $(obj).find('i').html('&#xe601;');

                        $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                        layer.msg('已启用!', {icon: 5, time: 1000});
                    }

                });
            }
        })
    }


    /*用户-删除*/
    function member_del(obj, userId) {
        //获取用户ID


        layer.confirm('确认要删除吗？', function (index) {

            // $.post('请求的路径','携带的参数'，执行成功后的返回结果)
            $.post("{{ url('admin/user/') }}/" + userId, {
                '_token': "{{csrf_token()}}",
                '_method': 'delete'
            }, function (data) {
                //如果删除成功
                if (data.status == 1) {
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                } else {
                    layer.msg('删除失败!', {icon: 1, time: 1000});
                }
            });


        });
    }


    function delAll() {



        //声明一个空数组，存放所有被选中的复选框的data-id属性值
        var ids = [];
        //获取所有的被选中的复选框
        $('.layui-form-checked').not('.header').each(function (i, v) {
            ids.push($(v).attr('data-id'));

        });

        $.get('/admin/user/delall', {"ids": ids}, function (data) {
            //后台如果删除成功，在前台上也把相关记录删除掉
            if (data.status == 1) {
                layer.msg('删除成功', {icon: 1});
                $(".layui-form-checked").not('.header').parents('tr').remove();
            } else {
                layer.msg('删除失败', {icon: 2});
            }
        })

    }


</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>