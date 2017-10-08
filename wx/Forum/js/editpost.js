$(document).ready(function(){
	window.inf={};//存储登录人信息；
	//获取用户信息 ，如获取出现问题则跳到登录界面 
	$.get("../user/userinf.php").done(function(data){
		console.log(data);
		if(data=="")
			window.location="../user/login.html";
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			window.location="../user/login.html";
			return ;
		}
		
		if(da["error"]!=0)
		{
		}
		
	});
	//设置背景高度
	$("#background").css("height",window.innerHeight+"px");
	//设置选择类型面板位置
	$("#type").css("left",(window.innerWidth-$("#type")[0].clientWidth)/2+"px");
	$("#type").css("top",(window.innerHeight-$("#type")[0].clientHeight)/2+"px")
	
	
	//为导航栏添加选中事件
	$("nav td").click(function(){
		var to=$(this).attr("to");
		$("nav td").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		$("div[cont=\"content\"]").each(function(){
			if($(this).attr("to")==to)
				$(this).show();
			else
				$(this).hide();
		});
	});
	//为编辑器提交按钮添加事件
	$("div[to=\"texteditor\"]").find("button[to=\"submit\"]").click(function(){
		var stoppost=false;
		var json={};
		if(window.msgtype==undefined)
		{
			$("#background").show(500);
			$("#type").show(500);
			return;
		}
		json["type"]=window.msgtype;
		
		$("div[to=\"texteditor\"]").find("form").find("input").filter(function(){
			if(stoppost)
				return 0;
			if(this.value=="")
			{
				this.focus();
				stoppost=true;
				return 0;
			}
			return 1;
		}).each(function(){
			json[this.name]=this.value;
		});
		
		if($("#editor").html()=="")
			stoppost=true;
		if(stoppost)
			return ;
		json["content"]=$("#editor").html();
		$.post("RecordPost.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}
			catch(e){
				alert("出错,请稍后重试");
				return ;
			}
			if(da["error"]==0)
			{
				alert("发表成功");
				history.back();
			}
		});
	});
	//添加简易提交
	$("div[to=\"simple\"]").find("form").submit(function(e){
		e.preventDefault();
		var toform=$(("div[to=\"simple\"]>form"));
		var content=toform.find("textarea").val();
		if(content=="")
		{
			toform.find("textarea").focus();
			return ;
		}
		var json={};
		json["description"]=content;
		if(window.msgtype==undefined)
		{
			$("#background").show(500);
			$("#type").show(500);
			return;
		}
		json["type"]=window.msgtype;
		$.post("RecordPost.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}
			catch(e){
				console.log(e);
				return ;
			}
			if(da["error"]==0)
			{
				alert("发表成功");
				history.back();
			}
		});
	});
	//为选择类型标签添加一定的点击事件
	$("#type>.panel-body>.label").click(function(){
		if($(this).hasClass("label-default"))
		{
			$("#type>.panel-body>.label").removeClass("label-info");
			$(this).addClass("label-info");
			window.msgtype=$(this).attr("ty");
			console.log(window.msgtype);
			$("#type").slideUp(800);;
			$("#background").hide();
			return;
		}
		if($(this).hasClass("label-info"))
			$(this).removeClass("label-info");
	});
	//为更改类型添加事件
	$(".changetype").click(function(){
		$("#background").show();
		$("#type").slideDown(600);
	})
		
});