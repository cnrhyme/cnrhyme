<?php
//生成随机数2016年7月12日:rndnum.php
class rndnum{
function rnd(){
$rnd_number=array(
						  1=>'1',
						  2=>'2',
						  3=>'3',
						  4=>'4',
						  5=>'5',
						  6=>'6',
						  7=>'7',
						  8=>'8',
						  9=>'9',
						  10=>'a',
						  11=>'b',
						  12=>'c',
						  13=>'d',
						  14=>'e',
						  15=>'f',
						  16=>'g',
						  17=>'h',
						  18=>'i',
						  19=>'j',
						  20=>'k',
						  21=>'l',
						  22=>'m',
						  23=>'n',
						  24=>'o',
						  25=>'p',
						  26=>'q',
						  27=>'r',
						  28=>'s',
						  29=>'t',
						  30=>'u',
						  31=>'v',
						  32=>'w',
						  33=>'x',
						  34=>'y',
						  35=>'z',
						  36=>'0'
);
$result=array_rand($rnd_number,4);
$j=count($result);
$re="";
for ($i=0;$i<$j;$i++) {
$re.=$rnd_number[$result[$i]];
}
//$re=$rnd_number[$result[1]].$rnd_number[$result[2]].$rnd_number[$result[3]].$rnd_number[$result[4]].$rnd_number[$result[5]].$rnd_number[$result[6]].$rnd_number[$result[7]];
//return array_keys($result);

return $re;
}
}
/*用法
$rndnum=new rndnum();
$num=$rndnum->rnd();
echo $num;
*/
?>
