//数据处理函数
function chapage(){
	var to = "CKW";
	var chpage=$("#chpage span");
	/* 未采用hash 时
	$("div[to=\""+to+"\"]").show('fast');
	$("div[cont=\"content\"]").filter(function(){
	return this.getAttribute("to")!=to;}).hide();
	*/
	
	console.log({p:chpage.attr("chpagenum"),tableName:window.tableName});
	$.get("getmembers.php",{p:chpage.attr("chpagenum"),tableName:window.tableName}).done(function(data){
			console.log(data);
			var keywords=JSON.parse(data);
			$("#members tbody>tr").remove();
			var i=1;
			//该文件由 getkeywords.html 更改而来 与 其不同的是 结果放在了 ["result"] 中  变量 仍定义成 keywords  简单的保留 创作痕迹吧
			for(var p in keywords["result"])
			{
				var str="";
				
				//采用 改变hash 后此句有所改变 ，采用hash 后不需要 单独设置返回键 一个界面当多个界面用，切换时 个人感觉会更好
				//str="<tr><td>"+i+"</td><td>"+undef(keywords["result"][p]["stId"])+"</td><td>"+undef(keywords["result"][p]["name"])+"</td><td>"+undef(keywords["result"][p]["email"])+"</td><td>"+undef(keywords["result"][p]["phone"])+"</td><td><a href=\"#\" delete=\""+undef(keywords["result"])[p]["stId"]+"\">delete</a></td><td><a href=\"#\" sendmail=\""+undef(keywords["result"][p]["email"])+"\">sendmail</a></td></tr>";
				str="<tr><td>"+i+"</td><td>"+undef(keywords["result"][p]["stId"])+"</td><td>"+undef(keywords["result"][p]["name"])+"</td><td>"+undef(keywords["result"][p]["email"])+"</td><td>"+undef(keywords["result"][p]["phone"])+"</td><td><a href=\"#CKW\" delete=\""+undef(keywords["result"])[p]["stId"]+"\">delete</a></td><td><a href=\"#edit\" sendmail=\""+undef(keywords["result"][p]["email"])+"\">sendmail</a></td></tr>";
				$("#members tbody").append(str);
				
				i++;
			}
			chpage.attr("chpageall",Math.ceil(keywords["total"]/10));
			chpage.text(chpage.attr("chpagenum")+"/"+chpage.attr("chpageall"));
			deleted();
			sendmail();
		});
	}
	//刷新删除的函数
function deleted(){
	$("#members tbody a").filter(function(){
		if($(this).attr("delete"))
			return 1;
		else 
			return 0;
	}).off("click").click(function(){
		if($(this).attr("delete")=="")
			return ;
		$.get("deletemembers.php",{stId:$(this).attr("delete"),tableName:window.tableName}).done(function(data){
			console.log(data);
			if(data=="200")
				chapage();
		});
	});
}

//邮件发送事件绑定函数
function sendmail(){
	$("#members tbody a").filter(function(){
		if($(this).attr("sendmail")!=undefined)
			return 1;
		else 
			return 0;
	}).on("click",sendmailto);
}
function sendmailto(){
	window.editstate="sendmail";
	if($(this).attr("sendmail")=="" || $(this).attr("sendmail")=="undefined" || !$(this).attr("sendmail") )
	{
		alert("该同学未绑定邮箱");
		return false;
	}
	window.email=$(this).attr("sendmail");//提交邮件时会用到//确定邮件是发送到谁的
	$("div[to=\"edit\"]").show();
	$("div[cont=\"content\"]").filter(function(){
		return $(this).attr("to")!="edit";
	}).hide();
	
}
//获取招新报名信息的函数
function getrecruit(){
	console.log({p:window.recruitp,tableName:window.tableName});
	if(window.recruitend)
		return;
	$.post("getrecruit.php",{p:window.recruitp,tableName:window.tableName}).done(function(data){
		console.log(data);
		var department={};
		department["KxXqDm"]="WEB研发部";
		department["KxXqChy"]="创意设计部";
		department["KxXqTs"]="网络宣传部";
		department["KxJsJf"]="技术服务部";
		department["KxJsDj"]="大疆俱乐部";
		department["KxShwWl"]="外联部";
		department["KxShwYj"]="院校交流部";
		department["KxShwGl"]="管理部";
		department["KxHdKh"]="科技活动部";
		department["KxHdKp"]="科技培训部";
		
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
			return;
		}
			if(da["error"]==0)
			{
				//显示报名总人数
				$("#recruitnum").text(da["num"]);
				
				if(da["msg"].length<20)
					window.recruitend=true;
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" cont="name" data-toggle="collapse" data-parent="#recruit1" data-target="#'+da["msg"][p]["stId"]+'">\
										'+da["msg"][p]["stId"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'\
									</h3>\
								</div>\
								<div id="'+da["msg"][p]["stId"]+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="img-circle" style="width: 60px;height: 60px;margin:0 auto; overflow: hidden;"><img class="" src="getimg.php?stid='+da["msg"][p]["stId"]+'&department='+window.tableName+'" style="width: 60px;margin-top: -5px;"></div>\
										<div class="form-group">\
											<label >学号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["stId"]+'" cont="stId">\
										</div>\
										<div class="form-group">\
											<label >姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["name"]+'" cont="name">\
										</div>\
										<div class="form-group">\
											<label >手机:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["phone"]+'" cont="phone">\
										</div>\
										<div class="form-group">\
											<label >邮箱:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["email"]+'" cont="email">\
										</div>\
										<div class="form-group">\
											<label >简介:</label>\
											<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" cont="description">'+da["msg"][p]["description"]+'</div>\
										</div>';
						for(var z in da["msg"][p]["department"])
						{
							html+='<div class="form-group">\
										<label >部门:'+department[da["msg"][p]["department"][z]["department"]]+'<span class="label '+(da["msg"][p]["department"][z]["first"]==1? "label-success":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" intention="1" department="'+da["msg"][p]["department"][z]["department"]+'">一面意向</span><span class="label '+(da["msg"][p]["department"][z]["second"]==1? "label-success":"label-default")+'" stId="'+da["msg"][p]["stId"]+'" intention="2" department="'+da["msg"][p]["department"][z]["department"]+'">二面意向</span></label>\
										<br><label style="font-size:12px; font-weight:normal;">一面评价</label>\
										<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["firstevaluate"]==null || da["msg"][p]["department"][z]["firstevaluate"]==""? "":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="first">'+(da["msg"][p]["department"][z]["firstevaluate"]==null? "":da["msg"][p]["department"][z]["firstevaluate"])+'\
										</div>\
										<label style="font-size:12px; font-weight:normal;">二面评价</label>\
										<div class=""  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["secondevaluate"]==null || da["msg"][p]["department"][z]["secondevaluate"]==""?"":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="second">'+(da["msg"][p]["department"][z]["secondevaluate"]==null?"":da["msg"][p]["department"][z]["secondevaluate"])+'\
										</div>\
									</div>';
						}
										
						html+='</div>\
									</div>\
								</div>';
					$("#recruit1").append(html);
				}
				$("[intention=\"1\"]").click(recruitintention);//意向
				$("[intention=\"2\"]").click(recruitintention);//意向
				$("[cont=\"recruitdepartment\"]").click(recruitevaluate);//评价函数
				if(window.recruitend)
				{
					$("#recruit1").append('<div style="text-align:center;">无更多</div>');
				}
			}
		
	});
}

//意向确认函数
function recruitintention(){
	if($(this).hasClass("label-success"))
		return;
	if($(this).hasClass("label-default"))
	{
		//$(this).removeClass("label-default");
		window.intentionthat=$(this);
		//$(this).addClass("label-success"); 
	}
	var json={};
	json["stId"]=$(this).attr("stId");
	json["intention"]=$(this).attr("intention");
	json["department"]=$(this).attr("department");
	$.post("confirmintention.php",json).done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e)
		{
			console.log(e);
			return;
		}
		if(da["error"]==0)
		{
			window.intentionthat.removeClass("label-default");
			window.intentionthat.addClass("label-success");
		}
	});
}
//评价函数
function recruitevaluate(){
	if($(this).attr("already"))
	{
		console.log("出错");
		return;
	}
	
	$("#rootinput").show();
	$("#background").show();
	var fo=$("#rootinput").find("form");
	fo.attr("action",$(this).attr("action"));
	fo.attr("stId",$(this).attr("stId"));
	fo.attr("department",$(this).attr("department"));
	fo.attr("time",$(this).attr("time"));
	fo.find("textarea").focus();
}
//滚动监听处理函数
function nextrecruit(){
	if(($(this).scrollTop()+$(this)[0].clientHeight)==$("#recruit>div")[0].clientHeight && !window.recruitend)
	{
		window.recruitp++;
		getrecruit();
	}
}
//根据hash 执行请求的函数
function hashrequest(){
	switch(location.hash)
	{
		case "#CKW":
		{
			//查看部门成员
			chapage();
		}
		break;
		case "#recruit":
		{
			//查看招新报名本部门成员
			getrecruit();
		}
		break;
		case "#fixcomputer":
		{
			//查看预约维修信息
			getfixcomputer();
		}
		break;
		case "#fixcomputerconf":
		{
			//获取配置信息
			getfixconf();
		}
		break;
		case "#gethd":
		{
			//获取活动名称
			gethd();
		}
		break;
	}
}
	

$(document).ready(function(){
	//决定获取招新人数第几页
	window.recruitp=1;
	//决定edit 处于哪种状态
	window.editstate="";
	//确定是否全部显示招新报名人数
	window.recruitend=false;
	//定义全局变量 为当前页面所属部门   需要到具体引入的文件中定义
	//window.tableName="";
	//取消表单默认提交刷新的功能
	$("#addform").submit(function(e){
		e.preventDefault();
	});
	
	
	
	//为 add 按钮添加 切换 
	/*
	$("a[to=\"add\"]").click(function(){
		var to= "add";
		
		$("div[to=\"add\"]").show("fast");
		$("[cont=\"content\"]").filter(function(){
		  return this.getAttribute("to")!=to;}).hide();
		return false;
	});*/
	//上边的这段采用另一种方式呢 一种更通用的方式
	
	
	
	
	
	
	
	
	
	//对于该显示哪部分 及流程的控制
	//为所有 a 添加click 事件 
	$("a").filter(function(){
		if($(this).attr("href")!=undefined && $(this).attr("href")!="#" && $(this).attr("href").slice(0,1)=="#")
		{
			//设置下划线格式
			$(this).css("text-decoration","none");
			return 1
		}
		else
		{/*
			$(this).click(function(){
				return false;
			});*/
			return 0;
		}
	}).click(function(){
		var to=$(this).attr("href");
		var ob=$(to);
	
		//ob.show();
		console.log(ob.attr("class"));
		
		var act=$("[cont=\"content\"]").filter(function(){
			
			if(("#"+$(this).attr("id"))==to)
			{
				ob.show();
				return 0;
			}
			else
				return 1;
		});
		act.length==$("[cont=\"content\"]").length ? console.log(""):act.hide();
	});
	//设置初始 hash 并显示
	if(location.hash=="")
		history.replaceState(null,null,"#CKW");
	console.log(location.hash);
	hashrequest();
	$(location.hash).show();
	$("[cont=\"content\"]").filter(function(){
		if(("#"+$(this).attr("id"))==location.hash)
			return 0;
		else
			return 1;
	}).hide();
	//添加返回键监听
	$(window).on("hashchange",function(){
		if(location.hash!="#edit")
			window.editstate="";//确保每次状态判断的准确
		console.log(location.hash);
		hashrequest();
		$(location.hash).show();
		$("[cont=\"content\"]").filter(function(){
			
			if(("#"+$(this).attr("id"))==location.hash)
				return 0;
			else
				return 1;
		}).hide();
		
	});
	
	
	
	
	
	
	
	
	
	
	
	//判断登录
	$.get("KxJudge.php?1").done(function(data){
		console.log(data);
		if(data=="")
		{
			window.location="../user/login.html";
		}
	});
	/*处理新增成员*/
	$("#addform").on("submit",function(e){
		e.preventDefault();
		var json={};
		//确定是向哪个部门添加
		json["tableName"]=window.tableName;
		var stoppost=false;//判断是否要停止表单提交
		$("#addform input[ty=\"stId\"]").filter(function(){
			if(stoppost)
				return 0;
			if(this.value=="")
			{
				stoppost=true;
				return 0;
			}
			return 1;
		}).each(function(){
			json[$(this).attr("ty")]=this.value;
		});
		if(stoppost)
			return ;
		console.log(json);
		
		$.post("insertmembers.php",json).done(function(data){
			console.log(data);
			if(data=="200")
			{
				alert("新增成功");
				chapage();
			}
			if(data=="")
			{
				alert("无该账号");
			}
			if(data=="201")
			{
				alert("不能重复添加");
			}
		});

	});
	//设定换页函数
	//上一页
	$("#chpage button[to=\"pre\"]").click(function(){
		var chpage=$("#chpage span");
		if(chpage.attr("chpagenum")>"1")
			chpage.attr("chpagenum",(Number(chpage.attr("chpagenum"))-1));
		else
		{
			chpage.attr("chpagenum","1");
			return ;
		}
		chapage();
		});
	//下一页
	$("#chpage button[to=\"aft\"]").click(function(){
		var chpage=$("#chpage span");
		if(chpage.attr("chpagenum")>"0" && chpage.attr("chpagenum")<chpage.attr("chpageall"))
			chpage.attr("chpagenum",(Number(chpage.attr("chpagenum"))+1));
		else
			return ;
		chapage();
		});
		
	//指定页
	$("#chpage button[to=\"submit\"]").click(function(){
		var chpage=$("#chpage span");
		var chpagein=$("#chpage input");
		if(chpagein.val()>"0" && chpagein.val()<(chpage.attr("chpageall")+1))
			chpage.attr("chpagenum",chpagein.val());
		else
			return ;
		chapage();
		});
	//设置搜索 成员名称
	$("nav input[to=\"search\"]").keypress(function(){
		if(event.keyCode == 13)
		{
			console.log({name:this.value,tableName:window.tableName});
			if(location.hash="#CKW"){
			$.get("searchmembers.php",{name:this.value,tableName:window.tableName}).done(function(data){
				console.log(data);
				if(data)
				{
					$("#members tbody>tr").remove();
					try{
					var keywords=JSON.parse(data);
					}catch(e){
						console.log(e);
						return;
					}
					var i=1;
					
					for(var p in keywords)
					{
						var str="";

						str="<tr><td>"+i+"</td><td>"+undef(keywords[p]["number"])+"</td><td>"+undef(keywords[p]["name"])+"</td><td>"+undef(keywords[p]["email"])+"</td><td>"+undef(keywords[p]["phone"])+"</td><td><a href=\"#\" delete=\""+undef(keywords[p]["stId"])+"\">delete</a></td><td><a href=\"#\" sendmail=\""+undef(keywords[p]["email"])+"\">sendmail</a></td></tr>";	
						
						$("#members tbody").append(str);
						i++;
					}
					
					deleted();//删除事件绑定
					sendmail();//邮件事件 绑定
				}
				else{alert("无结果");
				}
			});
			}else{
				$.post("searchrecruitmembers.php",{name:this.value,tableName:window.tableName}).done(function(data){
					console.log(data);
					var department={};
					department["KxXqDm"]="WEB研发部";
					department["KxXqChy"]="创意设计部";
					department["KxXqTs"]="网络宣传部";
					department["KxJsJf"]="技术服务部";
					department["KxJsDj"]="大疆俱乐部";
					department["KxShwWl"]="外联部";
					department["KxShwYj"]="院校交流部";
					department["KxShwGl"]="管理部";
					department["KxHdKh"]="科技活动部";
					department["KxHdKp"]="科技培训部";
					$("#recruit1>div").remove();
					try{
						var da=JSON.parse(data);
					}catch(e){
						console.log(e);
						$("#recruit1").append('<div style="text-align:center;">出错</div>');
						return;
					}
						if(da["error"]==0)
						{
							
							for(var p in da["msg"])
							{
								var html='<div class="panel panel-default" >\
											<div class="panel-heading">\
												<h3 class="panel-title" cont="name" data-toggle="collapse" data-parent="#recruit1" data-target="#'+da["msg"][p]["stId"]+'">\
													'+da["msg"][p]["stId"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'\
												</h3>\
											</div>\
											<div id="'+da["msg"][p]["stId"]+'" class="panel-collapse collapse">\
												<div class="panel-body">\
													<div class="img-circle" style="width: 60px;height: 60px;margin:0 auto; overflow: hidden;"><img class="" src="getimg.php?stid='+da["msg"][p]["stId"]+'&department='+window.tableName+'" style="width: 60px;margin-top: -5px;"></div>\
													<div class="form-group">\
														<label >学号:</label>\
														<input type="text" class="form-control" disabled value="'+da["msg"][p]["stId"]+'" cont="stId">\
													</div>\
													<div class="form-group">\
														<label >姓名:</label>\
														<input type="text" class="form-control" disabled value="'+da["msg"][p]["name"]+'" cont="name">\
													</div>\
													<div class="form-group">\
														<label >手机:</label>\
														<input type="text" class="form-control" disabled value="'+da["msg"][p]["phone"]+'" cont="phone">\
													</div>\
													<div class="form-group">\
														<label >邮箱:</label>\
														<input type="text" class="form-control" disabled value="'+da["msg"][p]["email"]+'" cont="email">\
													</div>\
													<div class="form-group">\
														<label >简介:</label>\
														<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" cont="description">'+da["msg"][p]["description"]+'</div>\
													</div>';
									for(var z in da["msg"][p]["department"])
									{
										html+='<div class="form-group">\
													<label >部门:'+department[da["msg"][p]["department"][z]["department"]]+'<span class="label '+(da["msg"][p]["department"][z]["first"]==1? "label-success":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" intention="1" department="'+da["msg"][p]["department"][z]["department"]+'">一面意向</span><span class="label '+(da["msg"][p]["department"][z]["second"]==1? "label-success":"label-default")+'" stId="'+da["msg"][p]["stId"]+'" intention="2" department="'+da["msg"][p]["department"][z]["department"]+'">二面意向</span></label>\
													<br><label style="font-size:12px; font-weight:normal;">一面评价</label>\
													<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["firstevaluate"]==null || da["msg"][p]["department"][z]["firstevaluate"]==""? "":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="first">'+(da["msg"][p]["department"][z]["firstevaluate"]==null? "":da["msg"][p]["department"][z]["firstevaluate"])+'\
													</div>\
													<label style="font-size:12px; font-weight:normal;">二面评价</label>\
													<div class=""  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["secondevaluate"]==null || da["msg"][p]["department"][z]["secondevaluate"]==""?"":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="second">'+(da["msg"][p]["department"][z]["secondevaluate"]==null?"":da["msg"][p]["department"][z]["secondevaluate"])+'\
													</div>\
												</div>';
									}
													
									html+='</div>\
												</div>\
											</div>';
								$("#recruit1").append(html);
							}
							$("[intention=\"1\"]").click(recruitintention);//意向
							$("[intention=\"2\"]").click(recruitintention);//意向
							$("[cont=\"recruitdepartment\"]").click(recruitevaluate);//评价函数
							if(da["msg"].length==0)
								$("#recruit1").append('<div style="text-align:center;">无结果</div>');
						}
					
				});
		}
	});
	//设置发送邮件后返回键
	$("div[to=\"edit\"] button[to=\"CKW\"]").click(function(){
		window.all=0;
		/* 未使用改变hash 时用 使用了hash 直接history.back(); 
		var to = "CKW";
		$("div[to=\""+to+"\"]").show('fast');
		$("div[cont=\"content\"]").filter(function(){
		return this.getAttribute("to")!=to;}).hide();
		*/
		history.back();
		});
	//设置添加成员后返回键
	$("#addform button[to=\"CKW\"]").click(function(){
		/*未使用改变hash 时用 使用了hash 直接history.back(); 
		var to = "CKW";
		$("div[to=\""+to+"\"]").show('fast');
		$("div[cont=\"content\"]").filter(function(){
		return this.getAttribute("to")!=to;}).hide();
		chapage();
		return false;*/
		history.back();
		});
		
	
	
	//添加群发邮件 sendall 按钮功能
	/* 未采用改变hash 时
	$("#sendall button").click(function(){
		$("div[to=\"edit\"]").show();
		$("div[cont=\"content\"]").filter(function(){
			return $(this).attr("to")!="edit";
		}).hide();
		window.all=1;
	});
	*/
	$("#sendall button").click(function(){
		window.all=1;//用来控制是否是群发，可以去掉这个愚蠢的标志改成全选啥的 
		window.email="";
		window.editstate="sendmail";
	});
	
	//邮件提交按钮click事件
	$("div[to=\"edit\"] button[to=\"submit\"]").click(function(){
		var json={};
		var stoppost=false;
		console.log(window.editstate);
		if(window.editstate=="sendmail")
		{
			json["tableName"]=window.tableName;
			console.log(window.all);
			console.log(window.all==1);
			if(window.all==1)
			{
				json["all"]=1;
				
			}
			else{
				json["email"]=window.email;
				console.log(window.email);
				if(window.email=="" || window.email==undefined)
				{	
					alert("目标用户未绑定邮箱");
					stoppost=true;
				}
			}
			
			$("#editor").filter(function(){
				if($(this).html()=="")
				{
					return 0;
					stoppost=true;
				}
				json["content"]=$(this).html();
			});
			console.log(json);
			if(stoppost)
				return ;
			$.post("sendmailmembers.php",json).done(function(data){
				console.log(data);
				if(data=="200")
					alert("邮件发送成功");
				else if(data=="404")
					alert("您未绑定邮箱");
				else if(data=="401")
					alert("发送邮件失败");
				else
				{
					try{
						var da=JSON.parse(data);
					}catch(e)
					{
						console.log(e);
						return;
					}
						alert("成功:"+da["success"]+",失败:"+da["fail"]);
				}
				window.email="";//发送一次后就清除发送人
				history.back();
				window.all=0;
			});
		}
	});
	
	//rootinput 表单提交函数
	$("#rootinput").find("form").submit(function(e){
		e.preventDefault();
		switch($(this).attr("action"))
		{
			case "insertevaluate.php":
			{
				var json={};
				json["stId"]=$(this).attr("stId");
				json["department"]=$(this).attr("department");
				json["evaluate"]=$(this).find("textarea").val();
				json["time"]=$(this).attr("time");
				if(json["evaluate"]=="")
				{
					$(this).find("textarea").focus();
					return;
				}
				window.recruitjson=json;
				$.post($(this).attr("action"),json).done(function(data){
					console.log(data);
					try{
						var da=JSON.parse(data);
					}catch(e){
						console.log(e);
						return;
					}
					if(da["error"]==0)
					{
						$("#recruit1").find("[cont=\"recruitdepartment\"][stId=\""+window.recruitjson["stId"]+"\"][time=\""+window.recruitjson["time"]+"\"][department=\""+window.recruitjson["department"]+"\"]").text(window.recruitjson["evaluate"]);
					}
					$("#rootinput").find("textarea").val("");
					$("#background").trigger("click");
				});
				
			}
			break;
			case "insertfixsolution.php":
			{
				var json={};
				json["stId"]=$(this).attr("stId");
				json["date"]=window.fixcomputerdate;
				json["date1"]=window.fixcomputerdate1;
				json["solution"]=$(this).find("textarea").val();
				window.fixSRjson=json;
				console.log(window.fixSRjson);
				if(json["solution"]=="")
				{
					$(this).find("textarea").focus();
					return;
				}
				$.post($(this).attr("action"),json).done(function(data){
					console.log(data);
					try{
						var da=JSON.parse(data);
					}catch(e){
						console.log(e);
						return;
					}
					if(da["error"]==0)
					{
						window.fixSR.text(window.fixSRjson["solution"]);
					}
				});
			}
			break;
			case "insertfixresponse.php":
			{
				var json={};
				json["stId"]=$(this).attr("stId");
				json["date"]=window.fixcomputerdate;
				json["date1"]=window.fixcomputerdate1;
				json["response"]=$(this).find("textarea").val();
				window.fixSRjson=json;
				console.log(window.fixSRjson);
				if(json["response"]=="")
				{
					$(this).find("textarea").focus();
					return;
				}
				$.post($(this).attr("action"),json).done(function(data){
					console.log(data);
					try{
						var da=JSON.parse(data);
					}catch(e){
						console.log(e);
						return;
					}
					if(da["error"]==0)
					{
						window.fixSR.text(window.fixSRjson["response"]);
					}
				});
			}
			break;
			
		}
	});
	//设置background 的高度
	$("#background").css("height",window.innerHeight+"px");
	//设置recruit 的高度
	$("#recruit").css("height",window.innerHeight+"px");
	//设置recruit 的 scroll 监听
	$("#recruit").on("scroll",nextrecruit);
	//设置background 点击后 隐藏输入
	$("#background").click(function(){
		$("#background").hide();
		$("#rootinput").hide();
	});
	// 循环使内容显示 超过 #recruit 的clientHeight
	while(($("#recruit").scrollTop()+$("#recruit")[0].clientHeight)<$("#recruit>div")[0].clientHeight && !window.recruitend)
	{
		getrecruit();
	}
}); 
