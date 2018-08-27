$(document).ready(function(){
   

	$("#post").find("form").submit(function(e){
		e.preventDefault();
		var json={};
		var input=$(this).find("input");
		json["number"]=input.val();
		console.log(json);
		
		
		$.post("post.php",json).done(function(data){
			console.log(data);
			try{
				var da=JSON.parse(data);
			}
			catch(e)
			{
				console.log(e);
				return;
			}
			if(da["error"]==0)
			{
				alert("success");
			}
		});
		
		$.post("get.php").done(function(Data){
			console.log(Data);
			try{
				var Da=JSON.parse(Data);
			}
			catch(e)
			{
				console.log(e);
				return;
			}
			if(Da["error"]==0)
			{
				for(var p in Da[data])
				{
					var html=' <div class="panel-heading">\
										<span >'+Da[data][p][num]+'</span>\
									    <span     style="float:right;" >'+Da[data][p][vue]+'</span>\
									</div>';
									
									
					$("#get").append(html);
				}
				
				
				
			}
		});
		
		
		
		
	});
	
	});					
						
				
	
	
