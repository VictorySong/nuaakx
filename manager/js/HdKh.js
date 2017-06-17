$(document).ready(function(){
	
	hdfunc();
	//表单提交拦截
	$("#hdrelease").find("form").submit(function(e){
		e.preventDefault();
		var json={};
		var hdname=$(this).find("[name=\"hdname\"]");
		var hdcontent=$(this).find("[name=\"hdcontent\"]");
		var hdsign=$(this).find("[name=\"hdsign\"]");
		var hdurl=$(this).find("[name=\"hdurl\"]");
		var hdsignend=$(this).find("[name=\"hdyear\"]").val()+"-"+window.monthreverse[Number($(this).find("[name=\"hdmonth\"]").val())]+"-"+window.date[Number($(this).find("[name=\"hdday\"]").val())]+"-"+window.hour[Number($(this).find("[name=\"hdhour\"]").val())];
		var hdmax=$(this).find("[name=\"hdmax\"]");
		if(hdname.val()=="")
		{
			hdname.focus();
			return;
		}
        if(hdmax.val()=="")
        {
            hdmax.focus();
            return;
        }
		if(hdcontent.val()=="")
		{
			hdcontent.focus();
			return;
		}
		if(hdurl.val()=="")
		{
			hdurl.focus();
			return;
		}
		if(hdsign.prop("checked"))
		{
			json["hdsignend"]=hdsignend;
		}
        json["hdmax"]=hdmax.val();
		json["hdname"]=hdname.val();
		json["hdcontent"]=hdcontent.val();
		json["hdurl"]=hdurl.val();
		console.log(json);
		$.post("recordhd.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}catch(e){
				console.log(e);
				return;
			}
			if(da["error"]==0)
			{
				alert("活动发布成功");
			}
		});
	});
    //填写人数blur 后检查
    $("#hdrelease").find("[name=\"hdmax\"]").on("blur",function(){
        if(!isNaN(parseInt($(this).val())))
            $(this).val(parseInt($(this).val()));
        else
            $(this).val("");
        
    });
});

function hdfunc(){
	window.month=[];//方便确定月份
	for(var i=0; i<12 ;i++)
	{
		window.month[i]=i+1;
	}
	window.monthreverse1=[];
	for(var i=1;i<13;i++)
	{
		window.monthreverse1[i]=i-1;
	}
	window.monthreverse=[];//放便确定月份
	for(var i=1;i<13;i++)
	{
		window.monthreverse[i]=((Number(i)-1)<10? "0"+(Number(i)-1):(Number(i)-1));
	}
	window.date=[];//方便确定一月中的哪天
	for(var i=1;i<32;i++)
	{
		window.date[i]=(Number(i)<10?"0"+Number(i):Number(i));
	}
	window.hour=[];
	for(var i=0;i<24;i++)
	{
		window.hour[i]=(Number(i)<10?"0"+Number(i):Number(i));
	}
	//设定活动截止时间可选的月份
	var date=new Date();
	var nowyear=date.getFullYear();
	var nowmonth=date.getMonth();
	var nowdate=date.getDate();
	var nowhour=date.getHours();
	var html="";
	//添加年
	var j=0;
	while(j<2)
	{
		html+='<option>'+(nowyear+j)+'</option>';
		j++;
	}
	$("#hdrelease").find("[name=\"hdyear\"]").append(html);
	$("#hdrelease").find("[name=\"hdyear\"]").on("change",function(){
		var date=new Date();
		var nowyear=date.getFullYear();
		var nowmonth=date.getMonth();
		var nowdate=date.getDate();
		var nowhour=date.getHours();
		var html="";
		var j=0;
		var year=$("#hdrelease").find("[name=\"hdyear\"]");
		var month=$("#hdrelease").find("[name=\"hdmonth\"]");
		var day=$("#hdrelease").find("[name=\"hdday\"]");
		var hour=$("#hdrelease").find("[name=\"hdhour\"]");
		date.setFullYear(Number(year.val()));
		if(date.getFullYear()==nowyear)
		{
		}
		else{
			date.setMonth(0);
		}
		while(date.getFullYear()==Number(year.val()))
		{
			html+='<option>'+window.month[date.getMonth()]+'</option>';
			date.setMonth(date.getMonth()+1);
		}
		console.log("year");
		month.find("option").remove();
		month.append(html);
		month.trigger("change");
		
	});
		
	//添加月份选项
	html="";
	for(var i=nowmonth;i<12; i++)
	{
		html+='<option>'+window.month[i]+'</option>';
	}
	$("#hdrelease").find("[name=\"hdmonth\"]").append(html);
	
	//月份变更监听
	$("#hdrelease").find("[name=\"hdmonth\"]").on("change",function(){
		var date=new Date();
		var nowyear=date.getFullYear();
		var nowmonth=date.getMonth();
		var nowdate=date.getDate();
		var nowhour=date.getHours();
		var html="";
		var j=0;
		var year=$("#hdrelease").find("[name=\"hdyear\"]");
		var month=$("#hdrelease").find("[name=\"hdmonth\"]");
		var day=$("#hdrelease").find("[name=\"hdday\"]");
		var hour=$("#hdrelease").find("[name=\"hdhour\"]");
		console.log("month");
		date.setFullYear(Number(year.val()));
		date.setMonth(window.monthreverse1[month.val()]);
		console.log(date.getFullYear());
		if(window.monthreverse1[month.val()]==nowmonth && date.getFullYear()==nowyear)
		{
		}
		else{
			date.setDate(1);
		}
		console.log(date.getMonth());
		console.log(window.monthreverse1[month.val()]);
		console.log(date.getMonth()==window.monthreverse1[month.val()]);
		while(date.getMonth()==window.monthreverse1[month.val()])
		{
			j++;
			html+='<option>'+date.getDate()+'</option>';
			date.setDate(date.getDate()+1);
		}

		$("#hdrelease").find("[name=\"hdday\"]").find("option").remove();
		$("#hdrelease").find("[name=\"hdday\"]").append(html);
		$("#hdrelease").find("[name=\"hdday\"]").trigger("change");
		
		
		
	});
	
	//添加日期首选项
	html="";
	var j=0;

	while(date.getMonth()==nowmonth)
	{
		j++;
		html+='<option>'+date.getDate()+'</option>';
		date.setDate(date.getDate()+1);
	}
	date.setDate(date.getDate()-j);
	$("#hdrelease").find("[name=\"hdday\"]").append(html);
	
	//日变更监听
	$("#hdrelease").find("[name=\"hdday\"]").on("change",function(){
		var date=new Date();
		var nowyear=date.getFullYear();
		var nowmonth=date.getMonth();
		var nowdate=date.getDate();
		var nowhour=date.getHours();
		var html="";
		var j=0;
		var year=$("#hdrelease").find("[name=\"hdyear\"]");
		var month=$("#hdrelease").find("[name=\"hdmonth\"]");
		var day=$("#hdrelease").find("[name=\"hdday\"]");
		var hour=$("#hdrelease").find("[name=\"hdhour\"]");
		console.log("date")
		date.setFullYear(Number(year.val()));
		date.setMonth(window.monthreverse1[month.val()]);
		date.setDate(Number(day.val()));
		if(date.getDate()==nowdate && date.getMonth()== nowmonth && date.getFullYear()==nowyear )
		{
			date.setHours(date.getHours()+1);
		}
		else{
			date.setHours(0);
		}
		while(date.getDate()==Number(day.val()))
		{
			j++;
			
			html+='<option>'+date.getHours()+'</option>';
			date.setHours(date.getHours()+1);
		}

		$("#hdrelease").find("[name=\"hdhour\"]").find("option").remove();
		$("#hdrelease").find("[name=\"hdhour\"]").append(html);
	});
	html="";
	date.setHours(date.getHours()+1);
	while(date.getDate()==nowdate)
	{
		html+='<option>'+date.getHours()+'</option>';
		date.setHours(date.getHours()+1);
	}
	$("#hdrelease").find("[name=\"hdhour\"]").append(html);
	
	
	//定义点击添加报名后 显示 报名截止时间
	$("#hdrelease").find("input[name=\"hdsign\"]").on("change",function(){
		if($(this).prop("checked"))
		{
			$("#hdsignendtime").show();
		}
		else
		{
			$("#hdsignendtime").hide();
		}
	});
	//定义选中时间的对应调整
	$("#hdrelease").find("input[name=\"hdmonth\"]").on("change",function(){
	});
}
//获取参加活动数
function gethd(){
	console.log("haha");
	$.post("gethd.php").done(function(data){
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
								<h3 class="panel-title" data-toggle="collapse" hdid="'+da["msg"][p]["hdid"]+'" cont="hdname" data-parent="#recruit1" data-target="#'+da["msg"][p]["hdid"]+'">\
									'+da["msg"][p]["name"]+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+da["msg"][p]["num"]+'\
								</h3>\
							</div>\
							<div id="'+da["msg"][p]["hdid"]+'" class="panel-collapse collapse">\
								<div class="panel-body" style="overflow:scroll;">\
									'+da["msg"][p]["content"]+'<br>\
									<a href="'+da["msg"][p]["url"]+'">原文</a><br>\
									<caption>报名详情</caption>\
									<table class="table table-striped">\
									  <thead>\
										<tr>\
										  <th style="min-width:100px; padding-left:2px; padding-right:2px;">学号</th>\
										  <th style="min-width:100px; padding-left:2px; padding-right:2px;">姓名</th>\
										  <th style="min-width:100px; padding-left:2px; padding-right:2px;">手机</th>\
										  <th style="min-width:100px; padding-left:2px; padding-right:2px;">邮箱</th>\
										</tr>\
									  </thead>\
									  <tbody>';
					html+='</tbody></table>	</div></div></div>';
					$("#gethd1").append(html);
			}
			
			$("[cont=\"hdname\"]").click(addhdnameclick);
		}
	});
}
//获取参加活动人数
function addhdnameclick(){
	var json={};
	json["hdid"]=$(this).attr("hdid");
	window.hsgetsignjson=json;
	if($("#"+window.hsgetsignjson["hdid"]).find("tbody").find("tr").length!=0)
		return;
	console.log(json);
	$.post("gethdsign.php",json).done(function(data){
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
				var html='<tr>\
							  <th>'+da["msg"][p]["stId"]+'</th>\
							  <th>'+da["msg"][p]["name"]+'</th>\
							  <th>'+da["msg"][p]["phone"]+'</th>\
							  <th>'+da["msg"][p]["email"]+'</th>\
							</tr>';
				$("#"+window.hsgetsignjson["hdid"]).find("tbody").append(html);
			}
		}
	});
}