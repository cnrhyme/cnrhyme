<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片上传</title>
<style type="text/css">
html,body,div,ul,li{ padding:0 auto; margin:0 auto;}
#divs{ margin: 0px;; padding:0px; display:block;}
</style>
</head>
<!--<script language="javascript">
function ChangeUpFile()
{
	if (document.getElementById("photo").value == "")
	{
		alert ("对不起，请上传图片！");
		document.getElementById("photo").focus();
		return false;
	}
}
</script>-->
<body>
<?php if ($filename == "") : ?>
		<div id="divs">
        	<form action="<?php echo site_url('admin/upload/img_upload_save')?>?inputid=<?=$inputid?>&picid=<?=$picid?>" name="UForm" method="post" enctype="multipart/form-data" onSubmit="return ChangeUpFile()">
            	   <input  type="file" name="photo" id="photo" style="float:left;">
                   <input type="submit" value="上传图片" style="float:left;">
            </form>
        </div>
         
 <?php else : ?>
    <div id="divs">
    	<input name="Preview" type="button" class="btn" id="Preview" value="预览图片"  onClick="window.open('<?=$pathurl?>');">
        <input name="Delete" type="button" class="btn" id="Delete" value="删除" onClick="if(confirm('删除图片吗!?')==true )
        {location.href='<?php echo site_url("admin/upload/deleteImg");?>?action=del&inputid=<?=$inputid?>&filename=<?=$filename?>&picid=<?=$picid?>'; }">
	</div>
<?php endif;?>
</body>
</html>
