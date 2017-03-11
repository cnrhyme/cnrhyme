<?php
//创建于2016年7月12日
Header("Content-type: image/PNG"); 
$this->load->helper('rndnum');
session_start();
$_SESSION["extra_code"]="";
$rndnum=new rndnum();//调用函数产生随机数
$authnum=$rndnum->rnd();
$_SESSION["extra_code"]=$authnum;

$im = imagecreate(72,20); //imagecreate() 返回一个图像标识符，代表了一幅大小为 x_72 和 y_20 的空白图像。
$black = ImageColorAllocate($im, 0,0,0); /*第一次对 imagecolorallocate() 的调用会给基于调色板的图像填充背景色，即用 imagecreate() 建立的图像。*/
$white = ImageColorAllocate($im, 255,255,255); // 设定一些颜色
$gray = ImageColorAllocate($im, 200,200,200); // 设定一些颜色
imagefill($im,0,0,$gray);
imagestring($im,5,10,3,$authnum,$black); 
for($i=0;$i<200;$i++) //加入干扰象素 
{ 
$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
} 
ImagePNG($im); //imagepng(int im, string [filename]);本函数用来建立一张 PNG 格式图形,im 为使用 ImageCreate() 所建立的图片代码参数 filename 可省略，若无本参数 filename，则会将图片指接送到浏览器端，记得在送出图片之前要先送出使用 Content-type: image/png 的标头字符串 (header) 到浏览器端，以顺利传输图片
ImageDestroy($im); 
?>

