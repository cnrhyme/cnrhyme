// JavaScript Document
//页面加载完之后触发
window.onload = function(){
	var obtn = document.getElementById('fix');
	//获取页面可视区的高度
	var clientHeight = document.documentElement.clientHeight;
	var timer = null;
	var isTop = true;
	
	window.onscroll = function(){
		var osTop = document.documentElement.scrollTop||document.body.scrollTop;
		if(osTop >= clientHeight){
			obtn.style.display = "block";
			}
			else{obtn.style.display = "none";}
		if(!isTop){
			clearInterval(timer);
			}
			isTop = false;
		}
	obtn.onclick = function()
	{
		
		//设置定时器
		timer = setInterval(function(){
		//设置离顶部的距离
		var osTop = document.documentElement.scrollTop||document.body.scrollTop;
		//一次循环的距离
		var ispeep = Math.floor(-osTop/10);
		document.documentElement.scrollTop = document.body.scrollTop = osTop+ispeep;
		isTop = true;
		if(osTop == 0){
			
			clearInterval(timer);
			}
		},30);
		
		}
	}