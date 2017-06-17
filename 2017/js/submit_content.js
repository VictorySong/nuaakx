//此函数用于 循环取出input的值并填在content（标志网页内容的一个变量json格式） 中，以便提交。
nomistake=true;
function submit_content(o){
	var t=0;
	if(typeof(o)=="object")
	{
		for(var p in o)
		{
			if(p=="name"||p=="value"||p=="type")
			{
				t++;
			}
		}
		if(t==3)
		{
			switch(o['type'])
			{
				case "radio":
				{
					
					var obj=document.getElementsByName(o['name']);
					var value_obj={};
					for(var p=0;p<obj.length;p++)
					{
						if(obj[p].checked==true)
							value_obj[p]="1";
						else
							value_obj[p]="0";
					}
					o['value'][0]=value_obj;
				}
				break;
				case "text":
				{
					
					var obj=document.getElementsByName(o['name']);
					//前端判断
					if(o['name'].slice(0,-1)=="st_id" && o['must']==1 && (obj[0].value.length<9 || obj[0].value.length>11))
					{
						document.getElementById(o['name']+"i").style.visibility="visible";
						nomistake=false;
						return ;
					}
					o['value']=obj[0].value;
				}
				break;
				case "checkbox":
				{
					var times=0;
					var obj=document.getElementsByName(o['name']);
					var value_obj={};
					for(var p=0;p<obj.length;p++)
					{
						if(obj[p].checked==true)
						{
							value_obj[p]="1";
							times++;
						}
						else
							value_obj[p]="0";
					}
					if(o['times']<times)
					{
						alert("最多可选"+o['times']+"项");
						return 0;
					}
					o['value'][0]=value_obj;
					
				}
				break;
				case "textarea":
				{
					var obj=document.getElementsByName(o['name']);
					o['value']=obj[0].value;
				}
				break;
			}
		}
		else{
			for(var p in o)
			{
				submit_content(o[p]);
			}
		}
	}
	else{
		return 0;
	}
}
//此函数用于正式的提交
function s_content(){
	nomistake=true;
	submit_content(content);
	if(!nomistake)
		return 0;
	 xmlhttp=GetXmlHttpObject();
	var url="applysubmit.php"
	xmlhttp.onreadystatechange=s_content_;
	xmlhttp.open("post",url,true);
	xmlhttp.send(JSON.stringify(content));
}
function s_content_(){
	if(xmlhttp.readyState=="4"||xmlhttp.readyState=="complete")
	{
		if(xmlhttp.responseText=="1")
		{
			document.getElementById("submit").innerHTML="已提交";
			document.getElementById("submit").onclick=function(){};
		}
		else{
			document.getElementById(xmlhttp.responseText+"i").style.visibility="visible";
		}
	}
}