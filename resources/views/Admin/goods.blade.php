<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
        <form class="layui-form layui-col-md12 x-so" action="/admin/good" method="get" >
            {{--<input class="layui-input" placeholder="商品名称" name="gname" id="start">--}}
            {{--<input class="layui-input" placeholder="" name="end" id="end">--}}
            <input type="text" name="gname"  placeholder="请输入商品名称" value="{{$request->gname or '' }}" autocomplete="off" class="layui-input">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="text" name="sprice"  placeholder="最低价格" value="{{$request->sprice or '' }}" autocomplete="off" class="layui-input">
            &nbsp;&nbsp;------&nbsp;&nbsp;
            <input type="text" name="dsprice"  placeholder="最高价格" value="{{$request->dprice or '' }}" autocomplete="off" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','/admin/good/create')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>
                ID
            </th>
            <th>
                商品名称
            </th>
            <th>
                商品类别
            </th>
            <th>
                价格
            </th>
            <th>
                库存
            </th>
            <th>
                销量
            </th>
            <th>
                浏览量
            </th>
            <th>
                图片
            </th>
            <th>
                商品描述
            </th>
            <th>
                状态
            </th>
            <th>
                操作
            </th>
        </tr>
        </thead>

        @foreach($good as $v)
            <tbody id="x-img">
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$v->gid}}'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td>
                    {{$v->gid}}
                </td>
                <td>
                    {{$v->gname}}
                </td>
                <td>
                    {{$v->tid}}
                </td>
                <td>
                    {{$v->price}}
                </td>
                <td>
                    {{$v->stock}}
                </td>
                <td>
                    {{$v->salecnt}}
                </td>
                <td>
                    {{$v->vcnt}}
                </td>

                <td>
                    <img  src="{{ $v->gpic }}" width="300" height="100" alt="">
                </td>
                <td>
                    {{$v->gdesc}}
                </td>

                <td class="td-status">
                            <span class="layui-btn layui-btn-normal layui-btn-mini">
                                <input type="hidden" value="{{$v->status}}" >
                                已显示
                            </span>
                </td>
                <td class="td-manage">
                    <a onclick="member_stop(this,'{{ $v->gid }}')" value="{{$v->status}}" href="javascript:;" status="{{$v->status}}"  title="启用">
                        <i class="layui-icon">&#xe601;</i>
                    </a>
                    <a title="编辑"  onclick="x_admin_show('编辑','/admin/good/{{$v->gid}}/edit')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,'{{ $v->gid }}')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>

            </tbody>
        @endforeach;
    </table>
    <div class="page">
        <div>
            {!! $good->appends($request->all())->render() !!}
        </div>
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
    function member_stop(obj,gid){
        var status=$(obj).attr('status');
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/good/changestatus",
                    data: {'id':gid,'status':status},
                    dataType: "json",
                    success: function(data){
                        //发异步把用户状态进行更改
                        $(obj).attr('title','停用')
                        $(obj).find('i').html('&#xe62f;');
                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!',{icon: 5,time:1000});
                    }
                });
            }else{
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/good/changestatus",
                    data: {'id':gid,'status':status},
                    dataType: "json",
                    success: function(data){
                    $(obj).attr('title','启用')
                    $(obj).find('i').html('&#xe601;');

                    $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                    layer.msg('已启用!',{icon: 5,time:1000});
                }
             });
            }
        });
    }

    /*用户-删除*/
    function member_del(obj,gid){
        //获取用户ID
        layer.confirm('确认要删除吗？',function(index){
            // $.post('请求的路径','携带的参数'，执行成功后的返回结果)
            $.post("{{ url('admin/good/') }}/"+gid,{'_token':"{{csrf_token()}}",'_method':'delete'},function(data){
                //如果删除成功
                if(data.status == 0){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else{
                    layer.msg('删除失败!',{icon:1,time:1000});
                }
            });
        });
    }

    //
    //
    function delAll () {

        var data = tableCheck.getData();

        //获取所有的复选框
        var gid=$('.layui-form-checked').not('.header').each(function(i,v){
            //声明数组获取复选框中的data-id属性值
            var ids=[];
            ids.push($(v).attr('data-id'))
            // console.log(ids);

            $.get('/admin/good/delall',{"ids":ids},function(data){
                if(data.status==0){
                    layer.msg('删除成功', {icon: 1});
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                }else{
                    layer.msg('删除失败', {icon: 2});
                }

            });

        })
        //
        // layer.confirm('确认要删除吗？'+data,function(index){
        //     //捉到所有被选中的，发异步进行删除
        //     layer.msg('删除成功', {icon: 1});
        //     $(".layui-form-checked").not('.header').parents('tr').remove();
        // });
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