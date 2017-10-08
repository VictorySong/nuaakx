function onfocus_(th){
	document.getElementById(th.id+'i').style.visibility="hidden";
}
function onblur_phone(th){
	var patrn=/^1\d\d\d\d\d\d\d\d\d\d/; 
	if(!patrn.exec(th.value))
		document.getElementById(th.id+'i').style.visibility="visible";
	else{
		phone=th.value;
	}
}
function onblur_im_code(th){
	th_im_code=th;
	if(xmlHttp==null)
	{
		alert("Browser does not support http request");
		return 0;
	}
	var url="im_code_check.php";
	xmlHttp.onreadystatechange=onblur_im_code_;
	xmlHttp.open("post" ,url,true);
	xmlHttp.send(th.value);
}
function onblur_im_code_()
{
	if(xmlHttp.readyState=="4"|| xmlHttp.readyState=="complete")
	{
		if(xmlHttp.responseText=='1')
		{
			im_code=true;
			document.getElementById('sms_submit').onclick=function(){send_sms();};
		}
		else
		{
			document.getElementById(th_im_code.id+'i').style.visibility="visible";
			document.getElementById("catch_img").src='im_code.php?code='+Math.random();
		}
	}
}
function send_sms(){
	onblur_phone(document.getElementById("phone"));
	if(!phone)
	{
		document.getElementById("phonei").style.visibility="visible";
		im_code=false;
		document.getElementById("catch_img").src='im_code.php?code='+Math.random();
	}
	else if(im_code)
	{
		var url="sendsms.php";
		var str={"phone":"","im_code":""};
		str.phone=phone;
		str.im_code=document.getElementById("im_code").value;
		xmlHttp.onreadystatechange=send_sms_;
		xmlHttp.open("post",url,true);
		xmlHttp.send(JSON.stringify(str));
	}
}
function send_sms_(){
	if(xmlHttp.readyState=="4"|| xmlHttp.readyState=="complete")
	{
		if(xmlHttp.responseText=='1')
		{
			document.getElementById('sms_submit').onclick=function(){};
			document.getElementById('sms_submit').style.backgroundColor="rgb(102, 102, 102)";
			time=600;
			inte=self.setInterval("submit_font_change()",1000);
			
		}
		else if(xmlHttp.responseText.length>5){
			var str=JSON.parse(xmlHttp.responseText);
			time=str.time;
			inte=self.setInterval("submit_font_change()",1000);
			document.getElementById('sms_submit').style.backgroundColor="rgb(102, 102, 102)";
		}
	}
}
function submit_font_change(){
	document.getElementById('sms_submit').innerHTML="重新("+time+")";
	time--;
	if(time==0)
	{
		window.clearInterval(inte);
		document.getElementById('sms_submit').onclick=function(){send_sms();};
		document.getElementById('sms_submit').innerHTML="发送";
		document.getElementById('sms_submit').style.backgroundColor="";
	}
}