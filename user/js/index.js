$(document).ready(function(){
	//获取用户信息 ，如获取出现问题则跳到登录界面 
	window.inf={};
	
	
		
		//获取可预约时间
		checkfixtime();
		//评价
		fixcomment();
		//检测是否已经参加招新报名，以及报名了哪些部门
		getrecruit();
		//获取通知
		//getnotice();
		//获取未读通知数
		getnoreadnoticenum();
	
	
	//调整 background 高度
	$("#background").css("height",window.innerHeight+"px");
	
	//设置所有a 无下划线
	$("a").css("text-decoration","none");
	
	//随机显示图片
	window.mao=[];
	for(var i=0;i<11;i++)
	{
		var j=i%6;
		switch(j){
			case 0:{
				window.mao[i]="mao.jpg";
			}
			break;
			case 1:{
				window.mao[i]="title.jpg";
			}
			break;
			case 2:{
				window.mao[i]="gouye.jpg";
			}
			break;
			case 3:{
				window.mao[i]="gouye1.jpg";
			}
			break;
			case 4:{
				window.mao[i]="gouye2.jpg";
			}
			break;
			case 5:{
				window.mao[i]="gouye3.jpg";
			}
			break;
		}
	}
	window.a=Math.floor((Math.random()*10));
	
	window.imgurl="http://nuaakx.com/ftp/img/"+window.mao[a];
	$("#headback").css("background-image","url(\""+window.imgurl+"\")");
	//设置背景图像处的高度
	(function(){
		var img=new Image();
		//img.src="../manager/image/title.jpg";
		img.src=window.imgurl;
		img.onload=function(){
			
			console.log(img.height/img.width);
			var rate=((img.height/img.width)> 3/5)? 3/5:(img.height/img.width) ;
			//var rate=img.height/img.width;
			if(window.innerWidth<500)
			{
				$("div[cont=\"head\"]").css("height",window.innerWidth*rate);
				window.headheight=window.innerWidth*rate;
			}
			else
			{
				$("div[cont=\"head\"]").css("height",500*rate);
				window.headheight=500*rate;
			}
			userinfget();//获取个人信息 确保整个页面加载后获取
		}
	})();
	//设置间距
	(function(){
		$("#accordion>.panel").css("margin-bottom","1px").css("border","0px").css("border-radius","0px");
		$("#Kx>.panel").css("margin-bottom","1px").css("border","0px").css("border-radius","0px");
		$(".panel").css("margin-bottom","1px").css("border","0px").css("border-radius","0px");
		$(".panel-title").css("font-size","14px");
		//实现点击后 小箭头 转向
		/*
		$("a.panel-title").click(function(){
			console.log("a");
			$(this).find("span").each(function(){
				if($(this).attr("changed")=="true")
				{
					$(this).attr("changed","false");
					$(this).removeClass("glyphicon-chevron-down");
					$(this).addClass("glyphicon-chevron-right");
				}
				else if($(this).attr("changed")=="false"){
					$(this).attr("changed","true");
					$(this).removeClass("glyphicon-chevron-right");
					$(this).addClass("glyphicon-chevron-down");
				}
			});
		});*/
		
	})();
	/*
	window.pre=["#accordion"];//设置每个界面的 #id 方便退回切换
	//为所有 a 添加click 事件 
	$("a").filter(function(){
		var ob=$($(this).attr("href"));
		
		if(ob.selector!="#")
		{
			return 1
		}
		else
		{
			$(this).click(function(){
				return false;
			});
			return 0;
		}
	}).click(function(){
		var ob=$($(this).attr("href"));
		ob.show();
		console.log(ob.attr("class"));
		window.pre[window.pre.length]=$(this).attr("href");
		console.log(window.pre);
		$("[cont=\"content\"]").filter(function(){
			console.log($(this).attr("id"));
			if(("#"+$(this).attr("id"))==window.pre[window.pre.length-1])
				return 0;
			else
				return 1;
		}).hide();
		return false;
	});
	//为 id="back" 添加功能
	$("#back").click(function(){
		if(window.pre.length>1)
		{
			$(window.pre[window.pre.length-2]).show();
			window.pre.splice(window.pre.length-1,1);
			console.log(window.pre);
			$("[cont=\"content\"]").filter(function(){
				console.log($(this).attr("id"));
				if(("#"+$(this).attr("id"))==window.pre[window.pre.length-1])
					return 0;
				else
					return 1;
			}).hide();
			
		}
		return false;
	});
	*/
	//为所有 a 添加click 事件 
	$("a").filter(function(){
		if($(this).attr("href")!="#" && $(this).attr("href").slice(0,1)=="#")
		{
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
		ob.show();
		console.log(ob.attr("class"));
		
		$("[cont=\"content\"]").filter(function(){
			
			if(("#"+$(this).attr("id"))==to)
				return 0;
			else
				return 1;
		}).hide();
	});
	//设置初始 hash 并显示
	if(location.hash=="")
		history.replaceState(null,null,"#accordion");
	$(location.hash).show();

	hashfunc();
	$("[cont=\"content\"]").filter(function(){
		if(("#"+$(this).attr("id"))==location.hash)
			return 0;
		else
			return 1;
	}).hide();
	
	//为 id="back" 添加功能
	$("#back").click(function(){
		history.back();
		console.log(location.hash);
		$("[cont=\"content\"]").filter(function(){
			
			if(("#"+$(this).attr("id"))==location.hash)
				return 0;
			else
				return 1;
		}).hide();
		$(location.hash).show();
		return false;
	});
	//添加返回键监听
	$(window).on("hashchange",function(){
		console.log(location.hash);
		$(location.hash).show();
		hashfunc();
		$("[cont=\"content\"]").filter(function(){
			
			if(("#"+$(this).attr("id"))==location.hash)
				return 0;
			else
				return 1;
		}).hide();
		
	});
	
	//获取用户参与活动
	//设置修改信息功能
	$("#changeperinf").find("form").submit(function(e){
		e.preventDefault();
		var json={};
		var ob=$(this).find("input");
		if(ob.val()!=window.inf[ob.attr("cont")])
			json[ob.attr("cont")]=ob.val();
		else 
		{
			ob.focus();
			return ;
		}
		window.changecontname=ob.attr("cont");
		window.changejson=json;
		console.log(json);
		
		
		$.post("changeperinf.php",json).done(function(data){
			var p=window.changecontname;
			var json=window.changejson;
			window.changecontname=undefined;
			window.changejson=undefined;
			console.log(data);
			try{
				var da=JSON.parse(data);
			}
			catch(e)
			{
				console.log(e);
				return;
			}
			if(da["error"]==0)
			{
				userinfget();
				$("span[cont=\""+p+"\"]").text(json[p]);
				$("input[cont=\""+p+"\"]").val(json[p]);
			}
		});
		
	});
	//预约维修提交
	$("#fixcomputer").find("input[name=\"problem\"]").on("change",function(){
		if($(this).val()=="3")
			$("#other").slideDown();
		else
			$("#other").slideUp();
	});
	
	//维修预约表单提交
	$("#fixcomputer").find("form").submit(function(e){
		e.preventDefault();
		var json={};
		json["problem"]=$(this).find("[name=\"problem\"]").filter(function(){
			if($(this).prop("checked"))
				return 1;
			else
				return 0;
		}).val();
		json["time"]=$(this).find("[name=\"time\"]").val();
		if(json["time"]==undefined)
			alert("请选择一个时间");
		if(json["problem"]=="3")
		{
			var problem=$(this).find("textarea");
			if(problem.val()=="")
			{
				problem.focus();
				return;
			}
			else
			{
				json["problem"]=problem.val();
			}
		}
		$.post("recordfix.php",json).done(function(data){
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
				alert("预约成功");
				getfix();
			}
		});
	});
	
	//获取待评价预约维修信息
	$("#fixcheck").find("a[href=\"#fixcheckcomment\"]").click(function(){
		$.post("fixcheckcomment.php").done(function(data){
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
				$("#fixcheckcomment>div").remove();
				$("#fixcheckcomment").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default">\
									<div class="panel-heading">\
										<span >'+da["msg"][p]["date"]+'</span>\
									</div>\
									<div class="panel-body">\
										<p>'+da["msg"][p]["problem"]+'</p>\
									</div>\
									<div class="panel-footer"><div class="form-control" toaction="recordfixcomment.php" date="'+da["msg"][p]["date"]+'">评价<div></div>\
							</div>';
					$("#fixcheckcomment").append(html);
				}
			}
			else if(da["error"]==1)
			{
				$("#fixcheckcomment>div").remove();
				$("#fixcheckcomment").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				$("#fixcheckcomment").append('<p style="text-align:center;">无</p>');
			}
			fixcomment();//必须的
		});
	});
	//获取已评价预约维修信息
	$("#fixcheck").find("a[href=\"#hfixcheckcomment\"]").click(function(){
		$.post("hfixcheckcomment.php").done(function(data){
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
				$("#hfixcheckcomment>div").remove();
				$("#hfixcheckcomment").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default">\
									<div class="panel-heading">\
										<span >'+da["msg"][p]["date"]+'</span>\
									</div>\
									<div class="panel-body">\
										<p>'+da["msg"][p]["problem"]+'</p>\
										<span style="font-weight:bold;">解决措施:</span>\
										<p style="padding-left:10px;">'+da["msg"][p]["solution"]+'</p>\
										<span style="font-weight:bold;">评价:</span>\
										<p style="padding-left:10px;">'+da["msg"][p]["evaluate"]+'</p>\
										<span style="font-weight:bold;">回复:</span>\
										<p style="padding-left:10px;">'+da["msg"][p]["response"]+'</p>\
									</div>\
							</div>';
					$("#hfixcheckcomment").append(html);
				}
			}
			else if(da["error"]==1)
			{
				$("#hfixcheckcomment>div").remove();
				$("#hfixcheckcomment").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				$("#hfixcheckcomment").append('<p style="text-align:center;">无</p>');
			}
		});
	});			
	
	
	
	//显示已提交的投诉与建议
	$("#kxtsas").click(function(){
		//$.post("                  .php").done(function(data){
			var data="{\"error\":0,\"msg\":[{\"time\":\"2017-05-07\",\"content\":\"233\",\"response\":\"233\"},{\"time\":\"2017-05-07\",\"content\":\"233\",\"response\":\"233\"}]}";
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
				$("#tsasuggestion>div").remove();
				$("#tsasuggestion").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default">\
									<div class="panel-heading">\
										<span >'+da["msg"][p]["date"]+'</span>\
									</div>\
									<div class="panel-body">\
										<p>'+da["msg"][p]["problem"]+'</p>\
										<span style="font-weight:bold;">解决措施:</span>\
										<p style="padding-left:10px;">'+da["msg"][p]["solution"]+'</p>\
										<span style="font-weight:bold;">评价:</span>\
										<p style="padding-left:10px;">'+da["msg"][p]["evaluate"]+'</p>\
										<span style="font-weight:bold;">回复:</span>\
										<p style="padding-left:10px;">'+da["msg"][p]["response"]+'</p>\
									</div>\
							</div>';
					$("#tsasuggestion").append(html);
				}
			}
			else if(da["error"]==1)
			{
				$("#tsasuggestion>div").remove();
				$("#tsasuggestion").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				$("#tsasuggestion").append('<p style="text-align:center;">无</p>');
			}
	//	});
	});			
	
	
	
	//设置评价提交
	$("#rootinput").find("form").submit(function(e){
		e.preventDefault();
		var json={};
		json["date"]=$(this).attr("date");
		json["evaluate"]=$(this).find("textarea").val();
		if(json["evaluate"]=="")
		{
			$(this).find("textarea").focus();
			return;
		}
		window.fixcommentjson=json;
		console.log(window.fixcommentjson);
		$.post("recordfixcomment.php",json).done(function(data){
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
				$("#rootinput").find("textarea").val("");
				$("#rootinput").hide();
				
				$("#background").hide();
				var comment=$("#fixcheckcomment").find("div.form-control[date="+window.fixcommentjson["date"]+"]");
				var commentparent=comment.parent();
				console.log(comment);
				
				comment.remove();
				
				commentparent.append('<p>评价:'+window.fixcommentjson["evaluate"]+'</p>');
			}
		});
	});
	
	//设置点击背景时 评论表单隐藏  
	$("#background").click(function(){
		//$("#rootinput").find("textarea").val("");
		$("#rootinput").hide();
		$("#background").hide();
	});
	//设置活动投票表单提交
	
	$("#actvote").find("form").submit(function(e){
		e.preventDefault();
		var json={}
		json["vote"]=[];
		var vote=$(this).find("input[name=\"vote\"]").filter(function(){
			if($(this).prop("checked"))
				return 1;
			else
				return 0;
		});
		if(vote.length<4&&vote.length!=0)
		{
			vote.each(function(){
				json["vote"][json["vote"].length]=$(this).val();
			});
			if(confirm("是否确认提交投票"))
		{
			console.log(json);
			$.post("vote.php",json).done(function(data){
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
				getvote();
				userinfget();
			}
		});
			alert("投票成功！");
			getvote();
		}
		}
		else if(vote.length==0){
			alert("请选择");
			return;
		}else
		{
			alert("最多选三个选项");
			return;
		}
		window.recruitjson=json;
		window.recruitform=$("#actvote").find("form");
		
		
			
	});
	
	//设置报名表单提交
	$("#recruit").find("form").submit(function(e){
		e.preventDefault();
		var json={}
		json["department"]=[];
		
		var phone=$(this).find("#p");
		if(phone.val()==""){
			
			phone.focus();
			return;
		}
		else
			json["phone"]=phone.val();
		var email=$(this).find("#e");
		if(email.val()==""){
			
			email.focus();
			return;
		}
		else
			json["email"]=email.val();
		var department=$(this).find("input[name=\"department\"]").filter(function(){
			if($(this).prop("checked"))
				return 1;
			else
				return 0;
		});
		if(department.length<4)
		{
			department.each(function(){
				json["department"][json["department"].length]=$(this).val();
			});
		}
		else if(department.length==0){
			alert("请选择部门");
			return;
		}else
		{
			alert("最多选三个部门");
			return;
		}
		var description=$(this).find("textarea");
		if(description.val()==""){
			
			description.focus();
			return;
		}
		else
			json["description"]=description.val();
		window.recruitjson=json;
		window.recruitform=$("#recruit").find("form");
		//判断个人信息是否完整
		/*if(window.inf["phone"]==null || window.inf["phone"]=="" || window.inf["email"]==null || window.inf["email"]=="")
		{
			alert("请先完善个人信息");
			location.hash="#personalinf";
			return;
		}*/
		if(json["phone"]==window.inf["phone"]&&json["email"]==window.inf["email"])
		{
			if(confirm("提交后不可修改，请确认是否提交"))
		{
			console.log(json);
			$.post("recordrecruit.php",json).done(function(data){
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
				getrecruit();
				userinfget();
			}
		});
			alert("恭喜你报名成功！");
		}
		}
		else{if(confirm("提交后不可修改，请确认是否提交"))
		{
			console.log(json);
			$.post("recordrecruit.php",json).done(function(data){
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
				getrecruit();
				userinfget();
			}
		});
			alert("恭喜你报名成功！");
		}
		}
		
			
	});
	//退出登录
	$("#logout").click(function(){
		if(confirm("如果已绑定微信号，则退出登录后仍会根据微信号重新登录,如想换号登录，请解绑后退出")){
			
			$.get("logout.php").done(function(data){
				
				location.replace("./");
			});
			window.close();
		}
	});
	
					
});

//获取投票后界面
function getvote(){

	$.get("getvote.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			console.log(e);
			return;
		}
		if( da["error"]==0 && da["alreadyvote"]==1)
		{
			window.fixform=$("#actvote").find("form");
			$("#actvote").find("form").remove();
			
			var html='<div class="row">\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu8.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>1.wota艺–梦灯笼</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["1"]+'</span> </p>\
				</div>\
				</div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu2.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>2.新生看点播报</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["2"]+'</span> </p>\
				</div>\
				</div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu3.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>3.Mad again</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["3"]+'</span> </p>\
				</div>\
				</div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu4.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>4.博物馆奇妙夜</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["4"]+'</span> </p>\
				</div>\
				</div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu5.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>5.像我这样的人</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["5"]+'</span> </p>\
				</div>\
				</div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu6.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>6.极乐山鬼</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["6"]+'</span> </p>\
				</div>\
				</div>\
				<div class="clearfix visible-xs-block"></div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu7.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>7.武林内传</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["7"]+'</span> </p>\
				</div>\
				</div>\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu1.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>8.荧光舞</h3>\
				 <div class="btn btn-default" role="button" style="padding-bottom:0px;">\
				 <p>已有票数<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">'+da["8"]+'</span> </p>\
				</div>\
				</div>\
			</div>';
							
				
		
				$("#actvote").append(html);
			
				
		}
	});
}

function getfix(){
	//获取是否有维修预约的
	$.get("getfix.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			console.log(e);
			return;
		}
		if(da["error"]==0 && da["alreadyappoint"]==1)
		{
			window.fixform=$("#fixcomputer").find("form");
			$("#fixcomputer").find("form").remove();
			var html='<div class="panel panel-default">\
									<div class="panel-heading">\
										<span >'+da["msg"]["date"]+'</span>\
									</div>\
									<div class="panel-body">\
										<p>'+da["msg"]["problem"]+'</p>\
									</div>';
							
				html+='<div class="panel-footer" date="'+da["msg"]["date"]+'" cont="fixcancel">取消预约</div></div>';
			$("#fixcomputer").append(html);
			console.log("haha");
			$("#fixcomputer").find("div[cont=\"fixcancel\"]").click(function(){
				var json={};
				window.cancelthat=this;
				json["date"]=$(this).attr("date");
				$.post("fixcancel.php",json).done(function(data){
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
						alert("成功取消");
						$(window.cancelthat).parent().remove();
						$("#fixcomputer").append(window.fixform);
					}
				});
			});
		}
	});
}

function getrecruit(){
	$.post("getrecruit.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			console.log(e);
			return;
		}
		var department={};
		department["KxXqDm"]="WEB研发部";
		department["KxXqChy"]="创意设计部";
		department["KxXqTs"]="网络宣传部";
		department["KxShwWl"]="外联部";
		department["KxShwGl"]="管理部";
		department["KxShwYj"]="院校交流部";
		department["KxJsJf"]="技术服务部";
		department["KxJsDj"]="大疆俱乐部";
		department["KxHdKh"]="科创活动部";
		department["KxHdKp"]="科技培训部";
		
		if(da["error"]==0)
		{
			for(var p in da["department"])
			{
				var html='<div class="panel panel-default">\
									<div class="panel-heading">\
										<span >'+department[da["department"][p]["department"]]+'</span>\
									</div>\
									<div class="panel-body">\
										<p>个人描述:<br>'+da["description"]+'</p>\
									</div>';
					html+='<div class="panel-footer" ><span class="label '+(da["department"][p]["first"]==1? "label-success":"label-default")+'">一面</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="label '+(da["department"][p]["second"]==1? "label-success":"label-default")+'">二面</span></div></div>';
					
				$("#recruit").find("form").remove();
				$("#recruit").append(html);
			}
		}
	});
}
function getnotice(){
	$.post("getnotice.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e)
		{
			console.log(e);
			return;
		}
		if(da["error"]==0)
		{
			window.sortarr=da["notice"];
			keywordsSort(0,da["notice"].length-1,"date");
			da["notice"]=window.sortarr;
			console.log(window.sortarr);
			for(var p in da["notice"])
			{
				var html='<a href="'+(da["notice"][p]["url"]==null? "javascript:void(0);":da["notice"][p]["url"])+'" style="text-decoration:none;" ><div class="panel panel-default">\
									<div class="panel-heading">\
										<span >通知:'+da["notice"][p]["title"]+'</span>\
									</div>\
									<div class="panel-body">\
										<p>'+da["notice"][p]["description"]+'</p>\
                                        <button class="btn btn-default" style="width:100%;" noticeid="'+da["notice"][p]["noticeid"]+'" alreadyread="'+da["notice"][p]["already"]+'" cont="noticereadmark">'+(da["notice"][p]["already"]==1?"已读":"标记已读")+'</button>\
									</div></div></a>';
				$("#notice").append(html);
			}
            $("[cont=\"noticereadmark\"]").click(marknoticeread);
		}
	});
}
function fixcomment(){
	$("#fixcheckcomment").find("div.form-control[toaction=\"recordfixcomment.php\"]").click(recordfixcomment);
	console.log($("#fixcheckcomment").find("input[toaction=\"recordfixcomment.php\"]"));
}
function recordfixcomment(){
	$("#background").show();
	$("#rootinput").show();
	$("#rootinput").find("form").attr("action",$(this).attr("toaction"));
	$("#rootinput").find("form").attr("date",$(this).attr("date"));
	$("#rootinput").find("form").find("textarea").focus();
}
//js 快速排序算法
//window.sortarr 待排序数组 必须全局变量
//$i   起始位置
//$j   终止位置
//$acc 排序依据字段
function keywordsSort(i,j,ac)
{
	var acc=ac?ac:"";
	if(i<j)
	{
		
		if(acc!="")
		{
			var a=i;
			var b=j;
			var x=window.sortarr[i];
			while(a<b)
			{
				while(a<b && !(x[acc]<window.sortarr[b][acc]))
					b--;//从右至左找比 参考量大的
				if(a<b)
					window.sortarr[a]=window.sortarr[b];
				while(a<b && !(x[acc]>window.sortarr[a][acc]))
					a++;//从左至右找比参考量小的
				if(a<b)
					window.sortarr[b]=window.sortarr[a];
			}
			window.sortarr[a]=x;

			keywordsSort(i,a-1,acc);
			keywordsSort(a+1,j,acc);
		}
	}
	return; 
}
// 根据hash 发送请求
function hashfunc(){
	switch(location.hash)
	{
		case "#kxhd":
		{
		  //获取活动列表
          getallhd();
		}
		break;
        case "#notice":
        {
            //获取通知
            getnotice();
        }
	}
}
//获取所有活动列表
function getallhd(){
	$.post("getallhd.php").done(function(data){
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
			var date=new Date();
			var time=date.getFullYear()+"-"+(Number(date.getMonth())<10? "0"+date.getMonth():date.getMonth())+"-"+(Number(date.getDate())<10? "0"+date.getDate():date.getDate())+"-"+(Number(date.getHours())<10? "0"+date.getHours():date.getHours());
			window.hdsigntime=time;
			for(var p in da["msg"]){
				var html='<div class="panel panel-default" >\
									<div class="panel-heading">\
								<h3 class="panel-title" role="button" cont="name" data-toggle="collapse" data-parent="#kxhd1" data-target="#'+da["msg"][p]["hdid"]+'">\
								'+da["msg"][p]["name"]+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span cont="hdnownum" hdid="'+da["msg"][p]["hdid"]+'">'+da["msg"][p]["nownum"]+'</span>\/'+da["msg"][p]["max"]+'\
								</h3>\
							</div>\
							<div id="'+da["msg"][p]["hdid"]+'" class="panel-collapse collapse">\
								<div class="panel-body">\
									<div>'+da["msg"][p]["content"]+'<br><a href="'+da["msg"][p]["url"]+'">原文</a>\
									</div>\
									<button class="form-control" hdid="'+da["msg"][p]["hdid"]+'" hdsign="'+da["msg"][p]["hdsignend"]+'" hdalreadysign="'+da["msg"][p]["hdalready"]+'" cont="hdsign" >'+(da["msg"][p]["hdalready"]?"已报名":(da["msg"][p]["hdsignend"]==null?"无需报名":(da["msg"][p]["hdsignend"]>time?"点击报名":"报名结束")))+'</button>\
								</div>\
							</div>\
						</div>';
				$("#kxhd1").append(html);
			}
			$("[cont=\"hdsign\"]").click(hdsignclick);
		}
	});
}
//活动点击报名函数
function hdsignclick(){
    console.log($(this).attr("hdsign")>window.hdsigntime);
    console.log($(this).attr("hdsign")!=null );
    console.log($(this).attr("hdalreadysign"));
    console.log(window.hdsigntime);
	if($(this).attr("hdsign")!=null && $(this).attr("hdsign")>window.hdsigntime && $(this).attr("hdalreadysign")=="false"){
		var json={};
		json["hdid"]=$(this).attr("hdid");
		window.signhdjson=json; 
		$.post("addhdsign.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
				
			}catch(e){
				console.log(e);
				return;
			}
			if(da["error"]==0){
				$("[cont=\"hdsign\"][hdid=\""+window.signhdjson["hdid"]+"\"]").text("已报名");
				var hdnownum=$("[cont=\"hdnownum\"][hdid=\""+window.signhdjson["hdid"]+"\"]");
				hdnownum.text(Number(hdnownum.text())+1);
			}
            else{
                alert("出错，请微信联系后台管理员");
            }
		})
	}
}
//获取未读消息数
function getnoreadnoticenum(){
    $.post("getnoreadnoticenum.php").done(function(data){
        console.log(data);
        try{
            var da=JSON.parse(data);
            
        }catch(e){
            console.log(e);
            return;
        }
        if(da["error"]==0){
            $("#noreadnotice").removeClass("glyphicon");
            $("#noreadnotice").removeClass("glyphicon-chevron-right");
            $("#noreadnotice").addClass("badge").text(da["later"]);
        }
    })
}
//标记消息为已读
function marknoticeread(){
    window.marknoticebutton=$(this);
    if($(this).attr("alreadyread")=="0" && $(this).attr("noticeid")!=undefined && $(this).attr("noticeid")!=""){
        var json={};
        json["noticeid"]=$(this).attr("noticeid");
        $.post("marknoticeread.php",json).done(function(data){
            console.log(data);
            try{
                var da=JSON.parse(data);
            }catch(e){
                console.log(e);
                return;
            }
            if(da["error"]==0)
            {
                window.marknoticebutton.attr("alreadyread","1");
                window.marknoticebutton.text("已读");
                if(Number($("#noreadnotice").text())>0)
                    $("#noreadnotice").text(Number($("#noreadnotice").text())-1);
            }
        });
    }
}
function userinfget(){
	//获取用户个人信息
	$.get("userinf.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			var a=[];
			a["login"]=1;
			a["bound"]=1;
			setTimeout(function(){document.location.href="../user/"+(a[data]==1?data:"login")+".html"},1000);
			setTimeout(function(){location.reload();},3000);//解决uc浏览器登陆后返回历史记录的问题页面不刷新的问题
			return ;
		}
		
		if(da["error"]==0)
		{
			kxjudge();
			window.inf=da["inf"];
			for(var p in da["inf"])
			{
				
				if(da["inf"][p])
				{
					$("span[cont=\""+p+"\"]").text(da["inf"][p]);
					$("input[cont=\""+p+"\"]").val(da["inf"][p]);
				}
			}
			if(da["inf"]["sex"]!=null)
				da["inf"]["sex"]==1 ?$("span[cont=\"sex\"]").text("男"):$("span[cont=\"sex\"]").text("女");
			if(da["inf"]["openid"]==da["inf"]["seopenid"]){
				$("span[cont=\"bound\"]").text("已绑定当前微信号,点击解绑");
				//解绑微信号
				$("span[cont=\"bound\"]").parent().parent().click(unlink);
			}else{
				$("span[cont=\"bound\"]").text("绑定微信号非当前微信号");
				//绑定当前微信号
				$("span[cont=\"bound\"]").parent().parent().click(bound);
			}
			//关于头像的处理
			var img=new Image();
			img.src="getimg.php";
			img.onerror=function(){
				$("#headimgurl").attr("src",window.inf["headimgurl"]);
			}
			
			
			
			$("#head a").attr("href","#");
			
		}
		
	});
}
function kxjudge(){
	//判断是否是科协的
	$.get("../manager/KxJudge.php?1").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
			return;
		}
		
		if(data=="")
		{
			//document.location.href="login.html";
		}
		else if(da["inf"]["tableName"].length>0)
		{
			$("#Kx").show();
		}
	});
}
function checkfixtime(){
	//查看设置的可维修时间
	$.post("checkfixtime.php").done(function(data){
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
			window.fixconf=da["conf"];
			var timeallowed={};//用来记录可预约的时间
			var time;
			var d=new Date();
			var weekdays=[];
			weekdays[0]="周日";
			weekdays[1]="周一";
			weekdays[2]="周二";
			weekdays[3]="周三";
			weekdays[4]="周四";
			weekdays[5]="周五";
			weekdays[6]="周六";
			
			var day=d.getDay();
			var hours=d.getHours();
			var t=false;//今天是否可以预约
			var i=-1;
			//找到今天是否符合预约条件
			console.log(day);
			
			for(var p in da["msg"])
			{
				if(day>da["msg"][p]["week"])
				{
					i=p;
				}
				if(day==da["msg"][p]["week"])
				{
					t=true;
					i=p;
					break;
				}
				if(day<da["msg"][p]["week"])
				{
					break;
				}
			}
			console.log(i);
			i=Number(i);
			//如果今天符合预约条件，按照可预约几天的设置，找到最近的符合预约条件的几天
			if(t)
			{
				console.log(hours);
				var next=false;//判断是不是下周；
				var dday;
				if(hours<"19")
				{
					time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
					var html='<div class="radio">\
								<label>\
								<input type="radio" name="time" checked week="'+(next?"下":"")+weekdays[da["msg"][i]["week"]]+'晚7:00-9:00'+' "value="'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'">'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'晚7:00-9:00\
								</label>\
							</div>'
					$("#fixtime").append(html);
				}
				else
				{
					next=false;		
					console.log(i+1);
					console.log(da["msg"].length);
					
					if((i+1)<da["msg"].length)
					{
						i++;
						dday=Number(da["msg"][i]["week"])-Number(da["msg"][i-1]["week"]);
						d.setTime(d.getTime()+86400000*dday);
						console.log(d.getTime());
						console.log(d.getDate());
					}
					else
					{
						next=true;
						dday=Number(da["msg"][0]["week"])+7-Number(da["msg"][i]["week"]);
						d.setTime(d.getTime()+86400000*dday);
						i=0;
					}
					time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
					var html='<div class="radio">\
								<label>\
								<input type="radio" name="time" checked week="'+(next?"下":"")+weekdays[da["msg"][i]["week"]]+'晚7:00-9:00'+' "value="'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'">'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'晚7:00-9:00\
								</label>\
							</div>'
					$("#fixtime").append(html);
				}
				timeallowed[time]=1;
				for(var j=1;j<da["conf"]["days"];j++)
				{
					
					if((i+1)<da["msg"].length)
					{
						i++;
						dday=Number(da["msg"][i]["week"])-Number(da["msg"][i-1]["week"]);
						d.setTime(d.getTime()+86400000*dday);
						console.log(d.getTime());
						console.log(d.getDate());
					}
					else
					{
						next=true;
						dday=Number(da["msg"][0]["week"])+7-Number(da["msg"][i]["week"]);
						d.setTime(d.getTime()+86400000*dday);
						i=0;
					}
					time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
					timeallowed[time]=1;
					var html='<div class="radio">\
								<label>\
								<input type="radio" name="time" week="'+(next?"下":"")+weekdays[da["msg"][i]["week"]]+'晚7:00-9:00'+' "value="'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'">'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'晚7:00-9:00\
								</label>\
							</div>'
					$("#fixtime").append(html);
				}
			}
			else
			{
				next=false;//判断是不是下周；
				if((i+1)<da["msg"].length && i!=-1)
				{
					i++;
					dday=Number(da["msg"][i]["week"])-Number(day);
					d.setTime(d.getTime()+86400000*dday);
					console.log(d.getTime());
					console.log(d.getDate());
				}
				else
				{
					next=true;
					dday=Number(da["msg"][0]["week"])+7-Number(day);
					d.setTime(d.getTime()+86400000*dday);
					i=0;
				}
				time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
				timeallowed[time]=1;
				var html='<div class="radio">\
							<label>\
							<input type="radio" name="time" week="'+(next?"下":"")+weekdays[da["msg"][i]["week"]]+'晚7:00-9:00'+' "value="'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'">'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'晚7:00-9:00\
							</label>\
						</div>'
				$("#fixtime").append(html);
				for(var j=1;j<da["conf"]["days"];j++)
				{
					
					if((i+1)<da["msg"].length)
					{
						i++;
						dday=Number(da["msg"][i]["week"])-Number(da["msg"][i-1]["week"]);
						d.setTime(d.getTime()+86400000*dday);
						console.log(d.getTime());
						console.log(d.getDate());
					}
					else
					{
						next=true;
						dday=Number(da["msg"][0]["week"])+7-Number(da["msg"][i]["week"]);
						d.setTime(d.getTime()+86400000*dday);
						i=0;
					}
					time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
					timeallowed[time]=1;
					var html='<div class="radio">\
								<label>\
								<input type="radio" name="time" week="'+(next?"下":"")+weekdays[da["msg"][i]["week"]]+'晚7:00-9:00'+' "value="'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'">'+d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate())+'晚7:00-9:00\
								</label>\
							</div>'
					$("#fixtime").append(html);
				}
			}
			//验证几个日期是否都满了
			console.log(timeallowed);
			$.post("getfixfull.php",timeallowed).done(function(data){
				console.log(data);
				try{
					var da=JSON.parse(data);
				}
				catch(e){
					console.log(e);
					return;
				}
				getfix();//获取是否已经有预约
				for(var p in da)
				{
					if(!(da[p]<window.fixconf["numperday"]))
					{
						$("#fixtime").find(("input[name=\"time\"][value="+p+"]")).prop("disabled",true);
						$("#fixtime").find(("input[name=\"time\"][value="+p+"]")).prop("checked",false);
					}
				}
				//设定时间预选项
				var alreadychoised=false;
				$("#fixtime").find("input[name=\"time\"]").each(function(){
					if(alreadychoised)
						return;
					if(!$(this).prop("disabled"))
					{
						alreadychoised=true;
						$(this).prop("checked",true);
					}
				});
			});
			
		}
	});
}
function unlink(){
	if(confirm("确认解绑当前微信号？")){
		$.post("unlink.php").done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}catch(e){
				console.log(e);
				return;
			}
			if(da["error"]==0){
				$("span[cont=\"bound\"]").text("无绑定微信号,点击绑定");
				$("span[cont=\"bound\"]").parent().parent().off("click",unlink);
				$("span[cont=\"bound\"]").parent().parent().on("click",bound);
			}
		});
	}
}
function bound(){
	if(confirm("确认绑定当前微信号？")){
		$.post("bound.php").done(function(data){
			console.log(data);
			if(data=="200"){
				$("span[cont=\"bound\"]").text("已绑定当前微信号,点击解绑");
				$("span[cont=\"bound\"]").parent().parent().off("click",bound);
				$("span[cont=\"bound\"]").parent().parent().on("click",unlink);
			}
			try{
				var da=JSON.parse(data);
			}catch(e){
				console.log(e);
				

			}
		});
	}
}
