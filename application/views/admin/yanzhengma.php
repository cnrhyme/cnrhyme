<?php
//������2016��7��12��
Header("Content-type: image/PNG"); 
$this->load->helper('rndnum');
session_start();
$_SESSION["extra_code"]="";
$rndnum=new rndnum();//���ú������������
$authnum=$rndnum->rnd();
$_SESSION["extra_code"]=$authnum;

$im = imagecreate(72,20); //imagecreate() ����һ��ͼ���ʶ����������һ����СΪ x_72 �� y_20 �Ŀհ�ͼ��
$black = ImageColorAllocate($im, 0,0,0); /*��һ�ζ� imagecolorallocate() �ĵ��û�����ڵ�ɫ���ͼ����䱳��ɫ������ imagecreate() ������ͼ��*/
$white = ImageColorAllocate($im, 255,255,255); // �趨һЩ��ɫ
$gray = ImageColorAllocate($im, 200,200,200); // �趨һЩ��ɫ
imagefill($im,0,0,$gray);
imagestring($im,5,10,3,$authnum,$black); 
for($i=0;$i<200;$i++) //����������� 
{ 
$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
} 
ImagePNG($im); //imagepng(int im, string [filename]);��������������һ�� PNG ��ʽͼ��,im Ϊʹ�� ImageCreate() ��������ͼƬ������� filename ��ʡ�ԣ����ޱ����� filename����ὫͼƬָ���͵�������ˣ��ǵ����ͳ�ͼƬ֮ǰҪ���ͳ�ʹ�� Content-type: image/png �ı�ͷ�ַ��� (header) ��������ˣ���˳������ͼƬ
ImageDestroy($im); 
?>

