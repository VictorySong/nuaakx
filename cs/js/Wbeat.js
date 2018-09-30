//全局变量
var ctx = document.getElementById("myChart");
var linedata = new Array(150);
var pulse = 70;
var dada = 1500;	//测试心电图折线的实现
var time = 0;	//用作clock函数的分频变量，6*500ms
var cutout = 0; //用于终止定时器，120*500ms后终止

//心电图初始化
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","",],
		datasets : [{	
			label: '实时心电图 / 3秒更新',
			backgroundColor: ['rgba(255, 99, 132, 0.6)'],
			//borderColor:['rgba(255, 99, 132, 0.6)'],
			data : linedata,
			pointRadius:0,
		}],
    },
	options: {
		scales: {
			yAxes: [{
				ticks: {
					//display:false,
					//beginAtZero:true,
					max:3000,
					min:1000,
				},
				id: 'first-y-axis',
				type: 'linear'
			}]
		}
	}
});

$(document).ready(function(){

//开始测试
$("#button").click(function(){
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
			for(i= 0;i< 150;i++){
				
				if((da.data)[i].vue != 10){
					pulse = (da.data)[i].vue;
					$("#pulsespan").fadeOut("slow",function(){
					$("#pulsespan").text(" "+ pulse);
					$("#pulsespan").fadeIn("slow");
					});
				}			
				linedata[i] = (da.data)[i].num;
				//对接数据表
			}			
		}		
	});	
	myChart.update();
	int = setInterval("clock()",1500)});
});	

function clock()
{	
	cutout++;
	if(cutout >= 80) {
		clearInterval(int);
		return;
	}
	var i;

/*	//测试心跳的渐入减出效果
	$("#pulsespan").fadeOut("slow",function(){
		$("#pulsespan").text(" "+ pulse++);
		$("#pulsespan").fadeIn("slow");
	});
*/	
	//用get获取数据begin
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
			for(i= 0;i< 150;i++){
				
				if((da.data)[i].vue != 10){
					pulse = (da.data)[i].vue;
					$("#pulsespan").fadeOut("slow",function(){
					$("#pulsespan").text(" "+ pulse);
					$("#pulsespan").fadeIn("slow");
					});
				}			
				linedata[i] = (da.data)[i].num;
				//对接数据表
			}			
		}		
	});	
	//用get获取数据end

	time++;
	if(time > 1){
	time = 0;
	
/*	//测试心电图折线的实现(6*500ms更新一次)begin	
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
*/	//测试心电图折线的实现(6*500ms更新一次)end
	
	myChart.update();

	}
}