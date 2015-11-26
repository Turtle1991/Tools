使用方法：
(采用bootstrap)

前端 通过ajax方法 method_A 请求 到后端 必须参数：页数page
|
后端 根据 page, new ctlPage() 对象; 获取要查询的数据 $data, ctlPage->showPage() 生成新的分页栏$pageInfo;
返回结果数据 $res = array('list'=>data, 'pageInfo'=>$pageInfo);
|
前端 html 代码
<div class="modal-footer" id="pageInfo" style="margin-top: 0;"></div>
前端 js 代码
function method_A(arg1, arg2, page){
    $.ajax({
        type:'POST',
        url:'xxxxx',
        data:'arg1='+arg1+'&arg2='+arg2+'&page='+page,
        success:function(data){
            var res = eval("["+data+"]")[0];
            //--分页--
            $("#pageInfo").html(res.pageInfo);
            //绑定分页动作
            $("#pageInfo li").bind('click', function () {
                if ($(this).attr('class') == 'disabled')return;
                var queryPage = $(this).children('a').attr('value');
                method_A(arg1, arg2, queryPage);
            });
            //--列表--
            var msg = res.list;
            ...
        }
    });
}
                        