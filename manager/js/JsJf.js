$(document).ready(function(){
	//确定获取预约维修时间
	window.fixdate=new Date();
	window.fixcomputerdate=window.fixdate.getFullYear()+"-"+((Number(window.fixdate.getMonth())+1)<10?"0"+(Number(window.fixdate.getMonth())+1):(Number(window.fixdate.getMonth())+1))+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
	window.fixcomputerdate1=window.fixdate.getFullYear()+"-"+(Number(window.fixdate.getMonth())+1)+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());

	//切换获取维修预约的时间
	$("#fixformer").click(function(){
		console.log(window.fixdate.getTime());
		window.fixdate.setTime(window.fixdate.getTime()-86400000);
		console.log(window.fixdate.getTime());
		window.fixcomputerdate=window.fixdate.getFullYear()+"-"+((Number(window.fixdate.getMonth())+1)<10?"0"+(Number(window.fixdate.getMonth())+1):(Number(window.fixdate.getMonth())+1))+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
		window.fixcomputerdate1=window.fixdate.getFullYear()+"-"+(Number(window.fixdate.getMonth())+1)+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());

		getfixcomputer()
	});  
	$("#fixlater").click(function(){
		console.log(window.fixdate.getTime());
		window.fixdate.setTime(window.fixdate.getTime()+86400000);
		console.log(window.fixdate.getTime());
		window.fixcomputerdate=window.fixdate.getFullYear()+"-"+((Number(window.fixdate.getMonth())+1)<10?"0"+(Number(window.fixdate.getMonth())+1):(Number(window.fixdate.getMonth())+1))+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
		window.fixcomputerdate1=window.fixdate.getFullYear()+"-"+(Number(window.fixdate.getMonth())+1)+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());

		getfixcomputer()
	});
	//维修预约配置函数
	//关于每天可预约人数
	$("span[cont=\"fixperday\"]").click(function(){
		window.fixperday=$(this);
		var json={};
		json["perday"]=window.fixperday.attr("perday");
		$.post("changenumperday.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}catch(e){
				console.log(e);
				return;
			}
			if(da["error"]==0)
			{
				$("span[cont=\"fixperday\"]").removeClass("label-primary");
				$("span[cont=\"fixperday\"]").addClass("label-default");
				if(window.fixperday.hasClass("label-default"))
				{
					window.fixperday.removeClass("label-default");
					window.fixperday.addClass("label-primary");
				}
				else if(window.fixperday.hasClass("label-primary"))
				{
					window.fixperday.removeClass("label-primary");
					window.fixperday.addClass("label-default");
				}
			}
		});
	});
	//关于更改可预约星期
	$("span[cont=\"date\"]").click(function(){
		window.date=$(this);
		var json={};
		json["date"]=window.date.attr("day");
		$.post("changeweek.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}catch(e){
				console.log(e);
				return;
			}
			if(da["error"]==0)
			{
				if(window.date.hasClass("label-default"))
				{
					window.date.removeClass("label-default");
					window.date.addClass("label-primary");
				}
				else if(window.date.hasClass("label-primary"))
				{
					window.date.removeClass("label-primary");
					window.date.addClass("label-default");
				}
			}
		});
	});
	//关于显示可预约天数
	$("span[cont=\"numday\"]").click(function(){
		window.numday=$(this);
		var json={};
		json["numday"]=window.numday.attr("numday");
		$.post("changedays.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}catch(e){
				console.log(e);
				return;
			}
			if(da["error"]==0)
			{
				$("span[cont=\"numday\"]").removeClass("label-primary");
				$("span[cont=\"numday\"]").addClass("label-default");
				if(window.numday.hasClass("label-default"))
				{
					window.numday.removeClass("label-default");
					window.numday.addClass("label-primary");
				}
				else if(window.numday.hasClass("label-primary"))
				{
					window.numday.removeClass("label-primary");
					window.numday.addClass("label-default");
				}
			}
		});
	});

//大型义务维修	
	$("#volunfix0").click(function(){	
		getvolunfix("R");	
	});
	$("#volunfix1").click(function(){	
		getvolunfix("Y");
	});
	$("#volunfix2").click(function(){	
		getvolunfix("B");
	});
	$("#volunfix3").click(function(){	
		getvolunfix2("R");	
	});
	$("#volunfix4").click(function(){	
		getvolunfix2("Y");
	});
	$("#volunfix5").click(function(){	
		getvolunfix2("B");
	});
		
});

//获取大型义务维修未完成的数据
function getvolunfix(x){
	$("#volunfixstatus2").children().remove();
	
	$.post("getvolunfix.php",{item:x}).done(function(data){
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
				
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" cont="name"  role="button" data-toggle="collapse" data-parent="#recruit1" data-target="#'+p+'">\
										维修编号：'+x+''+da["msg"][p]["number"]+' </br></br> 预约人姓名：'+da["msg"][p]["sname"]+'  \
									</h3>\
								</div>\
								<div id="'+p+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >预约人姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["sname"]+'" cont="sname">\
										</div>\
										<div class="form-group">\
											<label >预约人学号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["sid"]+'" cont="sid">\
										</div>\
										<div class="form-group">\
											<label >预约人手机号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["tel"]+'" cont="tel">\
										</div>\
										<div class="form-group">\
											<label >具体问题:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["ques"]+'" cont="ques">\
										</div>\
										<div class="form-group">\
											<label >附加要求:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["des"]+'" cont="desc">\
										</div>\
										<button type="submit" cont="fixok"  class="btn btn-default clickme2" style="width:100%;">已完成维修请戳我</button>';
													
						html+='</div>\
									</div>\
								</div>';
						
						
					$("#volunfixstatus2").append(html);		
			}
			
//完成维修函数
$(".clickme2").click(function(){
	var json={};
	p = $(this).parent().parent().attr("id");
	window.cancelthat=this;
	json["sname"]=da["msg"][p]["sname"];
	json["sid"]=da["msg"][p]["sid"];
	json["tel"]=da["msg"][p]["tel"];
	json["ques"]=da["msg"][p]["ques"];
	json["wx"]=x;
	console.log(json);
	$.post("fixok.php",json).done(function(data){
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
			window.history.go(-1);
		}
	});
});	
			}
		
	});
	
	
}
//获取大型义务维修已完成的数据
function getvolunfix(x){
	$("#volunfixstatus3").children().remove();
	
	$.post("getvolunfix2.php",{item:x}).done(function(data){
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
				
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" cont="name"  role="button" data-toggle="collapse" data-parent="#recruit1" data-target="#'+p+'">\
										维修编号：'+x+''+da["msg"][p]["number"]+' </br></br> 维修人姓名：'+da["msg"][p]["fixname"]+'  \
									</h3>\
								</div>\
								<div id="'+p+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >预约人姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["sname"]+'" cont="sname">\
										</div>\
										<div class="form-group">\
											<label >预约人学号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["sid"]+'" cont="sid">\
										</div>\
										<div class="form-group">\
											<label >预约人手机号:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["tel"]+'" cont="tel">\
										</div>\
										<div class="form-group">\
											<label >具体问题:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["ques"]+'" cont="ques">\
										</div>\
										<div class="form-group">\
											<label >附加要求:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["des"]+'" cont="desc">\
										</div>\
										<div class="form-group">\
											<label >维修人:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["fixname"]+'" cont="desc">\
										</div>\
										
													
						html+='</div>\
									</div>\
								</div>';
						
						
					$("#volunfixstatus3").append(html);		
			}
			
			
			
			
			
			
			
			}
		
	});
	
	
}			
//获取维修预约信息的函数
function getfixcomputer(){
	$("#fixdate").text(window.fixcomputerdate);
	$("#fixcomputer1").children().remove();
	console.log(window.fixcomputerdate);
	$.post("getfixcomputer.php",{date:window.fixcomputerdate,date1:window.fixcomputerdate1}).done(function(data){
		console.log(data);
			
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
			return;
		}
			if(da["error"]==0)
			{
				
				for(var p in da["msg"])
				{
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" cont="name"  role="button" data-toggle="collapse" data-parent="#recruit1" data-target="#'+da["msg"][p]["stId"]+'">\
										'+da["msg"][p]["stId"]+'\
										&nbsp;&nbsp;&nbsp; '+da["msg"][p]["name"]+'&nbsp;&nbsp;&nbsp; '+da["msg"][p]["place"]+'\
									</h3>\
								</div>\
								<div id="'+da["msg"][p]["stId"]+'" class="panel-collapse collapse">\
									<div class="panel-body">\
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
											<label >问题描述:</label>\
											<div class=""  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:71px; overflow:scroll; border:1px solid #ccc;" cont="problem">'+(da["msg"][p]["problem"]==null?"":da["msg"][p]["problem"])+'</textarea>\
										</div>\
										<div class="form-group">\
											<label >评价:</label>\
											<div class="" style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:50px; overflow:scroll; border:1px solid #ccc;" cont="evaluate">'+(da["msg"][p]["evaluate"]==null?"":da["msg"][p]["evaluate"])+'</textarea>\
										</div>\
										<div class="form-group">\
											<label >解决措施:</label>\
											<div  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:50px; overflow:scroll; border:1px solid #ccc;"  class="" cont="solution" '+(da["msg"][p]["solution"]==null?"":"already=\"1\"")+' action="insertfixsolution.php" stId="'+da["msg"][p]["stId"]+'">'+(da["msg"][p]["solution"]==null?"":da["msg"][p]["solution"])+'</div>\
										</div>\
										<div class="form-group">\
											<label >回复:</label>\
											<div  style="padding-left:6px; padding-right:6px; padding-top:5px; padding-bottom:5px; border-radius:4px; min-height:50px; overflow:scroll; border:1px solid #ccc;"  class="" cont="response" '+(da["msg"][p]["response"]==null?"":"already=\"1\"")+' action="insertfixresponse.php" stId="'+da["msg"][p]["stId"]+'">'+(da["msg"][p]["response"]==null?"":da["msg"][p]["response"])+'</div>\
										</div>';			
						html+='</div>\
									</div>\
								</div>';
					$("#fixcomputer1").append(html);
				}
				$("#fixcomputer1").find("[cont=\"solution\"]").click(fixSR);//解决措施
				$("#fixcomputer1").find("[cont=\"response\"]").click(fixSR);//回复
				
			}
		
	});
	
	
}
//维修解决措施，回复 点击函数
function fixSR(){
	if($(this).attr("already"))
	{
		return;
	}
	$("#rootinput").show();
	$("#background").show();
	window.fixSR=$(this);
	var fo=$("#rootinput").find("form");
	fo.attr("action",$(this).attr("action"));
	fo.attr("stId",$(this).attr("stId"));
	fo.find("textarea").focus();
}
//获取维修预约配置信息
function getfixconf(){
	$.post("getfixconf.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
			return;
		}
		if(da["error"]==0)
		{
			$("span[cont=\"fixperday\"][perday=\""+da["numperday"]+"\"]").removeClass("label-default");
			$("span[cont=\"fixperday\"][perday=\""+da["numperday"]+"\"]").addClass("label-primary");
			$("span[cont=\"numday\"][numday=\""+da["days"]+"\"]").removeClass("label-default");
			$("span[cont=\"numday\"][numday=\""+da["days"]+"\"]").addClass("label-primary");
			for(var p in da["week"])
			{
				$("span[cont=\"date\"][day=\""+da["week"][p]["week"]+"\"]").removeClass("label-default");
				$("span[cont=\"date\"][day=\""+da["week"][p]["week"]+"\"]").addClass("label-primary");
			}
		}
	});
}