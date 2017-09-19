$(document).ready(function(){
	//个人信息
	window.inf={};
	userinfget();
	
	//部门
	window.department={};
		window.department["KxXqDm"]="WEB研发部";
		window.department["KxXqChy"]="创意设计部";
		window.department["KxXqTs"]="网络宣传部";
		window.department["KxShwWl"]="外联部";
		window.department["KxShwGl"]="管理部";
		window.department["KxShwYj"]="院校交流部";
		window.department["KxJsJf"]="技术服务部";
		window.department["KxJsDj"]="大疆俱乐部";
		window.department["KxHdKh"]="科创活动部";
		window.department["KxHdKp"]="科技培训部";
	
	//var t=setInterval(getrecruit,20000);
	//添加hash改变监听
	$(window).on("hashchange",function(){
		console.log(location.hash);
		$(location.hash).show();
		getrecruithashfunc();
		$("[cont=\"department\"]").filter(function(){
			
			if(("#"+$(this).attr("id"))==location.hash)
				return 0;
			else
				return 1;
		}).hide();
		$(".control").filter(function(){
			if($(this).attr("href")==location.hash){
				$(this).find("span").removeClass("label-default").addClass("label-success");
				return 0;
			}
			else 
				return 1;
		}).removeClass("label-success").addClass("label-default");
		
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
			$("[cont=\"name\"]").text(window.inf["name"]);
			$("[cont=\"id\"]").text(window.inf["stId"]);
			
			kxjudge();
		}
		
	});
}
function kxjudge(){
	//判断是否是科协的
	$.get("../manager/KxJudge.php?1").done(function(data){
		console.log(data);
		
		try{
			var da=JSON.parse(data);
		}catch(e){
			//获取数据
			getrecruit();
			console.log(e);
			return;
		}
		console.log(da);
		console.log(da["inf"]["tableName"]);
		
		if(data=="")
		{
			//document.location.href="login.html";
		}
		else if(da["inf"]["tableName"]!=undefined && da["inf"]["tableName"].length>0)
		{
			window.inf["tableName"]=da["inf"]["tableName"];
			$("#operation").text("操作者");
		}
		//获取数据
		getrecruit();
	});
}

function funcbound(){
	//确认进场 确认结束 推迟一位
	$("[func=\"confirm\"]").off("click",funcconfirm);
	$("[func=\"end\"]").off("click",funcend);
	$("[func=\"postpone\"]").off("click",funcpostpone);
	
	$("[func=\"confirm\"]").click(funcconfirm);
	$("[func=\"end\"]").click(funcend);
	$("[func=\"postpone\"]").click(funcpostpone);
}
function funcconfirm(){
	var id=$(this).attr("stid");
	var tableName=$(this).attr("tableName");
	window.tem=this;
	$.post("interviewconfirm.php",{id:id,tableName:tableName}).done(function(data){
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
					alert("确认成功");
					$(window.tem).text("面试中");
					$(window.tem).addClass("disabled");
					$(window.tem).off("click",funcconfirm);
				}
				break;
				case "400":{
					alert("已确认");
					$(window.tem).text("面试中");
					$(window.tem).addClass("disabled");
					$(window.tem).off("click",funcconfirm);
				}
				break;
			}
			getrecruit();
		}else{
			alert("出错");
		}
	});
}
function funcend(){
	var id=$(this).attr("stid");
	var tableName=$(this).attr("tableName");
	window.tem=this;
	$.post("interviewend.php",{id:id,tableName:tableName}).done(function(data){
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
					alert("确认成功");
					$(window.tem).text("面试结束");
					$(window.tem).addClass("disabled");
					$(window.tem).off("click",funcend);
					$(window.tem).parent().parent().remove();
				}
				break;
				case "400":{
					alert("已确认");
					$(window.tem).text("面试结束");
					$(window.tem).addClass("disabled");
					$(window.tem).off("click",funcend);
					$(window.tem).parent().parent().remove();
				}
				break;
				
			}
			getrecruit();
		}else{
			alert("出错");
		}
	});
}

function funcpostpone(){
	var id=$(this).attr("stid");
	var tableName=$(this).attr("tableName");
	window.tem=this;
	$.post("interviewpostpone.php",{id:id,tableName:tableName}).done(function(data){
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
					alert("确认成功");
					$(window.tem).text("已推迟");
					$(window.tem).addClass("disabled");
					$(window.tem).off("click",funcpostpone);
				}
				break;
				case "400":{
					alert("已确认");
					$(window.tem).text("已推迟");
					$(window.tem).addClass("disabled");
					$(window.tem).off("click",funcpostpone);
				}
				break;
			}
			getrecruit();
		}else{
			alert("出错");
		}
		
	});
}
function getrecruit(){
	$.post("getrecsign.php",{id:window.inf["stId"]}).done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
			return;
		}
		if(da["error"]==0)
		{
			
			for(var p in da["result"])
			{
				//清除
				$("#"+p).find("tbody>tr").remove();
				var sta;
				var html;
				//对顺序进行重新调整
				da["result"][p]=newsort(da["result"][p]);
				
				if(window.inf["tableName"]!=undefined){
					for(var p1 in da["result"][p]){
						
						sta="等待";
						html="";
						html='<tr>\
						  <td>'+da["result"][p][p1]["number"]+'</td>\
						  <td>'+da["result"][p][p1]["stId"]+'</td>\
						  <td>'+da["result"][p][p1]["name"]+'</td>\
						  <td style="color:#337ab7;" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="status">'+sta+'</td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="confirm" >确认进场</button></td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="end">确认结束</button></td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="postpone">推迟一位</button></td>\
						</tr>';
						if(da["result"][p][p1]["interviewing"]==1 && da["result"][p][p1]["end"]==0){
							sta="面试中";
							 html='<tr>\
						  <td>'+da["result"][p][p1]["number"]+'</td>\
						  <td>'+da["result"][p][p1]["stId"]+'</td>\
						  <td>'+da["result"][p][p1]["name"]+'</td>\
						  <td style="color:#337ab7;">'+sta+'</td>\
						  <td><button type="button" class="btn btn-success btn-sm disabled" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'"  >面试中</button></td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="end">确认结束</button></td>\
						  <td><button type="button" class="btn btn-success btn-sm disabled" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" >无法推迟</button></td>\
						</tr>';
						}
						else if(da["result"][p][p1]["interviewing"]==1 && da["result"][p][p1]["end"]==1){
							sta="面试结束";
							html="";
						}
						else if(da["result"][p][p1]["postpone"]!=0){
							sta="已推迟"+(da["result"][p][p1]["postpone"])+"次";
							html='<tr>\
						  <td>'+da["result"][p][p1]["number"]+'</td>\
						  <td>'+da["result"][p][p1]["stId"]+'</td>\
						  <td>'+da["result"][p][p1]["name"]+'</td>\
						  <td style="color:#337ab7;" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="status">'+sta+'</td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="confirm" >确认进场</button></td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="end">确认结束</button></td>\
						  <td><button type="button" class="btn btn-success btn-sm" stid="'+da["result"][p][p1]["stId"]+'" tableName="'+p+'" func="postpone">推迟一位</button></td>\
						</tr>';
							getpersonstatus(da["result"][p][p1]["stId"],p);
						}
						else{
							getpersonstatus(da["result"][p][p1]["stId"],p);
						}
						
						$("#"+p).find("tbody").append(html);
						//添加点击事件
						funcbound();
						
					}
				}else{
					for(var p1 in da["result"][p]){
						
						sta="等待";
						html="";
						html='<tr>\
						  <td>'+da["result"][p][p1]["number"]+'</td>\
						  <td>'+da["result"][p][p1]["stId"]+'</td>\
						  <td>'+da["result"][p][p1]["name"]+'</td>\
						  <td style="color:#337ab7;">'+sta+'</td>\
						</tr>';
						if(da["result"][p][p1]["interviewing"]==1 && da["result"][p][p1]["end"]==0){
							sta="面试中";
							 html='<tr>\
						  <td>'+da["result"][p][p1]["number"]+'</td>\
						  <td>'+da["result"][p][p1]["stId"]+'</td>\
						  <td>'+da["result"][p][p1]["name"]+'</td>\
						  <td style="color:#337ab7;">'+sta+'</td>\
						  </tr>';
						}
						else if(da["result"][p][p1]["interviewing"]==1 && da["result"][p][p1]["end"]==1){
							sta="面试结束";
							html="";
						}
						else if(da["result"][p][p1]["postpone"]!=0){
							sta="已推迟"+(da["result"][p][p1]["postpone"])+"次";
							html='<tr>\
						  <td>'+da["result"][p][p1]["number"]+'</td>\
						  <td>'+da["result"][p][p1]["stId"]+'</td>\
						  <td>'+da["result"][p][p1]["name"]+'</td>\
						  <td style="color:#337ab7;">'+sta+'</td>\
						  </tr>';
						  getpersonstatus(da["result"][p][p1]["stId"],p);
						}
						else{
							getpersonstatus(da["result"][p][p1]["stId"],p);
						}
						$("#"+p).find("tbody").append(html);
						//添加点击事件
						funcbound();
						
					}
				}
					
			}
		}
	});
}
function getpersonstatus(stid,tableName){
	//只需要获取是否在某一部门面试中的状态
	$.post("intstajudge.php",{stid:stid,tableName:tableName}).done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}catch(e){
			console.log(e);
		return;}
		if(da["error"]==0){
			var sel="[stid=\""+da["stid"]+"\"][tableName=\""+da["tableName"]+"\"][func=\"status\"]";
			var sele="[stid=\""+da["stid"]+"\"][tableName=\""+da["tableName"]+"\"][func=\"confirm\"]";
			$(sel).text(window.department[da["department"]]+"面试中");
			$(sele).off("click",funcconfirm);
			
		}
	});
}
function newsort(a){
	var i=0;
	var j=0;
	var tem;
	while(i<a.length){
		j=0;
		if(a[i]["postpone"]!=0 && a[i]["sort"]==undefined){
			for(j;j<a[i]["postpone"];j++){
				
				if((i+j+1)<a.length){
					tem=a[i+j];
					a[i+j]=a[i+j+1]
					a[i+j+1]=tem;
				}else{
					break;
				}
			}
			a[i+j]["sort"]=1;
		}
		else{
			i++;
		}
	}
	console.log(a);
	return a;
}

function getrecruithashfunc(){
	getrecruit();
}
	