	//设置投诉与建议表单提交
	$("#itemlogreg").find("form").submit(function(e){
		e.preventDefault();
		var json={}
		
		var jname=$(this).find("#jn");
		if(jname.val()==""){
			
			phone.focus();
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
				getrecruit();
				userinfget();
			}
		});
			alert("我们已收到您的投诉和建议！");
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
				getrecruit();
				userinfget();
			}
		});
			alert("我们已收到您的投诉和建议！");
		}
		}
		
			
	});