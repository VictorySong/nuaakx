$(document).ready(function(){
	window.inf={};//存储登录人信息；
	//获取用户信息 ，如获取出现问题则跳到登录界面 
	$.get("../test/user/userinf.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			window.location="http://nuaakx.com/test/user/login.html";
			return ;
		}
		
		if(da["error"]==0)
		{
			window.inf=da["inf"];
			$("#accordion").find("[cont=\"nologin\"]").hide();
			$("#accordion").find("[cont=\"alreadylogin\"]").show();
		}
		
	});
	//设置退出登录
	$("accordion a#logout").click(function(){
		$.get("http://nuaakx.com/test/user/logout.php").done(function(){
			$("#accordion").find("[cont=\"nologin\"]").show();
			$("#accordion").find("[cont=\"alreadylogin\"]").hide();
		});
		return false;
	});
	//为所有href="#" 的设置无反应
	/*
	$("a[href=\"#\"]").click(function(){
		return false;
	});*/
	
	$(".navbar-header>button:first-child").click(function(){
		console.log($(this).attr("data-target"));
		$($(this).attr("data-target")).find("form").hide();
	});
	$("nav .label").click(function(){
		if($(this).attr("se")=="false")
		{
			$(this).removeClass("label-default");
			$(this).addClass("label-success");
			$(this).attr("se","true");
		}
		else if($(this).attr("se")=="true")
		{
			$(this).removeClass("label-success");
			$(this).addClass("label-default");
			$(this).attr("se","false");
		}
	});
	//为导航栏添加选中状态
	$("#accordion>ul>li").click(function(){
		$("#accordion>ul>li").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
	});
	$("#accordion>ul>li>ul>li").click(function(){
		$("#accordion>ul>li>ul>li").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
	});
	//获取点赞数，及自己是否点赞
	$.get("../test/Forum/getPostthumb.php",{"postid":window.postid}).done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			return ;
		}
		if(!da["error"])
		{
			$("#contentp span.thumbs").text(da["msg"]["thumbs"]);
			$("#contentp .last>span[to=\"thumbs\"]").attr("alreadythumb",da["msg"]["alreadythumb"]);
		}
		thumb();
	});
	//设置点赞
	thumb();
	//为pencil 图标添加评论功能
	$(".last>.glyphicon-pencil").attr("toaction","../test/Forum/submitPostcomment.php");
	$(".last>.glyphicon-pencil").attr("toid",window.postid);
	
	//添加评论的表单
	var formhtml='<div id="rootinput" style="width:100%; position:fixed; bottom:0px; left:0px; z-index:3; display:none; " >\
		<form id="" class="" style="display:table; width:100%; background-color:#fff;" action="submitPostcomment.php" role="form">\
		  <div class="form-group" style="display:table-row;" >\
			<div style="display:table-cell; width:100%; vertical-align:middle;"><textarea class="form-control" style="height:50px;  " placeholder="内容"></textarea></div>\
			<div style="display:table-cell; width:50px; text-align:center; vertical-align:center;">\
				<button type="submit" class="btn btn-default" style="border:0px; display:table-cell;height:50px; vertical-align:middle;" ><span class="glyphicon glyphicon-send" style=" font-size:35px; display:table-cell; vertical-align:middle;" ></span></button>\
		    </div>\
		  </div>\
		</form>\
	</div>\
	<div id="background" style="position:fixed; top:0px; left:0px; z-index:2; width:100%; display:none;">\
	</div>';
	if($("#rootinput").length==0)
	{
		$("body").append(formhtml);
	}
	//设置 评论表单 提交
	$("#rootinput form").submit(function(e){
		e.preventDefault();
		var that=($(".last").find("span[toid=\""+$(this).attr("toid")+"\"]").length==0)?$(".comment").find("span[toid=\""+$(this).attr("toid")+"\"]") : $(".last").find("span[toid=\""+$(this).attr("toid")+"\"]") ;
		var json={};
		var content=$(this).find("textarea");
		json["toid"]=$(this).attr("toid");
		if(content.val()=="")
		{
			content.focus();
			return ;
		}
		if(json["toid"]=="")
			return ;
		json["content"]=content.val();
		console.log($(this).attr("id"));
		console.log(json);
		console.log(content);
		$.post($(this).attr("action"),json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}
			catch(e){
				return;
			}
			if(!da["error"])
			{
				var html='<div><a href="'+window.inf["stId"]+'" >'+window.inf["nickname"]+'</a> <span style="background-color:#e7e7e7;"> '+content.val()+'</span></div>';
				
				var comt=that;
				console.log(comt);
				while(comt.find(".comment").length==0 && comt.length!=0)
				{
					comt=comt.parent();
				}
				console.log(comt.find(".comment"));
				comt.find(".comment").append(html);
				$("#rootinput").hide();
				$("#background").hide();
				$("#rootinput textarea").val("");
			}
		});
	});
	//设置评论后点击背景返回
	$("#background").css("height",window.innerHeight+"px");
	$("#background").click(function(){
		$("#rootinput").hide();
		$(this).hide();
	});
	//或取评论，评论的回复 评论的回复的回复
	$.post("../test/Forum/Postrecords.php",{postid:window.postid}).done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			return ;
		}
		
		var commentstr="";
		var comment=da["comment"];
		for(var i in comment)
		{
			commentstr+='<div commentid="'+comment[i]["commentid"]+'"><a href="" >'+comment[i]["nickname"]+'</a> <span class="commentspan" style="background-color:#e7e7e7;" toaction="../test/Forum/submitPostcommentresponse.php" toid="'+comment[i]["commentid"]+'"> '+comment[i]["content"]+'</span></div>';
			for(var j in comment[i]["resp"])
			{
				commentstr+='<div commentid="'+comment[i]["resp"][j]["commentid"]+'">&nbsp;&nbsp;<a href="" >'+comment[i]["resp"][j]["nickname"]+'</a>回复:<a href="" >'+comment[i]["nickname"]+'</a> <span class="commentspan" style="background-color:#e7e7e7;" toaction="../test/Forum/submitPostcommentresponseresponse.php" toid="'+comment[i]["resp"][j]["commentid"]+'"> '+comment[i]["resp"][j]["content"]+'</span></div>';
				var com=comment[i]["resp"][j]["resp"];
				for(var p in com)
				{
					commentstr+='<div commentid="'+com[p]["commentid"]+'">&nbsp;&nbsp;<a href="" >'+com[p]["nickname"]+'</a>回复:<a href="" >'+comment[i]["resp"][j]["nickname"]+'</a> <span class="commentspan" style="background-color:#e7e7e7;" toaction="../test/Forum/submitPostcommentresponseresponse.php" toid="'+com[p]["commentid"]+'"> '+com[p]["content"]+'</span></div>';
				}
			}
			
		}	
		
		$(".comment").append(commentstr);
			
		
		thumb();
		postcs();
	});
	
});
function thumb(){
	//对已点赞的进行 样式改变
	$("span[alreadythumb=\"true\"]").css("color","blue");
	$("#contentp .last span[cont=\"thumbs\"]").off("click",thumbclick);
	//设置点赞
	$("#contentp .last span[cont=\"thumbs\"]").on("click",thumbclick);
}
function thumbclick(){
		var thumb=$(this).parent().find("[to=\"thumbs\"]");
		if(thumb.attr("alreadythumb")=="false")
		{
			if(postid!="undefined" || postid!="")
			{
				$.get("../test/Forum/Postthumb.php",{"postid":window.postid}).done(function(data){
					console.log(data);
					try{
						var da=JSON.parse(data);
					}
					catch(e)
					{
						return ;
					}
				});
				
				thumb.css("color","blue");
				thumb.attr("alreadythumb","true");
				thumb=$(this).parent().find(".thumbs");
				thumb.text(Number(thumb.text())+1);
			}
		
		}/*
		else{
			thumb.css("color","#333");
			thumb.attr("alreadythumb","false");
			thumb=$(this).parent().find("[class=\"thumbs\"]");
			thumb.text(Number(thumb.text())-1);
		}*/
}

//////////////////////////////////////

postcs();
function postcs(){
	
	$(".last>.glyphicon-pencil").off("click",postcsclick);
	$(".last>.glyphicon-pencil").on("click",postcsclick);
	$(".commentspan").off("click",postcsclick);
	$(".commentspan").on("click",postcsclick);
}
function postcsclick(){
	var toaction=$(this).attr("toaction");
	var toid=$(this).attr("toid");
	$("#rootinput").show();
	$("#background").show();
	$("#rootinput textarea").focus();
	$("#rootinput form").attr("action",toaction);
	$("#rootinput form").attr("toid",toid);
	
}

