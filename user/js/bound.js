$(document).ready(function(){
	//显示界面
	(function(){
		var to = "bound";
		$("div[to=\""+to+"\"]").show();
		$("div[cont=\"content\"]").filter(function(){
		return this.getAttribute("to")!=to;}).hide();
		})();
	//检测是否登录并改变导航栏
	$.get("userinf.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
			//切换显示状态
			$("#navbar ul[to=\"nologin\"]").hide();
			$("#navbar ul[to=\"alreadylogin\"]").show();
			(function(){
				$("div[to=\"login\"]").hide();
				$("div[to=\"alreadylogin\"]").hide();
				
			})();
		}catch(e){
			console.log(e);
			return;
		}
	});
	
	//屏蔽登陆表单提交
	$("#login form").submit(function(e){
		e.preventDefault();
		var json={};
		var stoppost=false;
		
		$("#login input").filter(function(){
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
			json[$(this).attr("names")]=this.value;
			if($(this).attr("names")=="Password")
			{
				json[$(this).attr("names")]=hex_md5(this.value);
				window.code=this.value;
			}
		});
		
		if(stoppost)
			return;
		$.post("login.php",json).done(function(data){
			console.log(data);
			if(data=="200")
			{
				history.back();
				return;
			}
			if(data=="405")
			{
				alert("账号不存在/账号密码错误");
			}
			if(data=="again")
			{
				json["oricode"]=window.code;
				console.log(json);
				
				$.post("login.php",json).done(function(data){
					console.log(data);
					if(data=="200")
					{
						history.back();
						return ;
					}
					if(data=="405")
					{
						alert("账号不存在/账号密码错误");
					}
					
				});
			}
			
			
		});
	});
	
	
	
	//添加退出登录代码
	$("#navbar a[to=\"logout\"]").click(function(){
		$.get("logout.php").done(function(){
			$("#navbar ul[to=\"nologin\"]").show();
			$("#navbar ul[to=\"alreadylogin\"]").hide();
		});
	});
	
	//屏蔽绑定表单提交
	$("#bound form").submit(function(e){
		e.preventDefault();
		var json={};
		var stoppost=false;
		
		$("#bound input").filter(function(){
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
			json[$(this).attr("names")]=this.value;
			if($(this).attr("names")=="Password")
			{
				json[$(this).attr("names")]=hex_md5(this.value);
				window.code=this.value;
			}
		});
		
		if(stoppost)
			return;
		$.post("bound.php",json).done(function(data){
			console.log(data);
			if(data=="200")
			{
				history.back();
				return;
			}
			if(data=="405")
			{
				alert("账号不存在/账号密码错误");
			}
			if(data=="again")
			{
				json["oricode"]=window.code;
				console.log(json);
				
				$.post("bound.php",json).done(function(data){
					console.log(data);
					if(data=="200")
					{
						history.back();
						return ;
					}
					if(data=="405")
					{
						alert("账号不存在/账号密码错误");
					}
					
				});
			}
			
			
		});
		});
	
	//屏蔽注册表单提交
	$("#register form").submit(function(e){
		e.preventDefault();
		});
	//添加注册提交
	$("#register button").click(function(){
		var json={};
		var email=/(@qq.com)$/;
		var stoppost=false;
		var password="";
		$("#register input").filter(function(){
			if(stoppost)
				return 0;
			if(this.value=="")
			{
				this.focus();
				stoppost=true;
				return 0;
			}
			if(password!="" && $(this).attr("names")=="Password" && password!=this.value)
			{
				stoppost=true;
				this.value="";
				alert("密码输入不一致");
				return 0;
			}
			if(password=="" && $(this).attr("names")=="Password")
				password=this.value;
			
			if($(this).attr("names")=="email" && !email.test(this.value))
			{
				alert("邮箱必须是qq邮箱");
				this.focus();
				stoppost=true;
				return 0;
			}
			return 1;
		}).each(function(){
			json[$(this).attr("names")]=this.value;
		});
		
		console.log(json);
		if(stoppost)
			return;
		$.post("register.php",json).done(function(data){
			if(data=="200")
			{
				alert("注册成功");
			    location.href="http://nuaakx.com/t/user/";
			}
			else if(data!="")
			{
				console.log(data);
				alert(data);
			}
			else
			{
				alert("注册失败");
			}
		});
	});
	//添加手机显示导航栏被点击后隐藏
	(function(){
		$("#navbar a[makenavhide=\"1\"]").click(function(){
			$("#navbar").removeClass("in").attr("aria-expanded","false");
		});
	})();
	
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
	//添加切换
	//为导航栏 每个具有 to 属性的 a 添加对应的显示界面
	$("div[name=\"switch\"] a").filter(function(){
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
	
});