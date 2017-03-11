<?php
session_start();
if(!$_SESSION['userName']){
	$url=site_url('manage/index');
	echo "<script>alert('请登录'); location.href='".$url."'</script>";
	}
?>
