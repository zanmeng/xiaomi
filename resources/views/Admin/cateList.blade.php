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
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
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

<div class="x-body" >
    <xblock>
        <button class="layui-btn"><i class="layui-icon"></i>商品分类</button>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                ID
            </th>
            <th>
                分类名称
            </th>
            <th>
                父分类
            </th>
            <th>
                路径
            </th>
            <th>
                操作
            </th>

        </tr>
        </thead>

        @foreach($cate as $v)
            <tbody id="x-img">
            <tr>
                <td>
                    {{$v->catId}}
                </td>
                <td>
                    {{$v->catName}}
                </td>
                <td>
                    {{$v->parentId}}
                </td>
                <td>
                    {{$v->path}}
                </td>
                <td>
                    <a class="link-update" href="./index.php?m=admin&c=cate&a=edit&cid=<?=$v->cid?>">修改</a>
                    <a class="link-del" href="/admin/cate/delete/{{$v->catId}}">删除</a>
                </td>
            </tr>

            </tbody>
        @endforeach;
    </table>
    <div class="page">
        <div>
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
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // // },
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
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
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