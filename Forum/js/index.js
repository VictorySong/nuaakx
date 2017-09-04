$(document).ready(ready);
//解决搜索后，切换问题
$(window).on("hashchange",function(){
	window.end=false;
	window.p=1;
	window.scrolllis=false;//使暂时失去滚动监听，以防止重复提交
	console.log("改变");
	console.log(Number($.cookie("scrollTop")));
	console.log(Number($.cookie("searchscrollTop")));
	//判断是否有主页浏览记录
	if(Number($.cookie("scrollTop"))>0)
		window.scrto=true;//主页时的scrollTop 
	//判断是否有搜索浏览记录
	if(Number($.cookie("searchscrollTop"))>0)
		window.searchscrto=true;
	scrolltobegin();
});
function ready(){
	window.inf={};//存储登录人信息；
	window.end=false;//用来判断当前获取数据是不是所有数据
	window.p=1;//用来记录当前获取了第几页的数据
	window.scrolllis=true;
	//ajax 提交 loading
	$(document).ajaxStart(function(){
		console.log("start");
		$("#loading").css("height",window.innerHeight+"px");
		$("#loading img").css("width","100%");
		
		$(document).on("touchmove",preventrol);//preventroll 定义在了 imagesong 中
		$("#loading").show();}).ajaxStop(function(){
			console.log("stop");
			setTimeout("$(\"#loading\").hide()",500);
			$(document).off("touchmove",preventrol);//preventroll 定义在了 imagesong 中
		});
	//判断是否有主页浏览记录
	if(Number($.cookie("scrollTop"))>0)
		window.scrto=true;//主页时的scrollTop 
	//判断是否有搜索浏览记录
	if(Number($.cookie("searchscrollTop"))>0)
		window.searchscrto=true;
	
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
		//实现点击后收起
		if(!$(this).hasClass("dropdown"))
			$("#accordion").removeClass("in");
		
	});
	$("#accordion>ul>li>ul>li").click(function(e){
		$("#accordion>ul>li>ul>li").each(function(){
			$(this).removeClass("active");
		});
		$(this).addClass("active");
		e.stopPropagation();
		//实现点击后收起
		$("#accordion").removeClass("in");
		//每次调用请求数据，注意将window.p window.end 初始化
		window.p=1;
		window.end=false;
		//然后重新请求
		ref();
		return false;
	});
	//为所有 href="#" 的a 设置无操作 并设置登录和未登录状态
	//获取用户信息 ，如获取出现问题则跳到登录界面 
	window.inf={};
	$.get("../user/userinf.php").done(function(data){
		
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
	$("#accordion a#logout").click(function(){
		$.get("../user/logout.php").done(function(){
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
	
	//设置点赞
	thumb();
	//设置评论
	//addpostcommentsubmit();//第一种评论表现形式
	
	//设置评论后点击背景返回
	$("#background").css("height",window.innerHeight+"px");
	$("#background").click(function(){
		$("#rootinput").hide();
		$(this).hide();
	});
	
	//请求获取数据  第一种评论表现形式
	/*
	$.post("Postrecord.php",{p:1}).done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			return ;
		}
		for(var p in da)
		{
			var imageurl=[];
			var commentstr="";
			var comment=da[p]["comment"];
			for(var i in comment)
			{
				commentstr+='<div commentid="'+comment[i]["commentid"]+'"><a href="" >'+comment[i]["nickname"]+'</a> <span style="background-color:#e7e7e7;"> '+comment[i]["content"]+'</span></div>';
			}
			commentstr+='<a href=""><div style="text-align:center;">'+( (da[p]["commentnum"]>3) ? ("查看全部评论("+da[p]["commentnum"]+")"):"")+'</div></a>';
			
			if(da[p]["imageurl"])
				imageurl=da[p]["imageurl"].split(",");
			
			var html='<div class="contentp"><div class="content" ><div class="content-table-cell"><span class="avatar glyphicon glyphicon-cloud" cont="avatar"></span></div><div class="content-table-cell"><a>'+da[p]["nickname"]+'</a><p>'+da[p]["description"]+'</p><div class="img" cont="img" ></div>';
				for(var p in imageurl)
				{
					html+='<div><img src="'+imageurl[p]+'"></div>';
				}
				html+='<a href="'+da[p]["url"]+'"><div class="url"><div><span class="glyphicon glyphicon-link" ></span><div>'+(da[p]["title"]==null ? "":da[p]["title"])+'</div></div></div></a><div class="last" postid="'+da[p]["postid"]+'"><span cont="time">'+da[p]["date"].slice(0,10)+'</span><span class="glyphicon glyphicon-pencil" data-toggle="collapse" data-target="#'+da[p]["postid"]+'"></span><span class="glyphicon glyphicon-thumbs-up" cont="thumbs" to="thumbs" alreadythumb="'+da[p]["alreadythumb"]+'" ></span><span class="thumbs" cont="thumbs">'+da[p]["thumbs"]+'</span></div>\
						<div ><form id="'+da[p]["postid"]+'" class="collapse" action="submitPostcomment.php" role="form"><div class="form-group"><textarea class="form-control" style="height:50px; border:0px;" placeholder="内容"></textarea></div><div align="right"><button type="submit" class="btn btn-default" style="border:0px;" ><span class="glyphicon glyphicon-send" style="margin-bottom:1px; margin-right:1px;" ></span></button> </div></form></div><div class="comment">'+commentstr+'</div></div></div></div>';
			$("#content").append(html);
			
		}
		thumb();
		addpostcommentsubmit();
	});*/
	//第二种评论表现形式 我比较喜欢这种，也是借鉴qq 的想法 逻辑非常清晰 非常易用
	//ref();
	scrolltobegin();
	//搜索功能
	$("form[cont=\"search\"]").submit(function(e){
		e.preventDefault();
		//下拉框收起
		$(this).parent().removeClass("in");
		var value=$(this).find("input").val();
		var json={};
		if(value=="")
		{
			$(this).find("input").focus();
			return;
		}
		json["description"]=value;
		
		$.cookie("description",json["description"]);
		$.cookie("searchscrollTop",0);
		window.p=1;
		window.end=false;
		if(location.hash!="#search")
			history.pushState(null,null,"#search");
		window.scrolllis=false;//使暂时失去滚动监听，以防止重复提交
		console.log("提交");
		search();		
	});		
		
	//滚动条到底部时刷新
	window.scrollbottom=false;//防止在底部多次刷新
	$(window).scroll(scrolllisten);
	
	
}
//滚动监听函数
function scrolllisten(){
	if(!window.scrolllis)
		return;
	//判断处于哪种状态
	if(location.hash=="#search" && $.cookie("description")!=undefined)
		$.cookie("searchscrollTop",$(window).scrollTop());
	else
		$.cookie("scrollTop",$(window).scrollTop());	
	if(($(window).scrollTop()+window.innerHeight)<($("body")[0].scrollHeight-2))
		window.scrollbottom=false;
	if(($(window).scrollTop()+window.innerHeight)>($("body")[0].scrollHeight-2) && !window.scrollbottom)
	{
		if(location.hash=="#search" && $.cookie("description")!=undefined)
		{
			
			search();
		}
		else{
			ref();
		}
		window.scrollbottom=true;
	}
}
function thumb(){
	//对已点赞的进行 样式改变
	$("span[alreadythumb=\"true\"]").css("color","blue");
	$(".last span[cont=\"thumbs\"]").off("click",thumbclick);
	//设置点赞
	$(".last span[cont=\"thumbs\"]").on("click",thumbclick);
}
function thumbclick(){
		var thumb=$(this).parent().find("[to=\"thumbs\"]");
		if(thumb.attr("alreadythumb")=="false")
		{
			var postid=$(this).parent().attr("postid");
			if(postid!="undefined" || postid!="")
			{
				$.get("Postthumb.php",{"postid":postid}).done(function(data){
					
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
				thumb=$(this).parent().find("[class=\"thumbs\"]");
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
//设置评论提交
function addpostcommentsubmit(){
	$(".contentp form").off("submit",postcommentsubmit);
	$(".contentp form").submit(postcommentsubmit);
}
function postcommentsubmit(e){
	e.preventDefault();
	var that=this;
	var json={};
	var content=$(this).find("textarea");
	json["toid"]=$(this).attr("id");
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
			$(that).parent().parent().find(".comment").append(html);
			$(that).removeClass("in");
		}
	});
}
//////////////////////////////////////

postcs();
function postcs(){
	//绑定一些事件写评论
	$(".last>.glyphicon-pencil").off("click",postcsclick);
	$(".last>.glyphicon-pencil").on("click",postcsclick);
	$(".commentspan").off("click",postcsclick);
	$(".commentspan").on("click",postcsclick);
	//调整所有a 的下划线
	$("a").css("text-decoration","none");
	//调整所有a 的字体颜色
	$(".url").parent().css("color","#333");
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
function ref(){
	var json={p:window.p};
	json["type"]=$("a[cont=\"type\"]").filter(function(){
		return $(this).parent().hasClass("active");}).attr("to");
	console.log(json);
	if(window.end)
	{
		console.log("无更多");
		if($("#nomore").length==0)
		{
			var html='<div id="nomore" class="contentp" style="text-align:center;">无更多</div>';
			$("#content").append(html);
		}
		return ;
	}
	if(window.p==1)
	{
		$(".contentp").remove();
	}
	console.log(window.p);
	$.post("Postrecord.php",json).done(function(data){
		
		try{
			var da=JSON.parse(data);
		}catch(e){
			return ;
		}
		if(da.length==0)
		{
			if(window.p==1)
			{
				var html='<div class="contentp" align="center">无结果</div>';
				$("#content").append(html);
				console.log("无结果");
			}
			window.end=true;
			console.log("无更多");
			if($("#nomore").length==0)
			{
				var html='<div id="nomore" class="contentp" style="text-align:center;">无更多</div>';
				$("#content").append(html);
			}
		}
		else
			window.p++;
		for(var p in da)
		{
			var imageurl=[];
			var commentstr="";
			var comment=da[p]["comment"];
			for(var i in comment)
			{
				commentstr+='<div commentid="'+comment[i]["commentid"]+'"><a href="" >'+comment[i]["nickname"]+'</a> <span class="commentspan" style="background-color:#e7e7e7;" toaction="submitPostcommentresponse.php" toid="'+comment[i]["commentid"]+'"> '+comment[i]["content"]+'</span></div>';
			}
			commentstr+='<a href="'+da[p]["url"]+'"><div style="text-align:center;">'+( (da[p]["commentnum"]>3) ? ("查看全部评论("+da[p]["commentnum"]+")"):"")+'</div></a>';
			
			if(da[p]["imageurl"])
				imageurl=da[p]["imageurl"].split(",");
			
			var html='<div class="contentp"><div class="content" ><div class="content-table-cell"><span class="avatar glyphicon glyphicon-cloud" cont="avatar"></span></div><div class="content-table-cell"><a>'+da[p]["nickname"]+'</a><p>'+da[p]["description"]+'</p><div class="img" cont="img" ></div>';
				for(var p in imageurl)
				{
					html+='<div><img src="'+imageurl[p]+'"></div>';
				}
				if(da[p]["type"]!="simple")
					html+='<a href="'+da[p]["url"]+'"><div class="url"><div><span class="glyphicon glyphicon-link" ></span><div>'+(da[p]["title"]==null ? "":da[p]["title"])+'</div></div></div></a>';
				html+='<div class="last" postid="'+da[p]["postid"]+'"><span cont="time">'+da[p]["date"].slice(0,10)+'</span><span class="glyphicon glyphicon-pencil" toaction="submitPostcomment.php" toid="'+da[p]["postid"]+'"></span><span class="glyphicon glyphicon-thumbs-up" cont="thumbs" to="thumbs" alreadythumb="'+da[p]["alreadythumb"]+'" ></span><span class="thumbs" cont="thumbs">'+da[p]["thumbs"]+'</span></div>\
						<div class="comment">'+commentstr+'</div></div></div></div>';
			$("#content").append(html);
			
		}
		
		window.scrolllis=true;//使其恢复监听
		thumb();
		postcs();
		//if(window.scrto)//其目的是，如果是无浏览位置记录的情况下，获取第一次数据，避免掉入递归 定义scrolltobegin() 后可省略
		scrollto();
	});
}
//设置详情打开新窗口
function detail(){
	window.open($(this).attr("href"));
	return false;
}
//开始获取数据   必不可少，如果这一部分内容加到 scrollto() 中则会出现 刚进入时有可能不获取数据的情况 亦或是可能存在 递归出不来直到所有数据获取 而这不是我想要的
function scrolltobegin(){
	if(location.hash=="#search" && $.cookie("description")!=undefined)
	{
		console.log("开始");
		search();
	}
	else{
		ref();
	}
}
//调整浏览位置
function scrollto()
{
	
	if(location.hash=="#search" && $.cookie("description")!=undefined)
	{
		if(window.searchscrto)
		{
			
			if($("body")[0].offsetHeight>(Number($.cookie("searchscrollTop"))+window.innerHeight))
			{
				console.log("调整到");
				window.scrolllis=false;//使暂时失去滚动监听.防止表单提交
				window.scrollTo(0,Number($.cookie("searchscrollTop")));
				window.scrolllis=true;
				window.searchscrto=false;
			}
			else
			{
				console.log("调整");
				search();
			}
			return ;
		}
		
	}
	else{
		if(window.scrto)
		{
			
			if($("body")[0].offsetHeight>(Number($.cookie("scrollTop"))+window.innerHeight))
			{
				console.log("调整到");
				window.scrolllis=false;//使暂时失去滚动监听.防止表单提交
				window.scrollTo(0,Number($.cookie("scrollTop")));
				window.scrolllis=true;
				window.scrto=false;
			}
			else
			{
				console.log("调整");
				ref();
			}
		}

	}
}
function search(js){
	console.log(window.p);
	//此函数用来搜索，表单提交的关键词 优先级为最高（即传入的参数）；
	var json=$.extend({description:$.cookie("description"),p:window.p},js);
	json["type"]=$("a[cont=\"type\"]").filter(function(){
		return $(this).parent().hasClass("active");}).attr("to");
	console.log(json);
	if(window.end )
	{
		console.log("无更多");
		if($("#nomore").length==0)
		{
			var html='<div id="nomore" class="contentp" style="text-align:center;">无更多</div>';
			$("#content").append(html);
		}
		return ;
	}
	if(window.p==1)
	{
		$(".contentp").remove();
	}
	
	$.post("SearchPost.php", json).done(function(data){
		
		
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			
			return ;
		}
		if(da.length>0)
		{
			window.p++;
			for(var p in da)
			{
				var imageurl=[];
				var commentstr="";
				var comment=da[p]["comment"];
				for(var i in comment)
				{
					commentstr+='<div commentid="'+comment[i]["commentid"]+'"><a href="" >'+comment[i]["nickname"]+'</a> <span class="commentspan" style="background-color:#e7e7e7;" toaction="submitPostcommentresponse.php" toid="'+comment[i]["commentid"]+'"> '+comment[i]["content"]+'</span></div>';
				}
				commentstr+='<a href="'+da[p]["url"]+'"><div style="text-align:center;">'+( (da[p]["commentnum"]>3) ? ("查看全部评论("+da[p]["commentnum"]+")"):"")+'</div></a>';
				
				if(da[p]["imageurl"])
					imageurl=da[p]["imageurl"].split(",");
				
				var html='<div class="contentp"><div class="content" ><div class="content-table-cell"><span class="avatar glyphicon glyphicon-cloud" cont="avatar"></span></div><div class="content-table-cell"><a>'+da[p]["nickname"]+'</a><p>'+da[p]["description"]+'</p><div class="img" cont="img" ></div>';
					for(var p in imageurl)
					{
						html+='<div><img src="'+imageurl[p]+'"></div>';
					}
					if(da[p]["type"]!="simple")
						html+='<a href="'+da[p]["url"]+'"><div class="url"><div><span class="glyphicon glyphicon-link" ></span><div>'+(da[p]["title"]==null ? "":da[p]["title"])+'</div></div></div></a>';
					html+='<div class="last" postid="'+da[p]["postid"]+'"><span cont="time">'+da[p]["date"].slice(0,10)+'</span><span class="glyphicon glyphicon-pencil" toaction="submitPostcomment.php" toid="'+da[p]["postid"]+'"></span><span class="glyphicon glyphicon-thumbs-up" cont="thumbs" to="thumbs" alreadythumb="'+da[p]["alreadythumb"]+'" ></span><span class="thumbs" cont="thumbs">'+da[p]["thumbs"]+'</span></div>\
							<div class="comment">'+commentstr+'</div></div></div></div>';
				$("#content").append(html);
				
			}
			
			thumb();
			postcs();
			window.scrolllis=true;//使其恢复监听
			//if(window.searchscrto)//其目的是，如果是无浏览位置记录的情况下，获取第一次数据，避免掉入递归  定义scrolltobegin() 后可省略
			scrollto();
		}
		else if(window.p==1)
		{
			var html='<div class="contentp" align="center">无结果</div>';
			$("#content").append(html);
			console.log("无结果");
			window.end=true;
			console.log("无更多");
			if($("#nomore").length==0)
			{
				var html='<div id="nomore" class="contentp" style="text-align:center;">无更多</div>';
				$("#content").append(html);
			}
		}
		else
		{
			window.end=true;
			console.log("无更多");
			if($("#nomore").length==0)
			{
				var html='<div id="nomore" class="contentp" style="text-align:center;">无更多</div>';
				$("#content").append(html);
			}
		}
	});
}
function loading(){
	console.log("loading");
	var html="<div id=\"loading\" style=\"width:100%; background-color:black; top:0; left:0;  position:fixed; z-index:2000; opacity: 80%; overflow:auto; display:table;\" align=\"center\" ><div style=\"display:table-cell; vertical-align:middle;\"></div></div>";
	var img=document.createElement("img");
	//img.src="http://static.oschina.net/uploads/img/201409/26073947_j9gz.gif";
	img.src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=1794894692,1423685501&fm=117&gp=0.jpg";
	img.width=50;
	img.height=50;
	img.onload=function(){
		$("#loading>div").append(img);
	}
}
function end(){
	console.log("end");
	$("#loading").remove();
}
function preventrol(e){
	e.preventDefault();
}
	


	
	
