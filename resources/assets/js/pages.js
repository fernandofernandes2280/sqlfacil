

$(document).ready(function() {
	

	//Codigo ajax requisição MVC
	$("body").on("click", "[data-action]", function(e){
		e.preventDefault();
		var data = $(this).data();
		
		
		$.post(data.action,data,function(name){
			
			alert(name);
		
			
			
		},"json").fail(function(){
			console.log("erro");
		});
	});
	
	
	})










