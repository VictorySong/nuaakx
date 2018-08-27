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
function getrecruit(x){
	console.log({p:window.recruitp,tableName:window.tableName});
	if(window.recruitend)
		return;
	
	$.post("getrecruit.php",{p:window.recruitp,tableName:window.tableName,item:x}).done(function(data){
		console.log(data);
		var department={};
		department["KxXqDm"]="WEB研发部";
		department["KxXqChy"]="创意设计部";
		department["KxXqTs"]="网络宣传部";
		department["KxJsJf"]="技术服务部";
		department["KxJsKy"]="科技研究部";
		department["KxShwWl"]="外联部";
		department["KxShwGl"]="管理部";
		department["KxHdKh"]="科技活动部";
		department["KxHdXj"]="学术交流部";
		
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
				
				if(da["msg"].length<1)
					window.recruitend=true;
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" role="button" cont="name" data-toggle="collapse" data-parent="#recruit1" data-target="#'+remove_at_fromstid(da["msg"][p]["stId"])+'">\
										'+da["msg"][p]["stId"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'\
									</h3>\
								</div>\
								<div id="'+remove_at_fromstid(da["msg"][p]["stId"])+'" class="panel-collapse collapse">\
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
							if(da["msg"][p]["department"][z]["department"]==window.tableName)
							{
								html+='<div class="form-group">\
										<label >部门:'+department[da["msg"][p]["department"][z]["department"]]+'<span class="label '+(da["msg"][p]["department"][z]["first"]==1? "label-primary":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" intention="1" department="'+da["msg"][p]["department"][z]["department"]+'">一面意向</span><span class="label '+(da["msg"][p]["department"][z]["second"]==1? "label-primary":"label-default")+'" stId="'+da["msg"][p]["stId"]+'" intention="2" department="'+da["msg"][p]["department"][z]["department"]+'">二面意向</span>\
										<span class="label '+(da["msg"][p]["department"][z]["department"]==window.tableName? "label-primary":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" changedp="'+(da["msg"][p]["department"][z]["department"]==window.tableName? 1:0)+'">推荐</span></label>\
										'+(da["msg"][p]["department"][z]["fromdp"]!=null?'<span class="label label-primary" style="margin-right:5px; margin-left:5px;" >'+department[da["msg"][p]["department"][z]["fromdp"]]+'推荐</span>':"")+'</label>\
										<br><label style="font-size:12px; font-weight:normal;">一面评价</label>\
										<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["firstevaluate"]==null || da["msg"][p]["department"][z]["firstevaluate"]==""? "":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="first">'+(da["msg"][p]["department"][z]["firstevaluate"]==null? "":da["msg"][p]["department"][z]["firstevaluate"])+'\
										</div>\
										<label style="font-size:12px; font-weight:normal;">二面评价</label>\
										<div class=""  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["secondevaluate"]==null || da["msg"][p]["department"][z]["secondevaluate"]==""?"":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="second">'+(da["msg"][p]["department"][z]["secondevaluate"]==null?"":da["msg"][p]["department"][z]["secondevaluate"])+'\
										</div>\
									</div>';
							}
							
						}
										
						html+='</div>\
									</div>\
								</div>';
					$("#recruit1").append(html);
				}
				$("[intention=\"1\"]").click(recruitintention);//意向
				$("[intention=\"2\"]").click(recruitintention);//意向
				$("[changedp=\"1\"]").click(changedp);//推荐部门
				$("[cont=\"recruitdepartment\"]").click(recruitevaluate);//评价函数
				if(window.recruitend && $("#nomore").length==0 )
				{
					$("#recruit1").append('<div id="nomore" style="text-align:center;">无更多</div>');
				}
				console.log(window.recruitp);
				//使显示长度要超过屏幕高度
				$("#recruit").trigger("scroll");
			}
		
	});
}
//获取投诉与建议的函数
function getkxts(){
	//$("#kxts1").append('<div id="nomore" style="text-align:center;">无更多</div>');
	//console.log({p:window.recruitp,tableName:window.tableName});
	//if(window.recruitend)
		//return;
	$.post("getkxts.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
			return;
		}
			if(da["error"]==0)
			{
				
				//if(da["msg"].length<1)
					//window.recruitend=true;
				for(var p in da["msg"])
				{
					
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" role="button" cont="name" data-toggle="collapse" data-parent="#kxts1" data-target="#'+remove_at_fromstid(da["msg"][p]["num"])+'">\
										'+da["msg"][p]["Std"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'\
									</h3>\
								</div>\
								<div id="'+remove_at_fromstid(da["msg"][p]["num"])+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >学号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["Std"]+'" cont="stId">\
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
											<label >问题与建议:</label>\
											<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" cont="question">'+da["msg"][p]["question"]+'</div>\
										</div>\
                                        <button type="submit" cont="kxtsok"  class="btn btn-default clickme" style="width:100%;">已完成请戳我</button>';
										
						html+='</div>\
									</div>\
								</div>';
					$("#kxts1").append(html);
				}
				//完成投诉
						$(".clickme").click(function(){
							p = $(this).parent().parent().attr("id");
							var json={};
							json["num"]=p;
							console.log(json);
							$.post("kxtsok.php",json).done(function(data){
							console.log(data);
							try{
									var da=JSON.parse(data);
								}
							catch(e){
									console.log(e);
									return;
									}
							if(da["error"]==0)
								{
									alert("提交成功");
									window.history.go(0);
								}
							});
						});	
						
				if(da["msg"].length==0 )
				{
					$("#kxts1").append('<div id="nomore" style="text-align:center;">无更多</div>');
				}
				//console.log(window.recruitp);
				//使显示长度要超过屏幕高度
				$("#kxts").trigger("scroll");
			}
		
				
	});
}



//意向确认函数
function recruitintention(){

	window.intentionthat=$(this);
	var json={};
	json["stId"]=$(this).attr("stId");
	json["intention"]=$(this).attr("intention");
	json["department"]=$(this).attr("department");
	if($(this).hasClass("label-primary")){
		json["result"]=1;
    }
     else{
		 json["result"]=0;
	 }	 
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
			 if(window.intentionthat.hasClass("label-primary"))
				{
				  window.intentionthat.removeClass("label-primary");
				  window.intentionthat.addClass("label-default");
				  
				  
				}
				
			 else
				{
                   window.intentionthat.removeClass("label-default");
			       window.intentionthat.addClass("label-primary");
				}
			window.intentionthat.parent().parent().parent().parent().parent().remove();
			/*$("#recruit1").children().remove();
				window.recruitp=1;
				window.recruitend=false;
				getrecruit(window.recruitnum);*/
		}
	});
	
}	
	
	//用于点名网页
function recruitintention1(){
	
	
	window.intentionthat=$(this);
	var json={};
	json["stId"]=$(this).attr("stId");
	json["intention"]=$(this).attr("intention");
	json["department"]=$(this).attr("department");
	if($(this).hasClass("label-primary")){
		json["result"]=1;
    }
     else{
		 json["result"]=0;
	 }	 
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
			 if(window.intentionthat.hasClass("label-primary"))
				{
				  window.intentionthat.removeClass("label-primary");
				  window.intentionthat.addClass("label-default");
				  
				  
				}
				
			 else
				{
                   window.intentionthat.removeClass("label-default");
			       window.intentionthat.addClass("label-primary");
				}
			//window.intentionthat.parent().parent().parent().parent().parent().remove();
			/*$("#recruit1").children().remove();
				window.recruitp=1;
				window.recruitend=false;
				getrecruit(window.recruitnum);*/
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
	console.log($(this).scrollTop());
	console.log($(this)[0].clientHeight);
	console.log($("#recruit>div")[0].clientHeight);
	if((($(this).scrollTop()+$(this)[0].clientHeight)==$("#recruit>div")[0].clientHeight || $(this)[0].clientHeight>$("#recruit>div")[0].clientHeight ) && !window.recruitend)
	{
		
		window.recruitp++;
		getrecruit(window.recruitnum);
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
		case "#kxts":
		{
			//获取投诉
			getkxts();
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
	//getkxts();
	
	//报名查看方式
	$("span[cont=\"seenum\"]").click(function(){
		$("#recruit1").children().remove();
		window.recruitp=1;
		window.recruitend=false;
		window.seenum=$(this);
		window.recruitnum=window.seenum.attr("num");
		getrecruit(window.recruitnum);
		$("span[cont=\"seenum\"]").removeClass("label-primary");
		$("span[cont=\"seenum\"]").addClass("label-default");
		if(window.seenum.hasClass("label-default"))
		{
			window.seenum.removeClass("label-default");
			window.seenum.addClass("label-primary");
		}
		else if(window.seenum.hasClass("label-primary"))
		{
			window.seenum.removeClass("label-primary");
			window.seenum.addClass("label-default");
		}
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
	$(location.hash).show();
	$("[cont=\"content\"]").filter(function(){
		if(("#"+$(this).attr("id"))==location.hash)
			return 0;
		else
			return 1;
	}).hide();	
	//用于点名网页
	if(location.search!="")
	{
			
		
            var str = location.search.substring(1);  
            var strs= new Array();     
             strs = str.split('&');  
            var id=strs[0].substring(3);  
            var bm=strs[1].substring(3);  
			$.post("searchrecruitmembers.php",{name:id,tableName:bm}).done(function(data){
					console.log(data);
					var department={};
					department["KxXqDm"]="WEB研发部";
					department["KxXqChy"]="创意设计部";
					department["KxXqTs"]="网络宣传部";
					department["KxJsJf"]="技术服务部";
					department["KxJsKy"]="科技研究部";
					department["KxShwWl"]="外联部";
					department["KxShwGl"]="管理部";
					department["KxHdKh"]="科技活动部";
					department["KxHdXj"]="学术交流部";
					$("#recruit1>div").remove();
					try{
						var da=JSON.parse(data);
					}catch(e){
						console.log(e);
						console.log(data);
						$("#recruit1").append('<div style="text-align:center;">出错</div>');
						return;
					}
						if(da["error"]==0)
						{
							
							for(var p in da["msg"])
							{
							  if(da["msg"][p]["stId"]==id)
							  {
								var html='<div class="panel panel-default" >\
											<div class="panel-heading">\
												<h3 class="panel-title" role="button" cont="name" data-toggle="collapse" data-parent="#recruit1" data-target="#'+remove_at_fromstid(da["msg"][p]["stId"])+'">\
													'+da["msg"][p]["stId"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'\
												</h3>\
											</div>\
											<div id="'+remove_at_fromstid(da["msg"][p]["stId"])+'" class="panel-collapse collapse">\
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
									  if(da["msg"][p]["department"][z]["department"]==bm)
							          {
										html+='<div class="form-group">\
												<label >部门:'+department[da["msg"][p]["department"][z]["department"]]+'<span class="label '+(da["msg"][p]["department"][z]["first"]==1? "label-primary":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" intention="1" department="'+da["msg"][p]["department"][z]["department"]+'">一面意向</span><span class="label '+(da["msg"][p]["department"][z]["second"]==1? "label-primary":"label-default")+'" stId="'+da["msg"][p]["stId"]+'" intention="2" department="'+da["msg"][p]["department"][z]["department"]+'">二面意向</span>\
												<span class="label '+(da["msg"][p]["department"][z]["department"]==window.tableName? "label-primary":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" changedp="'+(da["msg"][p]["department"][z]["department"]==window.tableName? 1:0)+'">推荐</span></label>\
												'+(da["msg"][p]["department"][z]["fromdp"]!=null?'<span class="label label-primary" style="margin-right:5px; margin-left:5px;" >'+department[da["msg"][p]["department"][z]["fromdp"]]+'推荐</span>':"")+'</label>\
												<br><label style="font-size:12px; font-weight:normal;">一面评价</label>\
												<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["firstevaluate"]==null || da["msg"][p]["department"][z]["firstevaluate"]==""? "":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="first">'+(da["msg"][p]["department"][z]["firstevaluate"]==null? "":da["msg"][p]["department"][z]["firstevaluate"])+'\
												</div>\
												<label style="font-size:12px; font-weight:normal;">二面评价</label>\
												<div class=""  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["secondevaluate"]==null || da["msg"][p]["department"][z]["secondevaluate"]==""?"":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="second">'+(da["msg"][p]["department"][z]["secondevaluate"]==null?"":da["msg"][p]["department"][z]["secondevaluate"])+'\
												</div>\
											</div>';
									  }
									}
									html+='<a class="btn btn-success" style="width:100%;" href="'+("../user/getrecruitsign.html#"+bm)+'"  role="button">返回点名页面</a>';	
									html+='</div>\
												</div>\
											</div>';
								$("#recruit1").append(html);
							  }
							}
							$("[intention=\"1\"]").click(recruitintention1);//意向
							$("[intention=\"2\"]").click(recruitintention1);//意向
							$("[changedp=\"1\"]").click(changedp);//推荐部门
							$("[cont=\"recruitdepartment\"]").click(recruitevaluate);//评价函数
							if(da["msg"].length==0 && $("#noresult").length==0)
								$("#recruit1").append('<div id="noresult" style="text-align:center;">无结果</div>');
							
						}
					
				});
			
			
	}
	
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
		else
		{
			$("body").trigger("hashchange");
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
	$("nav input[to=\"search\"]").keypress(function(e){
		console.log(e.keyCode);
		if(e.keyCode == 13)
		{
			console.log({name:this.value,tableName:window.tableName});
			if(location.hash=="#CKW"){
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
			}else if(location.hash=="#recruit"){
				$.post("searchrecruitmembers.php",{name:this.value,tableName:window.tableName}).done(function(data){
					console.log(data);
					var department={};
					department["KxXqDm"]="WEB研发部";
					department["KxXqChy"]="创意设计部";
					department["KxXqTs"]="网络宣传部";
					department["KxJsJf"]="技术服务部";
					department["KxJsKy"]="科技研究部";
					department["KxShwWl"]="外联部";
					department["KxShwGl"]="管理部";
					department["KxHdKh"]="科技活动部";
					department["KxHdXj"]="学术交流部";
					$("#recruit1>div").remove();
					try{
						var da=JSON.parse(data);
					}catch(e){
						console.log(e);
						console.log(data);
						$("#recruit1").append('<div style="text-align:center;">出错</div>');
						return;
					}
						if(da["error"]==0)
						{
							
							for(var p in da["msg"])
							{
								var html='<div class="panel panel-default" >\
											<div class="panel-heading">\
												<h3 class="panel-title" role="button" cont="name" data-toggle="collapse" data-parent="#recruit1" data-target="#'+remove_at_fromstid(da["msg"][p]["stId"])+'">\
													'+da["msg"][p]["stId"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'\
												</h3>\
											</div>\
											<div id="'+remove_at_fromstid(da["msg"][p]["stId"])+'" class="panel-collapse collapse">\
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
									  if(da["msg"][p]["department"][z]["department"]==window.tableName)
							          {
										html+='<div class="form-group">\
												<label >部门:'+department[da["msg"][p]["department"][z]["department"]]+'<span class="label '+(da["msg"][p]["department"][z]["first"]==1? "label-primary":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" intention="1" department="'+da["msg"][p]["department"][z]["department"]+'">一面意向</span><span class="label '+(da["msg"][p]["department"][z]["second"]==1? "label-primary":"label-default")+'" stId="'+da["msg"][p]["stId"]+'" intention="2" department="'+da["msg"][p]["department"][z]["department"]+'">二面意向</span>\
												<span class="label '+(da["msg"][p]["department"][z]["department"]==window.tableName? "label-primary":"label-default")+'" style="margin-right:5px; margin-left:5px;" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" changedp="'+(da["msg"][p]["department"][z]["department"]==window.tableName? 1:0)+'">推荐</span></label>\
												'+(da["msg"][p]["department"][z]["fromdp"]!=null?'<span class="label label-primary" style="margin-right:5px; margin-left:5px;" >'+department[da["msg"][p]["department"][z]["fromdp"]]+'推荐</span>':"")+'</label>\
												<br><label style="font-size:12px; font-weight:normal;">一面评价</label>\
												<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["firstevaluate"]==null || da["msg"][p]["department"][z]["firstevaluate"]==""? "":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="first">'+(da["msg"][p]["department"][z]["firstevaluate"]==null? "":da["msg"][p]["department"][z]["firstevaluate"])+'\
												</div>\
												<label style="font-size:12px; font-weight:normal;">二面评价</label>\
												<div class=""  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" '+(da["msg"][p]["department"][z]["secondevaluate"]==null || da["msg"][p]["department"][z]["secondevaluate"]==""?"":"already=\"1\"")+' cont="recruitdepartment" stId="'+da["msg"][p]["stId"]+'" department="'+da["msg"][p]["department"][z]["department"]+'" action="insertevaluate.php" time="second">'+(da["msg"][p]["department"][z]["secondevaluate"]==null?"":da["msg"][p]["department"][z]["secondevaluate"])+'\
												</div>\
											</div>';
									  }
									}
													
									html+='</div>\
												</div>\
											</div>';
								$("#recruit1").append(html);
							}
							$("[intention=\"1\"]").click(recruitintention);//意向
							$("[intention=\"2\"]").click(recruitintention);//意向
							$("[changedp=\"1\"]").click(changedp);//推荐部门
							$("[cont=\"recruitdepartment\"]").click(recruitevaluate);//评价函数
							if(da["msg"].length==0 && $("#noresult").length==0)
								$("#recruit1").append('<div id="noresult" style="text-align:center;">无结果</div>');
						}
					
				});
			}
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
	
}); 

function remove_at_fromstid(stid){
	//去掉账号中的非数字字母字符，以解决id= 当中不能存在@的问题
	var re=/[^a-zA-Z0-9]/g;
	return stid.replace(re,"");
}

function changedp(){
	var department={};
	department["KxXqDm"]="WEB研发部";
	department["KxXqChy"]="创意设计部";
	department["KxXqTs"]="网络宣传部";
	department["KxJsJf"]="技术服务部";
	department["KxJsKy"]="科技研究部";
	department["KxShwWl"]="外联部";
	department["KxShwGl"]="管理部";
	department["KxHdKh"]="科技活动部";
	department["KxHdXj"]="学术交流部";
	if($("#changedp").length==0){
		var html='<div id="changedp" style="width:100%;position: fixed;overflow: scroll;left:0px; top:0px; z-index: 1031; background-color:black;">\
			<span class="glyphicon glyphicon-remove" id="changedpde" style="float:right; right:10px;top:10px;color:white;font-size:16px;"></span>\
			<form role="form" stId="'+$(this).attr("stId")+'"  style="position: relative;margin-left:50px;margin-top:50px;background-color: white;border-radius: 10px;width: 80%; padding-bottom:10px;">\
				<div class="form-group" style="padding-left:10px;padding-top:10px;">\
					<label>请选择推荐至的部门：</label>\
					<div style="padding-left:10px;">';
		for(var p in department){
			if(p!=window.tableName){
				html+='<div class="radio">\
							<label>\
								<input type="radio" name="dp"  value="'+p+'" >'+department[p]+'\
							</label>\
						</div>';
			}
		}
						
				html+='</div>\
					</div>\
					<div align="center" >\
						<button type="submit" class="btn btn-success btn-block" style="width:95%;">提交</button>\
					</div>\
				</form>\
			</div>';
		$("body").append(html);
		$("#changedp").css("height",window.innerHeight+"px");
		$("#changedpde").click(function(){
			$("#changedp").hide();
		});
		$("#changedp").find("form").submit(function(e){
			e.preventDefault();
			var json={};
			var t=false;
			json["department"]=$(this).find("[name=\"dp\"]").filter(function(){
				if($(this).prop("checked")){
					t=true;
					return 1;
					
				}
				else{
					return 0;
				}
			}).val();
			if(!t){
			return;}
			json["stId"]=$(this).attr("stId");
			json["fromdp"]=window.tableName;
			console.log(json);
			$.post("changedp.php",json).done(function(data){
				console.log(data);
				try{
					var da=JSON.parse(data);
				}catch(e){
					console.log(e);
					alert("推荐失败");
					return;
				}
				if(da["error"]==0){
					alert("推荐成功");
				}else{
					alert("推荐失败");
				}
			});
		});
	}
	else{
		$("#changedp").show();
	}
	
}