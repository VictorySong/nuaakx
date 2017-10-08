$(document).ready(function () {
  $('[data-toggle="offcanvas"]').click(function () {
	$('.row-offcanvas').toggleClass('active')
  });
  var load=function(){
	$.get("KxJudge.php?1").done(function(data){
		if(data!="")
		{
			console.log(data);
			//获得最新通知
		   (function(){
			$.get("getnewinternalnotice.php").done(function(data){
				console.log(data);
				try{
					var da=JSON.parse(data);
				}catch(e)
				{
					console.log(e);
					return;
				}
				$("#newnotice h1").text(da["title"]);
				$("#newnotice p[class=\"lead\"]").text(da["description"]);
				$("#newnotice p a").attr("href",da["url"]);
			});
			})();
			try{
				
				var da=JSON.parse(data);
			}
			catch(e){
				console.log(e);
				return;
			}
			
			
			//切换显示状态
			$("#navbar ul[to=\"nologin\"]").hide();
			$("#navbar ul[to=\"alreadylogin\"]").show();
			
		}
		else{
			window.location="../user/login.html";
		}
	});
	};
	load();
	//添加退出登录代码
	$("#navbar a[to=\"logout\"]").click(function(){
		$.get("logout.php").done(function(){
			window.location="http://nuaakx.com/test/manager";
		});
	});
	
	//添加手机显示导航栏被点击后隐藏
	(function(){
		$("#navbar a[makenavhide=\"1\"]").click(function(){
			$("#navbar").removeClass("in").attr("aria-expanded","false");
		});
	})();
	//添加登录   被抛弃
	$("#login form").submit(function(e){
		e.preventDefault();
	});
	//被抛弃不用
	$("#login button").click(function(){
			var json={};
			var id=$("#login input[to=\"id\"]");
			var code=$("#login input[to=\"code\"]");
			if(id.val()=="")
				
			json[id.attr("names")]=id.val();
			json[code.attr("names")]=hex_md5(code.val());
			$.post("login.php",json).done(function(data){
				console.log(data);
				if(data=="200")
				{
					var to ="login";
					$("div[to=\""+to+"\"]").hide();
					$("div[to=\"home\"]").show();
					load();
				}
				else if(data=="404"){
					alert("账号不存在");
				}
			});
		});
	//设置 所有 a href="#" 的链接到login
	/*
	$("a[href=\"#\"]").click(function(){
		var to = "login";
		$("div[to=\""+to+"\"]").show('slow');
		$("div[cont=\"content\"]").filter(function(){
		return this.getAttribute("to")!=to;}).hide();
	});*/
	
		
		
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//一下这段为实现同一文件内切换界面 但 因返回键问题 后采用 不同文件
//添加代码组界面
/*
$("#navbar a[to=\"KxXqDm\"]").click(function(){
	var to = this.getAttribute("to");
	$("div[to=\""+to+"\"]").show("fast");
	$("div[cont=\"content\"]").filter(function(){
	return this.getAttribute("to")!=to;}).hide();
	});*/
	
	
//为导航栏 每个具有 to 属性的 a 添加对应的显示界面
$("#navbar a").filter(function(){
	var to = this.getAttribute("to");
	if(to)
		return 1;
	}).click(function(){
	var to=$(this).attr("to");
	$("div[to=\""+to+"\"]").show("fast");
	$("div[cont=\"content\"]").filter(function(){
	return this.getAttribute("to")!=to;}).hide();
	
	return false;
	});

//添加登录 被抛弃
/*
$("#navbar a[to=\"login\"]").click(function(){
	var to = this.getAttribute("to");
	$("div[to=\""+to+"\"]").show("fast");
	$("div[cont=\"content\"]").filter(function(){
	return this.getAttribute("to")!=to;}).hide();
	});
	*/
//添加首页
/*
$("nav a[to=\"home\"]").click(function(){
	var to = this.getAttribute("to");
	$("div[to=\""+to+"\"]").show('slow');
	$("div[cont=\"content\"]").filter(function(){
	return this.getAttribute("to")!=to;}).hide();
	});*/
//处理查看自定义回复
/*
$("a[to=\"CKW\"]").click(function(){
	var to = this.getAttribute("to");
	$("div[to=\""+to+"\"]").show('slow');
	$("div[cont=\"content\"]").filter(function(){
	return this.getAttribute("to")!=to;}).hide();
	$.get("getkeywords.php").done(function(data){
	var keywords=JSON.parse(data);
	$("#keywords tbody>tr").remove();
	for(var p in keywords)
	{
		var str="";
		if(keywords[p]["msgtype"]=="news")
		{
			str="<tr><td>"+keywords[p]["num"]+"</td><td>"+keywords[p]["keywords"]+"</td><td>"+keywords[p]["msgtype"]+"</td><td>"+keywords[p]["url"]+"</td><td>sit</td></tr>";
		}
		else
		{
			str="<tr><td>"+keywords[p]["num"]+"</td><td>"+keywords[p]["keywords"]+"</td><td>"+keywords[p]["msgtype"]+"</td><td>"+keywords[p]["content"]+"</td><td>sit</td></tr>";
		}
		$("#keywords tbody").append(str);
	}
	});
	});*/
////////////////////////////////////////////////////////////////////////////