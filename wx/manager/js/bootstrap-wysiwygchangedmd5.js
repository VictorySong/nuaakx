/* http://github.com/mindmup/bootstrap-wysiwyg */
/*global jQuery, $, FileReader*/
/*jslint browser:true*/

(function ($) {
	'use strict';
	var readFileIntoDataUrl = function (fileInfo) {
		var loader = $.Deferred(),
			fReader = new FileReader();
		fReader.onload = function (e) {
			loader.resolve(e.target.result);
		};
		fReader.onerror = loader.reject;
		fReader.onprogress = loader.notify;
		fReader.readAsDataURL(fileInfo);
		return loader.promise();
	};
	$.fn.cleanHtml = function () {
		var html = $(this).html();
		return html && html.replace(/(<br>|\s|<div><br><\/div>|&nbsp;)*$/, '');
	};
	$.fn.wysiwyg = function (userOptions) {
		var editor = this,
			selectedRange,
			options,
			toolbarBtnSelector,
			updateToolbar = function () {
				if (options.activeToolbarClass) {
					$(options.toolbarSelector).find(toolbarBtnSelector).each(function () {
						var command = $(this).data(options.commandRole);
						if (document.queryCommandState(command)) {
							$(this).addClass(options.activeToolbarClass);
						} else {
							$(this).removeClass(options.activeToolbarClass);
						}
					});
				}
			},
			execCommand = function (commandWithArgs, valueArg) {
				var commandArr = commandWithArgs.split(' '),
					command = commandArr.shift(),
					args = commandArr.join(' ') + (valueArg || '');
				document.execCommand(command, 0, args);
				updateToolbar();
			},
			bindHotkeys = function (hotKeys) {
				$.each(hotKeys, function (hotkey, command) {
					editor.keydown(hotkey, function (e) {
						if (editor.attr('contenteditable') && editor.is(':visible')) {
							e.preventDefault();
							e.stopPropagation();
							execCommand(command);
						}
					}).keyup(hotkey, function (e) {
						if (editor.attr('contenteditable') && editor.is(':visible')) {
							e.preventDefault();
							e.stopPropagation();
						}
					});
				});
			},
			getCurrentRange = function () {
				var sel = window.getSelection();
				if (sel.getRangeAt && sel.rangeCount) {
					return sel.getRangeAt(0);
				}
			},
			saveSelection = function () {
				selectedRange = getCurrentRange();
			},
			restoreSelection = function () {
				var selection = window.getSelection();
				if (selectedRange) {
					try {
						selection.removeAllRanges();
					} catch (ex) {
						document.body.createTextRange().select();
						document.selection.empty();
					}

					selection.addRange(selectedRange);
				}
			},
			insertFiles = function (files) {
				editor.focus();
				$.each(files, function (idx, fileInfo) {
					if (/^image\//.test(fileInfo.type)) {
						//以下限制为宋胜利新增    解决图片太大上传的压缩问题 
						var size=fileInfo.size;
						//记录大小
						console.log(size);
						var target=60*1024;
						
						if(target<size && size<0.5*1024*1024)
						{
							//处理小于1m 且比目标大小大的照片
							$.when(readFileIntoDataUrl(fileInfo)).done(function (dataUrl) {
								var img = new Image();
								img.src=dataUrl;
								img.onload=function(){
								
									var width=img.width;
									var height=img.height;
									var tarwidth;
									if(width<height)
										tarwidth=100;
									else
										tarwidth=width*100/height;
									
									var ocanvas = document.createElement("canvas");
									
									ocanvas.width=tarwidth;
									ocanvas.height=height*tarwidth/width;
									img.width=ocanvas.width;
									img.height=ocanvas.height;
									
									var ctx=ocanvas.getContext("2d");
									//ctx.scale(tarwidth/width,tarwidth/width);
									ctx.drawImage(img,0,0,tarwidth,height*tarwidth/width);
									
									var rate=target/size;
									var newdataUrl=ocanvas.toDataURL("image/png",1);
									//将图片上传 由服务器端保存并返回一固定url
									$.post("base64filesolve.php",{url:newdataUrl.split(",")[1],originalurl: dataUrl.split(",")[1]}).done(function(data){
										console.log(data);
										try{
											var da=JSON.parse(data);
										}
										catch(e){
											console.log(e);
											return ;
										}
										var html='<img src="'+da["url"]+'" originalurl="'+da["originalurl"]+'">';
										console.log(html);
										document.execCommand('insertHTML',0, html);
										//为图像添加点击放大
										try{
											originalimage();
										}catch(e){
											console.log(e);
										}
									});
										
								}
							}).fail(function (e) {
								options.fileUploadError("file-reader", e);
							});
						}
						else if(target>size || target==size)
						{
							//处理比目标大小小的照片
							$.when(readFileIntoDataUrl(fileInfo)).done(function (dataUrl) {
								
								var img = new Image();
								img.src=dataUrl;
								img.onload=function(){
								
									var width=img.width;
									var height=img.height;
									var tarwidth;
									if(width<height)
										tarwidth=100;
									else
										tarwidth=width*100/height;
									
									var ocanvas = document.createElement("canvas");
									
									
									ocanvas.width=tarwidth;
									ocanvas.height=height * tarwidth / width;
									img.width=ocanvas.width;
									img.height=ocanvas.height;
									
									var ctx=ocanvas.getContext("2d");
									
									ctx.drawImage(img,0,0,tarwidth,height * tarwidth / width);
									
									
									var newdataUrl=ocanvas.toDataURL("image/png",1);
									console.log(newdataUrl);
									//将图片上传 由服务器端保存并返回一固定url
									$.post("base64filesolve.php",{url:newdataUrl.split(",")[1],originalurl: dataUrl.split(",")[1]}).done(function(data){
										console.log(data);
										try{
											var da=JSON.parse(data);
										}
										catch(e){
											console.log(e);
											return ;
										}
										var html='<img src="'+da["url"]+'" originalurl="'+da["originalurl"]+'">';
										console.log(html);
										document.execCommand('insertHTML',0, html);
										//为图像添加点击放大
										try{
											originalimage();
										}catch(e){
											console.log(e);
										}
									});
								}
							}).fail(function (e) {
								options.fileUploadError("file-reader", e);
							});
						}
						else{
							//处理大于2m的照片
							$.when(readFileIntoDataUrl(fileInfo)).done(function (dataUrl) {
								
								var img = new Image();
								img.src=dataUrl;
									
								img.onload=function(){
									var width=img.width;
									var height=img.height;
									var json={};
									var tarwidth;
									//小图
									if(width<height)
										tarwidth=100;
									else
										tarwidth=width*100/height;
									var ocanvas = document.createElement("canvas");
									ocanvas.width=tarwidth;
									ocanvas.height=height * tarwidth / width;

									var ctx=ocanvas.getContext("2d");

									//计算需要分成多少块
									var part=Math.ceil(size/1/1024/1024);
									console.log(part);
									//计算每一块的高
									var partheight=height/part;
									console.log(partheight);
									//尺寸比率
									var ratew=tarwidth/width;
									console.log(ratew);
									console.log(ratew*partheight);
									//循环添加图片块
									for(var i=0;i<part; i++)
									{
										ctx.drawImage(img,0,partheight*i,width,partheight,0,partheight*i*ratew,tarwidth,partheight*ratew);
									}

									json["url"]=ocanvas.toDataURL("image/png",1).split(",")[1];
									
									//大图
									tarwidth=450;

									ocanvas = document.createElement("canvas");

									console.log(tarwidth);
									ocanvas.width=tarwidth;
									ocanvas.height=height * tarwidth / width;
									ctx=ocanvas.getContext("2d");
							
									//计算需要分成多少块
									part=Math.ceil(size/1/1024/1024);
									console.log(part);
									//计算每一块的高
									partheight=height/part;
									console.log(partheight);
									//尺寸比率
									ratew=tarwidth/width;
									console.log(ratew);
									console.log(ratew*partheight);
									//循环添加图片块
									for(var i=0;i<part; i++)
									{
										ctx.drawImage(img,0,partheight*i,width,partheight,0,partheight*i*ratew,tarwidth,partheight*ratew);
										
									}
									json["originalurl"]=ocanvas.toDataURL("image/png",0.3).split(",")[1];
									
									
									//将图片上传 由服务器端保存并返回一固定url
									$.post("base64filesolve.php",json).done(function(data){
										console.log(data);
										try{
											var da=JSON.parse(data);
										}
										catch(e){
											console.log(e);
											return ;
										}
										var html='<img src="'+da["url"]+'" originalurl="'+da["originalurl"]+'">';
										console.log(html);
										document.execCommand('insertHTML',0, html);
										//为图像添加点击放大
										try{
											originalimage();
										}catch(e){
											console.log(e);
										}
									});
								}
							}).fail(function (e) {
								options.fileUploadError("file-reader", e);
							});
						}
						
					
						return;
						//////////////////////////////////////////////////
						
						//以下为原版
						$.when(readFileIntoDataUrl(fileInfo)).done(function (dataUrl) {
							execCommand('insertimage', dataUrl);
						}).fail(function (e) {
							options.fileUploadError("file-reader", e);
						});
					} else {
						options.fileUploadError("unsupported-file-type", fileInfo.type);
					}
				});
			},
			markSelection = function (input, color) {
				restoreSelection();
				if (document.queryCommandSupported('hiliteColor')) {
					document.execCommand('hiliteColor', 0, color || 'transparent');
				}
				saveSelection();
				input.data(options.selectionMarker, color);
			},
			bindToolbar = function (toolbar, options) {
				toolbar.find(toolbarBtnSelector).click(function () {
					restoreSelection();
					editor.focus();
					execCommand($(this).data(options.commandRole));
					saveSelection();
				});
				toolbar.find('[data-toggle=dropdown]').click(restoreSelection);

				toolbar.find('input[type=text][data-' + options.commandRole + ']').on('webkitspeechchange change', function () {
					var newValue = this.value; /* ugly but prevents fake double-calls due to selection restoration */
					this.value = '';
					restoreSelection();
					if (newValue) {
						editor.focus();
						execCommand($(this).data(options.commandRole), newValue);
					}
					saveSelection();
				}).on('focus', function () {
					var input = $(this);
					if (!input.data(options.selectionMarker)) {
						markSelection(input, options.selectionColor);
						input.focus();
					}
				}).on('blur', function () {
					var input = $(this);
					if (input.data(options.selectionMarker)) {
						markSelection(input, false);
					}
				});
				toolbar.find('input[type=file][data-' + options.commandRole + ']').change(function () {
					restoreSelection();
					if (this.type === 'file' && this.files && this.files.length > 0) {
						insertFiles(this.files);
					}
					saveSelection();
					this.value = '';
				});
			},
			initFileDrops = function () {
				editor.on('dragenter dragover', false)
					.on('drop', function (e) {
						var dataTransfer = e.originalEvent.dataTransfer;
						e.stopPropagation();
						e.preventDefault();
						if (dataTransfer && dataTransfer.files && dataTransfer.files.length > 0) {
							insertFiles(dataTransfer.files);
						}
					});
			};
		options = $.extend({}, $.fn.wysiwyg.defaults, userOptions);
		toolbarBtnSelector = 'a[data-' + options.commandRole + '],button[data-' + options.commandRole + '],input[type=button][data-' + options.commandRole + ']';
		bindHotkeys(options.hotKeys);
		if (options.dragAndDropImages) {
			initFileDrops();
		}
		bindToolbar($(options.toolbarSelector), options);
		editor.attr('contenteditable', true)
			.on('mouseup keyup mouseout', function () {
				saveSelection();
				updateToolbar();
			});
		$(window).bind('touchend', function (e) {
			var isInside = (editor.is(e.target) || editor.has(e.target).length > 0),
				currentRange = getCurrentRange(),
				clear = currentRange && (currentRange.startContainer === currentRange.endContainer && currentRange.startOffset === currentRange.endOffset);
			if (!clear || isInside) {
				saveSelection();
				updateToolbar();
			}
		});
		return this;
	};
	$.fn.wysiwyg.defaults = {
		hotKeys: {
			'ctrl+b meta+b': 'bold',
			'ctrl+i meta+i': 'italic',
			'ctrl+u meta+u': 'underline',
			'ctrl+z meta+z': 'undo',
			'ctrl+y meta+y meta+shift+z': 'redo',
			'ctrl+l meta+l': 'justifyleft',
			'ctrl+r meta+r': 'justifyright',
			'ctrl+e meta+e': 'justifycenter',
			'ctrl+j meta+j': 'justifyfull',
			'shift+tab': 'outdent',
			'tab': 'indent'
		},
		toolbarSelector: '[data-role=editor-toolbar]',
		commandRole: 'edit',
		activeToolbarClass: 'btn-info',
		selectionMarker: 'edit-focus-marker',
		selectionColor: 'darkgrey',
		dragAndDropImages: true,
		fileUploadError: function (reason, detail) { console.log("File upload error", reason, detail); }
	};
}(window.jQuery));
