/*自定义jquery插件 用来写 ajax 请求 
author：宋胜利
引入此文件前必须引入jquery
编写理由：用$.ajax 出现莫名问题 ，原生的才是最强大的，同时为了符合自己的编码习惯

所有返回信息都以string形式返回

data 若为string形式则会原样提交 若object 则会转化成 键值对形式

*/

$.extend({
	aj:function(options){
		var defaults={
			url:"",
			method:"get",
			success:function(){},
			error:function(){},
			data:"",
			stop:function(){}
		}
		var op=$.extend({}, defaults, options);
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		  var url=op.url;
		  var data="";
		  if(typeof(op.data)==="string")
		  {
			  data+=op.data;
		  }else if(typeof(op.data)==="object")
		  {
			  for(var p in op.data)
			  {
				  data=p+"="+op.data[p]+"&";
			  }
		  }
		  if(op.method.toLowerCase()=="get")
		  {
			  url+="?"+data;
			  
			  
			  xmlhttp.onreadystatechange=function(){
				  if(xmlhttp.readyState==0)
				  {
					  op.start();
				  }
				  if(xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					  op.success(xmlhttp.responseText);
					  op.stop();
				  }
				  else if(xmlhttp.readyState==4)
				  {
					  op.error(xmlhttp.status);
					  op.stop();
					  
				  }
			  }
			  xmlhttp.open("GET",url);
			  xmlhttp.send();
		  }
		  else if(op.method.toLowerCase()=="post")
		  {
			  
			  
			  xmlhttp.onreadystatechange=function(){
				  if(xmlhttp.readyState==0)
				  {
					  op.start();
				  }
				  if(xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					  op.success(xmlhttp.responseText);
					  op.stop();
				  }
				  else if(xmlhttp.readyState==4)
				  {
					  op.error(xmlhttp.status);
					  op.stop();
					  
				  }
			  }
			  xmlhttp.open("POST",url);
			  xmlhttp.send(data);
		  }
		},
	haha:function(){
			alert("haf");
		}
})
//下边这段用来解决 点击图片后看大图的功能

$("img").click(function(){
	var html="<div id=\"img-current\" style=\"width:100%; background-color:black; top:0; left:0;  position:fixed; z-index:100; opacity: 80%; overflow:auto;\" align=\"center\" ><span class=\"glyphicon glyphicon-remove\" style=\"color:white; float:right; margin-top:20px; margin-right:20px;\" ></span>	<img src=\""+$(this).attr("src")+"\" style=\"width:100%; max-width:500px;\" >	<br></div>";
	$("body").append(html);
	$("#img-current").css("height",window.innerHeight+"px");
	var imgcurrentwidth;
	var imgheight;
	
	$("#img-current").each(function(){
		imgcurrentwidth=this.clientWidth;
	});
	$("#img-current img").each(function(){
		imgheight=this.height;
	});
	console.log(imgheight);
	console.log(imgcurrentwidth);
	var left=(window.innerWidth-imgcurrentwidth)/2;
	
	$("#img-current").css("left",left+"px");
	var imgtop=(window.innerHeight-imgheight)/2;
	$("#img-current img").css("margin-top",imgtop+"px");
	$("#img-current span.glyphicon-remove").click(function(){
		$(this).parent().remove();
	});
		
});
	
	


	
				  
	
	 