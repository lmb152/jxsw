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
<script type="text/javascript" charset="utf-8" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="<?php echo (BOKE_STATIC_PATH); ?>/manager/ueditor/lang/zh-cn/zh-cn.js"></script>
<style type="text/css">
  .input{
    padding: 6px;
    width: 210px;
  }
</style>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加用户组</strong></div>
  <div class="body-content" style="margin-left: 50px;">
    <form method="post" class="form-x" action="" onsubmit="return addgroup()"  enctype="multipart/form-data"  >  
      <div class="form-group">
        <div class="label" style="width: 200px;">
          <label>用户组名：</label>
        </div>
        <div class="field">
          <input  type="text" class="input w50" value="<?php echo ($data['title']); ?>" id='title' name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
       
         <input type="hidden" name="id"  id='id' value="<?php echo ($data['id']); ?>">
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" id='submit' type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body></html>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function addgroup()
    {
        if ($('#title').val() == '')
        {
           layer.msg("请输入标题");  return false;
        }
        var id = $("#id").val();
        var title  = $("#title").val();
        submit('submit', '正在提交..'); 

        $.post(
          '<?php echo U("Admin/addgroup");?>',{title:title,id:id},
          function(rs)
          {
              if(rs==1)
              {
                layer.msg('操作成功！');
                setTimeout(function(){
                    parent.layer.msg(rs.msg);
                    parent.window.location.reload();
                    parent.layer.close(index);
                },2000);
                
              }
              
          },'json'
        );

        return false;


    }

</script>