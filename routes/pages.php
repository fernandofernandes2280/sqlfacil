<?php


use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Tutorial;

//ROTA HOME
$obRouter->get('',[
		
		function (){
			return new Response(200, Pages\Home::getHome());
		}
		]);






//ROTA SOBRE
$obRouter->get('/sobre',[
		function (){
			return new Response(200, Pages\About::getAbout());
		}
		]);


//ROTA depoimentos (Insert)
$obRouter->post('/depoimentos',[
		function ($request){
		
			return new Response(200, Pages\Testimony::insertTestimony($request));
		}
		]);
