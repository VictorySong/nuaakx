$(document).ready(function(){
	wx.ready(function(){
		wx.onMenuShareQQ({
			title: '我爱你', // 分享标题
			desc: '哦，这样啊', // 分享描述
			link: 'www.baidu.com', // 分享链接
			imgUrl: '', // 分享图标
			success: function () { 
			   console.log("success");
			},
			cancel: function () { 
			   console.log("fail");
			}
		});
		
	});
});