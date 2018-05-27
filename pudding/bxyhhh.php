<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
	<title>查找学号</title>
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script>
$(document).ready(function(){
  $("form").submit(function(e){
	e.preventDefault();
	var json={};
	var sid=$(this).find("#stid");
    if(sid.val()==""){		
		sid.focus();
		return;
	}
	else {
	  json["stid"]=sid.val();
	}
	if (confirm("检查一下有没有填错信息，点击确认提交哟"))
	{
		$.post("bxywelcome.php",json).done(function(data){
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
				$("div.std").remove();
					var html='<div class="panel panel-default" >\
								<div class="panel-heading">\
									<h3 class="panel-title" cont="name"  role="button" data-toggle="collapse" >\
										姓名：'+da["msg"]["name"]+' </br> </br> 邮箱：'+da["msg"]["email"]+'  \
									</h3>\
								</div>\
							</div>';
				
				
					$("div.container").append(html);
			}
		});
	}
	
			

  });

  

});

</script>


<body>
<div class="container">

<div class="std">
<form role="form">
	<div class="form-group">
		<label >学号:</label>
		<input type="text" class="form-control" placeholder="" id="stid">
	</div>
	<button type="submit" class="btn btn-default" name="sub">提交</button>
	<br/><br/>
</form>
</div>
</body>
</html>

