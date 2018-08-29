//全局变量
var ctx = document.getElementById("myChart");
var linedata = new Array(150);
var pulse = 70;
var dada = 1500;	//测试心电图折线的实现
var time = 0;	//用作clock函数的分频变量，6*500ms

//心电图初始化
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
        datasets : [{	
			label: '心电图',
			backgroundColor: [
                'rgba(255, 99, 132, 0.6)',             
            ],
			data : linedata,
			pointRadius:0
		}]
    }	
});

$(document).ready(function(){

//开始测试
$("#button").click(function(){int = setInterval("clock()",500)});

});	

function clock()
{	
	var i;
	
	//测试心跳的渐入减出效果
	$("#pulsespan").fadeOut("slow",function(){
		$("#pulsespan").text(" "+ pulse++);
		$("#pulsespan").fadeIn("slow");
	});
	
/*	//用get获取数据begin
	$.get("get.php").done(function(data){
		console.log(data);
		try{
			var da=JSON.parse(data);
		}
		catch(e){
			setTimeout(function(){document.location.href="../Wbeat.html"},1000);
			setTimeout(function(){location.reload();},3000);//解决uc浏览器登陆后返回历史记录的问题页面不刷新的问题
			return ;
		}
		
		if(da["error"]==0)
		{
			linedata[0] = da[data][num];
			if(da[data][vue] != 0) {
				pulse = da[data][vue];	//对接数据表
				$("#pulsespan").fadeOut("slow",function(){
				$("#pulsespan").text(" "+ pulse);
				$("#pulsespan").fadeIn("slow");
				});
			}
			for(i= 0 + time*25 ;i< 25;i++){
				linedata[i] = da[data][num];
				//对接数据表
			}			
		}		
	});	
*/	//用get获取数据end

	time++;
	if(time > 6){
	time = 0;
	
	//测试心电图折线的实现(6*500ms更新一次)begin	
	var j = 1;
	for(i=149;i>=5;i--){
		linedata[i] = linedata[i-5];
		}	
	if(dada >= 3500) j = 0;
	if(dada <= 1500) j = 1;
	linedata[4] = j?dada++:dada--;
	linedata[3] = j?dada++:dada--;
	linedata[2] = j?dada++:dada--;
	linedata[1] = j?dada++:dada--;
	linedata[0] = j?dada++:dada--;
	//测试心电图折线的实现(6*500ms更新一次)end
	
	myChart.update();
/*	var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
        datasets : [{	
			label: '心电图',
			backgroundColor: [
                'rgba(255, 99, 132, 0.6)',             
            ],
			data : linedata,
			pointRadius:0
		}]
    }	
	});
*/	
	} //if(time> 6)的括号
}