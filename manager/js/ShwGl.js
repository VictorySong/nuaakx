$(document).ready(function(){
/*		//确定获取物资借用时间
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
	$("#itemtype").text(item[x]);
	
	
	$("#previous").click(function(){
		if (x>0){x= x-1;}
		else{x=3;}
		$("#itemtype").text(item[x]);
		getwzjy();
	
	});
	$("#next").click(function(){
		if (x<3){x= x+1;}
		else{x=0;}
		$("#itemtype").text(item[x]);
		getwzjy();
		
	});
*/	
	$("#wuziselect0").click(function(){
		
		getwzjy("506");
		
	});
	$("#wuziselect1").click(function(){
		
		getwzjy("510");
		
	});
	$("#wuziselect2").click(function(){
		
		getwzjy("touyy");
		
	});
	$("#wuziselect3").click(function(){
		
		getwzjy("zhangp");
		
	});

	
});

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
			json["jphone"]=jphone.val(); //借用者电话
		
		
		var gname=$(this).find("#gn");
		if(gname.val()==""){
			
			gname.focus();
			return;
		}
		else
			json["gname"]=gname.val(); //管理人员姓名
	
	
		var jdatetime=$(this).find("input[name='jdatetime']");  //借用时间
		if(jdatetime.val()==""){
			
			jdatetime.focus();
			return;
		}
		else
			json["jdatetime"]= new Date(jdatetime.val.replace(/-/g,'/').replace('T',' ')).toISOString();
		
		
		var jdatetime1=$(this).find("input[name='jdatetime1']"); //归还时间
		if(jdatetime1.val()==""){
			
			jdatetime1.focus();
			return;
		}
		else
			json["jdatetime1"]=jdatetime1.val();

		var description=$(this).find("textarea");
	    json["description"]=description.val(); //备注
		
		var wuzi=$(this).find("input[name='wuzi']:checked");
		json["wuzi"]=wuzi.val(); //借用的什么物资
			
		
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
function getwzjy(x){
	$("#itemlog2").children().remove();
	
	$.post("getwzjy.php",{item:x}).done(function(data){
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
										借用人姓名：'+da["msg"][p]["jname"]+'\
										<br/>借用时间：'+da["msg"][p]["jdatetime"]+'<br/>归还时间：'+da["msg"][p]["jdatetime1"]+'\
									</h3>\
								</div>\
								<div id="'+p+'" class="panel-collapse collapse">\
									<div class="panel-body">\
										<div class="form-group">\
											<label >借用人姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jname"]+'" cont="jname">\
										</div>\
										<div class="form-group">\
											<label >借用人手机:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jphone"]+'" cont="jphone">\
										</div>\
										<div class="form-group">\
											<label >借出时间:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jdatetime"]+'" cont="jdatetime">\
										</div>\
										<div class="form-group">\
											<label >归还时间:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["jdatetime1"]+'" cont="jdatetime1">\
										</div>\
										<div class="form-group">\
											<label >管理人员姓名:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["gname"]+'" cont="gname">\
										</div>\
										<div class="form-group">\
											<label >备注:</label>\
											<input type="text" class="form-control" disabled value="'+da["msg"][p]["description"]+'" cont="description">\
										</div>\
										<button type="submit" cont="return"  class="btn btn-default clickme" style="width:100%;">归还请戳我</button>';
													
						html+='</div>\
									</div>\
								</div>';
						
						
					$("#itemlog2").append(html);
						

				
			}
				//归还物资函数
$(".clickme").click(function(){
	var json={};
	p = $(this).parent().parent().attr("id");
	window.cancelthat=this;
	json["jname"]=da["msg"][p]["jname"];
	json["gname"]=da["msg"][p]["gname"];
	json["jdatetime"]=da["msg"][p]["jdatetime"];
	json["jdatetime1"]=da["msg"][p]["jdatetime1"];
	json["item"]=x;
	console.log("hahah");
	console.log(json);
	$.post("return.php",json).done(function(data){
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
			alert("成功归还");
			window.history.go(-1);
		}
	});
});	
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