
//用来处理图片点击后看大图的问题
//对passive 的支持
var supportsPassive = false;
try {
  var opts = Object.defineProperty({}, 'passive', {
    get: function() {
      supportsPassive = true;
    }
  });
  window.addEventListener("click", null, opts);
} catch (e) {}

function preventroll(e){
	//e.preventDefault();
	e.stopPropagation();
	
	if(e.touches.length==2)
	{
		
		try{
			if(1)
			{
				
				var x1=e.touches[0].pageX;
				var x2=e.touches[1].pageX;
				var y1=e.touches[0].pageY;
				var y2=e.touches[1].pageY;			
				var x=e.touches[0].pageX-e.touches[1].pageX;
				var y=e.touches[0].pageY-e.touches[1].pageY;
				var next=Math.sqrt(x*x+y*y);
				if(Math.abs(next-predistance)<2)
					return ;
				var rate=next/window.predistance;
				
				window.predistance=next;
				//判断应该移到的位置；
				if(window.staticx==undefined)
				{
					if(Math.abs(x1=window.x1)<2 && Math.abs(y1-window.y1)<2)
					{
						window.staticx=window.x1;
						window.staticy=window.y1;
					}
					else if(Math.abs(x2-window.x2)<2 && Math.abs(y2-window.y2)<2)
					{
						window.staticx=window.x2;
						window.staticy=window.y2;
					}
					else
					{
						window.staticx=(window.x1+window.x2)/2;
						window.staticy=(window.y1+window.y2)/2;
					}
				}
				
				window.imgwidth=window.imgwidth*rate;
				
				if(window.choice)
				{
					window.img.css("width",window.imgwidth+"px");
					window.imgheight=window.imgheight*rate;
				}
				else 
				{
					window.imgheight=window.imgheight*rate;
					window.img.css("height",window.imgheight+"px");
				}
				if(window.imgheight>window.innerHeight)
				{
					window.img.css("margin-top","0px");
					var imgscrolltop=window.img.parent()[0].scrollTop;
					var clienty=window.staticy+imgscrolltop-window.img[0].offsetTop;
					var dy=clienty*rate-clienty;
					window.img.parent()[0].scrollTop=imgscrolltop+dy;
				}
				else
				{
					window.img.css("margin-top",(window.innerHeight-window.imgheight)/2+"px");
				}
				if(window.imgwidth>window.innerWidth)
				{
					window.img.css("margin-left","0px");
					var imgscrollleft=window.img.parent()[0].scrollLeft;
					var clientx=window.staticx+imgscrollleft-window.img[0].offsetLeft;
					var dx=clientx*rate-clientx;
				
					window.img.parent()[0].scrollLeft=imgscrollleft+dx;
				
				}
				else
				{
					window.img.css("margin-left",(window.innerWidth-window.imgwidth)/2+"px");
				}
				
			}
			if(window.twochange==3)
				window.twochange=1;
			else
				window.twochange++;
		}
		catch(e){
			alert(e);
		}
	}
	if(e.touches.length==1)
	{
		var x1=e.touches[0].pageX;
		var y1=e.touches[0].pageY;
		var dx=x1-window.x1;
		var dy=y1-window.y1;
		if(dy<0 && (window.img.parent()[0].scrollTop+window.innerHeight)==window.img[0].clientHeight)
			e.preventDefault();
		if(dy>0 && window.img.parent()[0].scrollTop==0)
			e.preventDefault();
	}
	
	/*最初想自己进行调整 发现 算法所产生效果不是很好
	if(e.touches.length==1 && window.one)
	{
		var nowright=parseFloat(window.img.css("margin-right"));
		var nowbottom=parseFloat(window.img.css("margin-bottom"));
		var nowtop=parseFloat(window.img.css("margin-top"));
		var dx=e.touches[0].pageX-window.prex;
		var dy=e.touches[0].pageY-window.prey;
		
		if( ((window.nowleft>0 || window.nowleft==0) && dx<0 && nowright<0) || (( nowright>0 || nowright==0) && window.nowleft<0 && dx>0) || (nowright<0 && window.nowleft<0))
		{
			window.nowleft=window.nowleft+dx;
			window.img.css("margin-left",window.nowleft+"px");
			window.prex=e.touches[0].pageX;
		}
		if( ((window.nowtop>0 || window.nowtop==0) && dy<0 && nowbottom<0) || ((nowbottom>0 || nowbottom==0) && window.nowtop<0 && dy>0) || (nowbottom<0 && window.nowtop<0))
		{
			window.nowtop=window.nowtop+dy;
			window.img.css("margin-top",window.nowtop+"px");
			window.prey=e.touches[0].pageY;
		}
		
	}*/
		
}
function start(e){
	console.log(window);
	window.one=false;
	window.end=false;
	console.log(e.touches[0].clientX);
	console.log(e.touches[0].screenX);
	console.log(e.touches[0].pageX);
	console.log(window.img[0].offsetLeft);
	console.log(window.img[0].offsetTop);
	console.log(window.img.parent()[0].scrollTop);
	if(e.touches.length==2)
	{
		window.two=true;
		window.twochange=1;
		window.x1=e.touches[0].pageX;
		window.x2=e.touches[1].pageX;
		window.y1=e.touches[0].pageY;
		window.y2=e.touches[1].pageY;
		window.time=0;
		var x=e.touches[0].pageX-e.touches[1].pageX;
		var y=e.touches[0].pageY-e.touches[1].pageY;
		window.distance=Math.sqrt(x*x+y*y);
		window.predistance=window.distance;
	}
	if(e.touches.length==1)
	{
		window.one=true;
		window.x1=e.touches[0].pageX;
		window.y1=e.touches[0].pageY;
	}
	/*最初想自己进行调整 发现 算法所产生效果不是很好。此为单点触控调整图片位置
	if(e.touches.length==1)
	{
		window.one=true;
		console.log(e.touches[0]);
		window.x=e.touches[0].pageX;
		window.y=e.touches[0].pageY;
		window.prex=window.x;
		window.prey=window.y;
		window.nowleft=parseFloat(window.img.css("margin-left"));
		window.nowtop=parseFloat(window.img.css("margin-top"));
	}*/
}
function end(e){
	window.distance=0;
	window.predistance=0;
	window.time=0;
	window.end=true;
	var width=parseFloat(window.img.css("width"));
	var height=parseFloat(window.img.css("height"));
	/*
	if(window.choice)
	{
		if(window.imgwidth>window.innerWidth*1)
		{
			var dx=(window.imgwidth-window.innerWidth*1)/2;
			var dy=(window.imgheight-window.innerWidth*1/window.rate)/2;
			
			window.img.parent()[0].scrollTop=window.img.parent()[0].scrollTop+dy;
			window.img.parent()[0].scrollLeft=window.img.parent()[0].scrollLeft+dx;
			
			window.imgwidth=window.innerWidth*1;
			window.img.css("width",window.imgwidth+"px");
			window.imgheight=window.imgwidth/window.rate;
		}
	}
	else 
	{
		if(window.imgwidth>window.innerWidth*1)
		{
			var dx=(window.imgwidth-window.innerHeight*1*window.rate)/2;
			var dy=(window.imgheight-window.innerHeight*1)/2;
			
			window.img.parent()[0].scrollTop=window.img.parent()[0].scrollTop+dy;
			window.img.parent()[0].scrollLeft=window.img.parent()[0].scrollLeft+dx;
			
			window.imgheight=window.innerHeight*1;
			window.img.css("width",window.imgheight+"px");
			window.imgwidth=window.imgheight*window.rate;
		}
		
	}*/
	
		
}
function originalimage(){
console.log("success");
$("img").off("click",originalimageclick);
$("img").on("click",originalimageclick);
}
function originalimageclick(e){
	document.activeElement.blur();
	e.preventDefault();
	e.stopPropagation();
	if($("#img-current").length>0)
		$("#img-current").remove();
	
	var html="<div id=\"img-current\" style=\"width:100%; background-color:black; top:0; left:0;  position:fixed; z-index:2000; opacity: 80%; overflow:auto;\" ></div>";
	
	$("body").append(html);
	$("#img-current").css("height",window.innerHeight+"px");
	
	var img=document.createElement("img");
	img.src=(($(this).attr("originalurl")==undefined) ? $(this).attr("src"):$(this).attr("originalurl"));
	img.onload=function(){
		
		//$(img).css("max-width","500px");
		//$(img).css("position","absolute");
		window.choice=true;
		
		if(img.width>img.height || img.width==img.height)
			$(img).css("width","100%");
		else if((window.innerWidth/img.width*img.height)<window.innerHeight)
			$(img).css("width","100%");
		else
		{
			$(img).css("height",window.innerHeight+"px");
			window.choice=false;
		}
		window.rate=img.width/img.height;//照片的宽高比
		
		$("#img-current").append(img);
		/*
		//防止默认滚动对效果的影响
		$("body").children().filter(function(){
			return ($(this).attr("id")!="img-current" && $(this).attr("id")!="rootinput" && $(this).attr("id")!="background");
		}).hide();
		*/
		
		//减少掉帧
		window.img=$("#img-current>img");
		var width=parseFloat(window.img.css("width"));
		var height=parseFloat(window.img.css("height"));
		
		//调整所在位置
		window.img.css("margin-left",(window.innerWidth-width)/2+"px");
		window.img.css("margin-top",(window.innerHeight-height)/2+"px");
	
		if(window.choice)
		{
			window.imgwidth=parseFloat(window.img.css("width"));
			window.imgheight=window.imgwidth/window.rate;
		}
		else
		{
			window.imgheight=parseFloat(window.img.css("height"));
			window.imgwidth=window.imgheight*window.rate;
		}
		
		//设置触摸 放大切换等
		$("#img-current>img")[0].addEventListener("touchmove",preventroll, {passive:false} );
		$("#img-current>img")[0].addEventListener("touchstart",start,{passive:false});
		$("#img-current>img")[0].addEventListener("touchend",end,{passive:false});
		
	}
		
		
	$("#img-current").click(function(){
		$(this).remove();
		/*
		$("body").children().filter(function(){
			return ($(this).attr("id")!="img-current" && $(this).attr("id")!="rootinput" && $(this).attr("id")!="background");
		}).show();*/
		
	});
}
originalimage();

	