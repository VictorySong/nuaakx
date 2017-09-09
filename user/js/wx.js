$(document).ready(function(){
	wx.ready(function(){
		//分享到qq
		wx.onMenuShareQQ({
			title: '我爱你', // 分享标题
			desc: '哦，这样啊', // 分享描述
			link: 'http://nuaakx.com', // 分享链接
			imgUrl: 'http://nuaakx.com/ftp/img/0.jpg', // 分享图标
			success: function () { 
			   console.log("success");
			},
			cancel: function () { 
			   console.log("fail");
			}
		});
		//分享到朋友圈
		wx.onMenuShareTimeline({
			title: '我爱你', // 分享标题
			
			link: 'http://nuaakx.com', // 分享链接
			imgUrl: 'http://nuaakx.com/ftp/img/0.jpg', // 分享图标
			success: function () { 
			   console.log("success");
			},
			cancel: function () { 
			   console.log("fail");
			}
		});
		//分享给朋友
		wx.onMenuShareAppMessage({
			title: '我爱你', // 分享标题
			desc: '哦，这样啊', // 分享描述
			link: 'http://nuaakx.com', // 分享链接
			imgUrl: 'http://nuaakx.com/ftp/img/0.jpg', // 分享图标
			success: function () { 
			   console.log("success");
			},
			cancel: function () { 
			   console.log("fail");
			}
		});
		
		
	});
});