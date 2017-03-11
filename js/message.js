<script>   
function fun1(){   
  var k=document.myform.qq.value;   
  
  //^表示不匹配。d表示任意数字，{5,10}表示长度为5到10。   
  var reg=/^\d[1-9]{5,10}$/;    
  
  //用上面定义的正则表达式测试，如果不匹配则返回false   
  if(!reg.test(k)){   
    alert("请输入你正确的QQ号");   
    return false;   
  }   
}   
</script>