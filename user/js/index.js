$(document).ready(function(){
   
  userinfget();//获取个人信息 确保整个页面加载后获取
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
				window.mao[i]="1.jpg";
			}
			break;
			case 2:{
				window.mao[i]="2.jpg";
			}
			break;
			case 3:{
				window.mao[i]="3.jpg";
			}
			break;
			case 4:{
				window.mao[i]="4.jpg";
			}
			break;
			case 5:{
				window.mao[i]="5.jpg";
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
			
		}
	})();
	//设置间距
	(function(){
		$("#accordion>.panel").css("margin-bottom","1px").css("border","0px").css("border-radius","0px");
		$("#Kx>.panel").css("margin-bottom","1px").css("border","0px").css("border-radius","0px");
		$(".panel").css("margin-bottom","1px").css("border","0px").css("border-radius","0px");
		$(".panel-title").css("font-size","14px");
		
	})();
	
	
	
	/*//为所有 a 添加click 事件 
	$("a").filter(function(){
		if($(this).attr("href")!="#" && $(this).attr("href").slice(0,1)=="#")
		{
			return 1
		}
		else
		{
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
	});*/
	
	
	
	
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
	
	
	
	
	
	//添加监听
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
		json["problem"]=$(this).find("[name=\"problem\"]").filter(function(){
			if($(this).prop("checked"))
				return 1;
			else
				return 0;
		}).val();
		json["place"]=$(this).find("[name=\"place\"]").filter(function(){
			if($(this).prop("checked"))
				return 1;
			else
				return 0;
		}).val();
		json["time"]=$(this).find("[name=\"time\"]").filter(function(){
			if($(this).prop("checked"))
				return 1;
			else
				return 0;
		}).val();
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
				userinfget();
				getfix();
				
			}
		});
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
		$("#rootinput").find("textarea").val("");
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
			//getvote();
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
	
	//设置投诉与建议表单提交
	$("#kxts").find("form").submit(function(e){
		e.preventDefault();
		var json={}
		
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

		var description=$(this).find("textarea");
		if(description.val()==""){
			
			description.focus();
			return;
		}
		else
			json["description"]=description.val();
		window.recruitjson=json;
		window.recruitform=$("#kxts").find("form");
		
		if(json["phone"]==window.inf["phone"]&&json["email"]==window.inf["email"])
		{
			if(confirm("提交后不可修改，请确认是否提交"))
		{
			console.log(json);
			$.post("kxts.php",json).done(function(data){
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
				//getrecruit();
				location.reload();
			
			}
		});
			alert("我们已收到您的投诉和建议！");
			
			location.reload();
		}
		}
		else{if(confirm("提交后不可修改，请确认是否提交"))
		{
			console.log(json);
			$.post("kxts.php",json).done(function(data){
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
				userinfget();
			}
		});
			alert("我们已收到您的投诉和建议！s");
			
			location.reload();
		}
		}
		
			
	});
	//退出登录
	$("#logout").click(function(){
		if(confirm("如果已绑定微信号，则退出登录后仍会根据微信号重新登录,如想换号登录，请解绑后退出")){
			
			$.get("logout.php").done(function(data){
				
				location.replace("./");
			});
			//清除缓存
			window.close();
		}
	});
	
					
});




//***************************************************************************************************

   //获取待评价预约维修信息
	function gethfixcheckcomment(){
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
				$("#fixcheckcomment").empty();
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
				
				$("#fixcheckcomment").empty();
				$("#fixcheckcomment").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				$("#fixcheckcomment").append('<p style="text-align:center;">无</p>');
			}
			fixcomment();//必须的
		});
	}
	
	
	
	
	//获取已评价预约维修信息
	function gethfixcheckcomment(){
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
				$("#fixcheckcomment").empty();
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
				
				//$("#fixcheckcomment>div").remove();
				$("#fixcheckcomment").empty();
				$("#fixcheckcomment").append('<div style="width:100%;" cont="head"></div>');
				$("div[cont=\"head\"]").css("height",window.headheight+"px");
				$("#fixcheckcomment").append('<p style="text-align:center;">无</p>');
			}
		});
	}		








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
			$("#actvote").empty();
			
			var html='<div style="width:100%;" cont="head">\
			</div>\
			  <div class="row">\
				<div class="col-xs-6" style="padding-bottom:15px;">\
				  <img class="img-circle" src="votephotos/jiemu8.jpg" alt="Generic placeholder image" width="140" height="140">\
				  <h3>1.梦灯笼</h3>\
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
			
			$("#fixcomputer").find("form").hide();
			$("#fixinf").remove();
			var html='<div class="panel panel-default" id="fixinf">\
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
					    $("#fixinf").remove();
						$("#fixcomputer").find("form").show(); 
						$("#fixtime").empty();
						checkfixtime();
						
						
					}
				});
			});
		}
		else{
			 $("#fixtime").empty();
			 checkfixtime();
		}
	});
}
	//获取大型义务维修的数据
function getno(){
	$("#fixform0").empty();
	$.post("getno.php").done(function(data){
		console.log(data);
			
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			console.log(e);
			return;
		}
		
			if(da["if"]==1)
			{
				
				
					var html='<div class="panel panel-default" >\
								<div  class="panel-collapse collapse in ">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >编号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["wx"]+''+da["msg"]["number"]+'" cont="number">\
										</div>\
										<div class="form-group">\
											<label >预约人姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["sname"]+'" cont="sname">\
										</div>\
										<div class="form-group">\
											<label >预约人学号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["sid"]+'" cont="sid">\
										</div>\
										<div class="form-group">\
											<label >预约人手机号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["tel"]+'" cont="tel">\
										</div>\
										<div class="form-group">\
											<label >维修部分:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["wx1"]+'" cont="wx">\
										</div>\
										<div class="form-group">\
											<label >维修地点:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["addr"]+'" cont="tel">\
										</div>\
										<div class="form-group">\
											<label >具体问题:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["ques"]+'" cont="ques">\
										</div>\
										<div class="form-group">\
											<label >附加要求:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["des"]+'" cont="desc">\
										</div>\
										<div class="form-group">\
											<label >是否维修完成:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"]["ok"]+'" cont="ok">\
										</div>';
										
										
													
						html+='</div>\
									</div>\
								</div>';	
					$("#fixform0").append(html);		
			
			

		    }
			else
			{
				
					$("#fixform0").append("您未参加大型义务维修");	
				
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
		department["KxJsJf"]="技术服务部";
		department["KxJsKy"]="科技研究部";
		department["KxHdKh"]="科创活动部";
		department["KxHdXj"]="学术交流部";
		var html='<div class="panel panel-default" id="recruitresult">';
		if(da["error"]==0)
		{
			$("#recruit").find("form").hide();
			$("#recruitresult").remove();
			for(var p in da["department"])
			{
				html+=' <div class="panel-heading">\
										<span >'+department[da["department"][p]["department"]]+'</span>\
									    <span     style="float:right;"  class="label '+(da["department"][p]["second"]==1? "label-primary":"label-default")+'">second</span>\
										<span   style="margin-right:6px;float:right;"  class="label '+(da["department"][p]["first"]==1? "label-primary":"label-default")+'">first</span>\
									</div>';
			}
			html+=' <div class="panel-heading">\
						      <span >没有咯</span>\
			                  <span type="submit" cont="repost" style="float:right;" class="label label-default repost" >重新报名</span>\
		                   </div>\
				    </div>';
			$("#recruit").append(html);
		    $(".repost").click(function(){
							$.post("cgjudge.php").done(function(data){
							console.log(data);
							try{
									var da=JSON.parse(data);
								}
							catch(e){
									console.log(e);
									return;
									}
							
						if(da["error"]==0){
						$("#recruitresult").remove();
						$("#recruit").find("form").show();	
						}
						else{
                         alert("已参加面试，无法再次报名");
 						}
						});	
						});	
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
			
			$("#notice").find("a").remove();
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
		break;
		case "#fixform":
        {
            //获取大型义务维修的数据
            getno();
        }
		break;
		case "#actvote":
        {
            //检测活动是否投票
            getvote();
        }
		break;
		case "#recruit":
        {
            //检测是否已经参加招新报名，以及报名了哪些部门
            getrecruit();;
        }
		break;
		case "#fixcomputer":
        {
            //预约页面
            getfix();
        }
		break;
		case "#fixcheckcomment":
        {
            //获取待评价预约维修信息
            gethfixcheckcomment()
        }
		break;
		case "#hfixcheckcomment":
        {
            //获取已评价预约维修信息
            gethfixcheckcomment();
        }
		break;
		
		
		
		
		
	}
}
//获取所有活动列表
function getallhd(){
	$.post("getallhd.php").done(function(data){
        $("#kxhd1").empty();		
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
			
			if(da["inf"]["openid"]==da["inf"]["seopenid"]){
				$("span[cont=\"bound\"]").text("已绑定当前微信号,点击解绑");
				//解绑微信号
				$("span[cont=\"bound\"]").parent().parent().click(unlink);
			}else{
				$("span[cont=\"bound\"]").text("绑定微信号非当前微信号");
				//绑定当前微信号
				$("span[cont=\"bound\"]").parent().parent().click(bound);
			}
			
			/*
			//关于头像的处理
			var img=new Image();
			img.src="getimg.php";
			//发生错误就用微信的头像
			img.onerror=function(){
				$("#headimgurl").attr("src",window.inf["headimgurl"]);
			}
			*/
			
			
			//$("#head a").attr("href","#");
			
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
			//隐藏招新报名通道
			//$("#kxrecruit").show();
			
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
		    var weekdays=[];
			weekdays[0]="周日";
			weekdays[1]="周一";
			weekdays[2]="周二";
			weekdays[3]="周三";
			weekdays[4]="周四";
			weekdays[5]="周五";
			weekdays[6]="周六";
			
			window.fixmaxnum=da["conf"];//用于记录一天的维修人数
			var time_allowed={};//用来记录可预约的时间
			var time;//用于记录显示内容
			var date=new Date();
			var now_week=date.getDay();//获取星期几
			var now_time=date.getHours();
			var t;//判断之前还是之后
			
			console.log(now_week);
			console.log(now_time);
			console.log(da["msg"][0]["week"]);
			
			var max_week=da["msg"][da["msg"].length-1]["week"];
			if(now_week>max_week)
			 {
			    t=true;
			 }
			else{
			   if(now_week==max_week&&now_time>"21")
			    {
				    t=true;
				}
				else{
			        t=false;
				}
			}
            console.log(t);
		    

			if(t)
			{
			  var d;
			   for(var i=0;i<da["msg"].length;i++)
			     {
				    
				    d=new Date();
					d.setDate(d.getDate()+Number(da["msg"][i]["week"])+7-now_week);
					console.log(d);
					
				    time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
					time_allowed[time]=1;
					console.log(time);
					
					var html='<div class="radio">\
								<label>\
								<input type="radio" name="time" value="'+time+'">'+time+'晚7:00-9:00\
								</label>\
							</div>'
					$("#fixtime").append(html);
				 }
			   
			}  
			else{
			   var d;
			   for(var i=0;i<da["msg"].length;i++)
			   {
			      if(now_week>da["msg"][i]["week"])
				   {
				      continue;
				   }
				   else if(now_week==da["msg"][i]["week"]&&now_time>"21")
				   {
					   continue;
				   }
			       else{
				        
				        d=new Date();
						d.setDate(d.getDate()+Number(da["msg"][i]["week"])-now_week);
						console.log(d);
						
						time=d.getFullYear()+"-"+(Number(d.getMonth()+1)<10? ("0"+Number(d.getMonth()+1)):Number(d.getMonth()+1))+"-"+(d.getDate()<10? ("0"+d.getDate()):d.getDate());
						time_allowed[time]=1;
						console.log(time);
						
						var html='<div class="radio">\
									<label>\
									<input type="radio" name="time" value="'+time+'">'+time+'晚7:00-9:00\
									</label>\
								</div>'
						$("#fixtime").append(html);
				   }
			   }
			
			}
			

			
			//验证几个日期是否都满了
			console.log(time_allowed);
			$.post("getfixfull.php",time_allowed).done(function(data){
				console.log(data);
				try{
					var da=JSON.parse(data);
				}
				catch(e){
					console.log(e);
					return;
				}
				for(var p in da)
				{
					if(!(da[p]<window.fixmaxnum["numperday"]))
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
