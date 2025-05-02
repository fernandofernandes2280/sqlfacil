<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page{
	
	//retorna o conteudo (view) da nossa home
	public static function getHome(){
	    
	    //View da Sobre
	    $content = View::render('pages/home',[
	        
	   
	        
	        
	    ]);
	    
	    //Retorna a página completa
	    return parent::getPanel('SqlFácil > Home', $content,'home', '');
		
	}
	
}