teammate=1;
teammate_0=false;
function selected(num){
	document.getElementsByName('1')[(num-1)].checked=true;
	document.getElementById(('1'+num)).className="fa fa-circle fa-fw";
	document.getElementById(('1'+(3-num))).className="fa fa-circle-o fa-fw";
	if(num==2)
	{
		teammate_0=true;
		document.getElementById("add").style.height="0px";
		document.getElementById("add").style.visibility="hidden";
		teammate_change();
		content['kewosi'][4]['must']="";
		content['kewosi'][5]['must']="";
	}
	else{
		document.getElementById("add").style="";
		content['kewosi'][4]['must']="1";
		content['kewosi'][5]['must']="1";
	}
}
function selected1(num){
	document.getElementsByName('2')[(num-1)].checked=true;
	document.getElementById(('2'+num)).className="fa fa-circle fa-fw";
	switch(num)
	{
		case 1:
		{
			document.getElementById('22').className="fa fa-circle-o fa-fw";
			document.getElementById('23').className="fa fa-circle-o fa-fw";
		}
		break;
		case 2:
		{
			document.getElementById('21').className="fa fa-circle-o fa-fw";
			document.getElementById('23').className="fa fa-circle-o fa-fw";
		}
		break;
		case 3:
		{
			document.getElementById('21').className="fa fa-circle-o fa-fw";
			document.getElementById('22').className="fa fa-circle-o fa-fw";
		}
		break;
	}
}
function teammate_change(){
	var teammate_ob=document.getElementsByName("teammate");
	if(teammate_0)
	{
		for(var p=0 ;p<teammate_ob.length;p++)
		{
			teammate_ob[p].style.height="0px";
		}
		teammate_0=false;
		teammate=0;
	}
	else if(teammate<3)
	{
		teammate_ob[teammate].style="";
		if(teammate==2)
		{
			document.getElementById("add").style.height="0px";
			document.getElementById("add").style.visibility="hidden";
		}
		teammate++;
	}
	else{
		alert("最多添加3位队员");
	}
}
		