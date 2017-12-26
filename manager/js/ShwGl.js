	//设置物资借用表单提交
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
		
		var description=$(this).find("textarea");
	    json["description"]=description.val();
		
		var wuzi=$(this).find("input[name='wuzi']:checked");
		json["wuzi"]=wuzi.val();
		
		var jdate=$(this).find("input[name='jdate']");
		json["jdate"]=jdate.val();
		
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
	
	
	
	
	function getwzjy(){
	$("#fixdate").text(window.fixcomputerdate);
	$("#itemlog1").children().remove();
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