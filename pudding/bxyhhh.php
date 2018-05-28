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
$(document).ready(function(){		//文件ready之后执行函数
  $("form").submit(function(e){		//表单提交之后执行函数，只适用于form元素
	e.preventDefault();				//点击提交按钮时阻止对表单的提交
	var json={};
	var sid=$(this).find("#stid");	//sid定义为输入框元素 sid.val是获得的值
    if(sid.val()==""){		
		sid.focus();				//输入框获得焦点
		return;
	}
	else {
	  json["stid"]=sid.val();		//赋值给json数组
	}
	if (confirm("检查一下有没有填错信息，点击确认提交哟"))		//弹出确认对话框
	{
		$.post("bxywelcome.php",json).done(function(data){		//	问题：这里的.post.done是在此处判断还是在此处执行？
			console.log(data);									//  问题：26-37行是post的标准格式吗
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
				
				
					$("div.container").append(html);			//把上述html变量包含的内容追加到已经remove了的网页中
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

