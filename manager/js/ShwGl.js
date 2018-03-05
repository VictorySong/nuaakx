/*	$(document).ready(function(){
	//确定获取物资借用时间
	window.fixdate=new Date();
	window.fixdate.setTime(window.fixdate.getTime());
	window.fixcomputerdate=window.fixdate.getFullYear()+"-"+((Number(window.fixdate.getMonth())+1)<10?"0"+(Number(window.fixdate.getMonth())+1):(Number(window.fixdate.getMonth())+1))+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
	window.fixcomputerdate1=window.fixdate.getFullYear()+"-"+(Number(window.fixdate.getMonth())+1)+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
	getwzjy()
	
	//切换获取物资借用的时间
	$("#roomformer").click(function(){
		console.log(window.fixdate.getTime());
		window.fixdate.setTime(window.fixdate.getTime()-86400000);
		console.log(window.fixdate.getTime());
		window.fixcomputerdate=window.fixdate.getFullYear()+"-"+((Number(window.fixdate.getMonth())+1)<10?"0"+(Number(window.fixdate.getMonth())+1):(Number(window.fixdate.getMonth())+1))+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
		window.fixcomputerdate1=window.fixdate.getFullYear()+"-"+(Number(window.fixdate.getMonth())+1)+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());

		getwzjy()
	});  
	$("#roomlater").click(function(){
		console.log(window.fixdate.getTime());
		window.fixdate.setTime(window.fixdate.getTime()+86400000);
		console.log(window.fixdate.getTime());
		window.fixcomputerdate=window.fixdate.getFullYear()+"-"+((Number(window.fixdate.getMonth())+1)<10?"0"+(Number(window.fixdate.getMonth())+1):(Number(window.fixdate.getMonth())+1))+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());
		window.fixcomputerdate1=window.fixdate.getFullYear()+"-"+(Number(window.fixdate.getMonth())+1)+"-"+(Number(window.fixdate.getDate())<10?"0"+window.fixdate.getDate():window.fixdate.getDate());

		getwzjy()
	});
	
			
});
*/
	
	//物资借用表单提交
	$("#itemlogreg").find("form").submit(function(e){
		e.preventDefault();
		var json={}
		
		var jname=$(this).find("#jn");
		if(jname.val()==""){
			
			jname.focus();
			return;
		}
		else
			json["jname"]=jname.val();
		
		var jphone=$(this).find("#jp");
		if(jphone.val()==""){
			
			jphone.focus();
			return;
		}
		else
			json["jphone"]=jphone.val();
		
		var gname=$(this).find("#gn");
		if(gname.val()==""){
			
			gname.focus();
			return;
		}
		else
			json["gname"]=gname.val();
		
		var jdate=$(this).find("input[name='jdate']");
		if(jdate.val()==""){
			
			jdate.focus();
			return;
		}
		else
			json["jdate"]=jdate.val();
		
		var description=$(this).find("textarea");
	    json["description"]=description.val();
		
		var wuzi=$(this).find("input[name='wuzi']:checked");
		json["wuzi"]=wuzi.val();
			
		var jtime=$(this).find("input[name='jtime']:checked");
		json["jtime"]=jtime.val();
		
		var r=confirm("提交后不可修改，请确认是否提交");
		if (r==true)
		{
			console.log(json);
			$.post("kxwzjy.php",json).done(function(data){
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
			alert("借用登记已提交");
		}
		
			
	});

//物资借用情况显示
function getwzjy(){
	var item=[];
			item[0]="教室506";
			item[1]="教室510";
			item[2]="投影仪";
			item[3]="帐篷";
	var x = 0;		
	$("#previous").click(x+= 1);
	$("#next").click(x-= 1);
	$("#itemtype").text("哈哈");
	
	
	$("#itemlog1").children().remove();
	console.log(window.fixcomputerdate);
	$.post("getroom.php",{date:window.fixcomputerdate,date1:window.fixcomputerdate1}).done(function(data){
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
									<h3 class="panel-title" cont="name"  role="button" data-toggle="collapse" data-parent="#recruit1" data-target="#'+da["msg"][p]["jname"]+'">\
										'+da["msg"][p]["jname"]+'\
										&nbsp;&nbsp;&nbsp; 教室：'+da["msg"][p]["room"]+'&nbsp;&nbsp;&nbsp;开始借用时间： '+da["msg"][p]["time"]+':00\
									</h3>\
								</div>\
								<div id="'+da["msg"][p]["jname"]+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >借用人姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jname"]+'" cont="jname">\
										</div>\
										<div class="form-group">\
											<label >电话:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jphone"]+'" cont="jphone">\
										</div>\
										<div class="form-group">\
											<label >教室:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["room"]+'" cont="room">\
										</div>\
										<div class="form-group">\
											<label >开始使用时间（使用时间为两小时）:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["time"]+':00" cont="room">\
										</div>\
										<div class="form-group">\
											<label >管理人员姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["gname"]+'" cont="jname">\
										</div>';
													
						html+='</div>\
									</div>\
								</div>';
					$("#itemlog1").append(html);
				}
				
			}
		
	});
	
	
}	
	
	//物资借用情况显示
/*	function getwzjy(){
	$("#roomdate").text(window.fixcomputerdate);
	$("#itemlog1").children().remove();
	console.log(window.fixcomputerdate);
	$.post("getroom.php",{date:window.fixcomputerdate,date1:window.fixcomputerdate1}).done(function(data){
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
									<h3 class="panel-title" cont="name"  role="button" data-toggle="collapse" data-parent="#recruit1" data-target="#'+da["msg"][p]["jname"]+'">\
										'+da["msg"][p]["jname"]+'\
										&nbsp;&nbsp;&nbsp; 教室：'+da["msg"][p]["room"]+'&nbsp;&nbsp;&nbsp;开始借用时间： '+da["msg"][p]["time"]+':00\
									</h3>\
								</div>\
								<div id="'+da["msg"][p]["jname"]+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >借用人姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jname"]+'" cont="jname">\
										</div>\
										<div class="form-group">\
											<label >电话:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jphone"]+'" cont="jphone">\
										</div>\
										<div class="form-group">\
											<label >教室:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["room"]+'" cont="room">\
										</div>\
										<div class="form-group">\
											<label >开始使用时间（使用时间为两小时）:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["time"]+':00" cont="room">\
										</div>\
										<div class="form-group">\
											<label >管理人员姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["gname"]+'" cont="jname">\
										</div>';
													
						html+='</div>\
									</div>\
								</div>';
					$("#itemlog1").append(html);
				}
				
			}
		
	});
	
	
}*/