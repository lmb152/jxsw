<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <link rel="stylesheet" href="<?php echo (BOKE_STATIC_PATH); ?>/manager/css/pintuer.css">
    <link rel="stylesheet" href="<?php echo (BOKE_STATIC_PATH); ?>/manager/css/admin.css">
    <script src="<?php echo (BOKE_STATIC_PATH); ?>/manager/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/js/common.js"></script>
    <script type="text/javascript" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/js/layer/layer.js"></script>
    <script type="text/javascript" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/js/select.js"></script>
</head>
<form method="post" action="" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 菜单列表</strong> 
    </div>
    <div class="padding border-bottom">
      <ul class="search" style="padding-left:10px;">
        <li> <a class="button border-main icon-plus-square-o" href="javascript:void(0);" onclick="addactionfu(0);"> 添加菜单</a> </li>
       
        <li>
         
      </ul>
    </div>
  <td colspan="10">
    <table class="table table-hover text-center">
      <tr style=" height: 35px;">
          <!--     <div class="pagelist paging_bootstrap" style='text-align:center'>
              <ul class="pagination"><?php echo ($page); ?></ul>
              </div> -->

        <th width="100" style="text-align:left; padding-left:40px;">ID</th>
        <th ><b>功能名称</b></th>
        <th ><b>模块/方法</b></th>
        <th >操作</th>
        </tr>
            <?php if(is_array($actionList)): foreach($actionList as $key=>$vo): ?><tr style=" height: 35px;">
                  <td > <?php echo ($vo["id"]); ?> </td>
                  <td><b><?php echo ($vo["name"]); ?></b> </td>
                  <td><?php echo ($vo['url']); ?></td>
                  <td>
                    <div class="button-group"> 
                      <a class="button border-main" href="javascript:void(0);" onclick="addaction(<?php echo ($vo['id']); ?>);"><span class="icon-add"></span> 添加子菜单</a>
                      <a class="button border-main" href="javascript:void(0);" onclick="exitaction(<?php echo ($vo['id']); ?>,'edit');"><span class="icon-edit"></span> 修改</a>
                      <!-- <a class="button border-red" href="javascript:void(0)" onclick="del();"><span class="icon-trash-o"></span> 删除</a>  -->
                   </div>
                  </td>
                </tr>
            <?php if(is_array($vo['child'])): foreach($vo['child'] as $key=>$c): ?><tr style=" height: 35px;">
                    <td > <?php echo ($c["id"]); ?> </td>
                    <td><span style="margin-left:40px;">∟ <?php echo ($c["name"]); ?></span> </td>
                    <td><?php echo ($c['url']); ?></td>
                    <td><div class="button-group"> 
                     <a class="button border-main" href="javascript:void(0);" onclick="addaction(<?php echo ($c['id']); ?>);"><span class="icon-add"></span> 添加子菜单</a>
                      <a class="button border-main" href="javascript:void(0);" onclick="exitaction(<?php echo ($c['id']); ?>,'edit','2');"><span class="icon-edit"></span> 修改</a>
                     <!-- <a class="button border-red" href="javascript:void(0)" onclick="return del(1,1,1)"><span class="icon-trash-o"></span> 删除</a>  -->
                     </div></td>
                </tr>
                <?php if(is_array($c['child'])): foreach($c['child'] as $key=>$cc): ?><tr style=" height: 35px;">
                    <td > <?php echo ($cc["id"]); ?> </td>
                    <td><span style="margin-left:80px;">&nbsp;|—<?php echo ($cc["name"]); ?></span> </td>
                    <td><?php echo ($cc['url']); ?></td>
                    <td><div class="button-group"> 
                    <a disabled="" class="button " ><span class="icon-add "></span> 添加子菜单</a>
                    <a class="button border-main" href="javascript:void(0);" onclick="exitaction(<?php echo ($cc['id']); ?>,'edit','2');"><span class="icon-edit"></span> 修改</a>
                     <!-- <a class="button border-red" href="javascript:void(0)" onclick="return del(1,1,1)"><span class="icon-trash-o"></span> 删除</a>  -->
                     </div></td>
                </tr><?php endforeach; endif; endforeach; endif; endforeach; endif; ?>

            <tr>
                <td colspan="10">
                <div class="pagelist paging_bootstrap" style='text-align:center'>
                <ul class="pagination"><?php echo ($page); ?></ul>
                </div>
                </td>
            </tr>
     
    </table>
  </div>
</form>
<script type="text/javascript">
//  设置轮播图
function addaction(id){

   layer.open({
          type: 2,
          title: false,
          area: ['60%', '50%'],
          shade: 0.8,
          shadeClose: true,
          content: '<?php echo U("Action/addaction");?>?pid='+id,
        });

}
function addactionfu(){

   layer.open({
          type: 2,
          title: false,
          area: ['60%', '50%'],
          shade: 0.8,
          shadeClose: true,
          content: '<?php echo U("Action/addactionfu");?>',
        });

}

function exitaction(id,type,mark){

   layer.open({
          type: 2,
          title: false,
          area: ['60%', '40%'],
          shade: 0.8,
          shadeClose: true,
          content: '<?php echo U("Action/addaction");?>?pid='+id+'&type='+type+'&mark='+mark,
        });

}


//搜索
function changesearch(){  
    
}

//单个删除
function del(id,mid,iscid){
  if(confirm("您确定要删除吗?")){
    
  }
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
    if (this.checked) {
      this.checked = false;
    }
    else {
      this.checked = true;
    }
  });
})

//批量删除
function DelSelect(){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){
    var t=confirm("您确认要删除选中的内容吗？");
    if (t==false) return false;   
    $("#listform").submit();    
  }
  else{
    alert("请选择您要删除的内容!");
    return false;
  }
}

//批量排序
function sorts(){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){  
    
    $("#listform").submit();    
  }
  else{
    alert("请选择要操作的内容!");
    return false;
  }
}


//批量首页显示
function changeishome(o){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){
    
    $("#listform").submit();  
  }
  else{
    alert("请选择要操作的内容!");    
  
    return false;
  }
}

//批量推荐
function changeisvouch(o){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){
    
    
    $("#listform").submit();  
  }
  else{
    alert("请选择要操作的内容!");  
    
    return false;
  }
}

//批量置顶
function changeistop(o){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){    
    
    $("#listform").submit();  
  }
  else{
    alert("请选择要操作的内容!");    
  
    return false;
  }
}


//批量移动
function changecate(o){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){    
    
    $("#listform").submit();    
  }
  else{
    alert("请选择要操作的内容!");
    
    return false;
  }
}

//批量复制
function changecopy(o){
  var Checkbox=false;
   $("input[name='id[]']").each(function(){
    if (this.checked==true) {   
    Checkbox=true;  
    }
  });
  if (Checkbox){  
    var i = 0;
      $("input[name='id[]']").each(function(){
        if (this.checked==true) {
        i++;
      }   
      });
    if(i>1){ 
        alert("只能选择一条信息!");
      $(o).find("option:first").prop("selected","selected");
    }else{
    
      $("#listform").submit();    
    } 
  }
  else{
    alert("请选择要复制的内容!");
    $(o).find("option:first").prop("selected","selected");
    return false;
  }
}

</script>
</body>
</html>