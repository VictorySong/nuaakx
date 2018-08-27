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
	});
	
	});					
						
				
	
	
