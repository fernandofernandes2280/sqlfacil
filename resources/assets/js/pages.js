

$(document).ready(function() {
	

	//Codigo ajax requisição MVC
	$("body").on("click", "[data-action]", function(e){
		e.preventDefault();
		var data = $(this).data();
		
		
		$.post(data.action,data,function(id){
			
			alert(id);
		
			
			
		},"json").fail(function(){
			console.log("erro");
		});
	});
	
	




	
	
	
	})










