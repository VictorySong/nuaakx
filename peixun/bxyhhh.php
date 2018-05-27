<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<form action="bxywelcome.php" method="post">
学号：<input type="number" name="Id"><br>
<input type="submit">
</form>

//实现搜索功能。通过网页搜索，输入学号，能在科协数据库查找名字等相关信息并显示出来，通过网页显示
$submit(function(e){
		e.preventDefault();
		var id=$("input[name=Id]").val();
		console.log(id);
		if(id!=undefined && id!=null)
		{
			$.post("bxy1.php",{stId:id}).done(function(data){
				console.log(data);
				try{
					var da=JSON.parse(data);
				}catch(e){ 
					console.log(e);
					return;
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

</body>
</html>



