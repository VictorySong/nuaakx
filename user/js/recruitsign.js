$(document).ready(function(){
	//记录个人信息
	window.inf={};
	userinfget()
	//签到提交
	$("#recruitsign").submit(function(e){
		e.preventDefault();
		
		var id=$("#recruitsign input[name=Id]").val();
		console.log(id);
		if(id!=undefined && id!=null)
		{
			$.post("recruitsignrecord.php",{stId:id}).done(function(data){
				console.log(data);
				try{
					var da=JSON.parse(data);
				}catch(e){ 
					console.log(e);
					return;
				}
				if(da["error"]==0){
					switch(da["status"]){
						case "200":{
							alert("签到成功");
						}
						break;
						case "400":{
							alert("您已签到");
						}
						break;
						case "401":{
							alert("您未报名，无法签到");
						}
						break;
					}
				}else{
					alert("签到出错");
				}
			});
		}
	});
					
	
});
function userinfget(){
	//获取用户个人信息
	$.get("userinf.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			setTimeout(function(){document.location.href="../user/login.html"},1000);
			setTimeout(function(){location.reload();},3000);//解决uc浏览器登陆后返回历史记录的问题页面不刷新的问题
			return ;
		}
		
		if(da["error"]==0)
		{
			window.inf=da["inf"];
			$("#recruitsign [name=\"Id\"]").val(window.inf["stId"]);
		}
		
	});
}