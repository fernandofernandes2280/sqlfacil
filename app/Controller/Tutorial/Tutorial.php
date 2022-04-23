<?php

namespace App\Controller\Tutorial;

use \App\Utils\View;


class Tutorial extends Page{
	
	//retorna o conteudo (view) da nossa página de sobre
	public static function getTutorial($request){
		//View da 
		$content = View::render('pages/tutorial/index',[
		    
		    'comandosSql' => '',
		    'treineSql' => ''
		]);
		
		//Retorna a página completa
		return parent:: getPanel(  'SqlFácil > Tutorial', $content,'tutorial', '');
		
	}
	
	//retorna o conteudo (view) Tutorial Antes de Começar
	public static function getAntesdeComecar($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/antesdecomecar',[]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'antesdecomecar', '');
	    
	}

	//retorna o conteudo (view) Tutoral O que é Sql
	public static function getOqueeSql($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/oqueesql',[]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'oqueesql', '');
	    
	}
	
	//retorna o conteudo (view) Tutoral Introducao a Banco de Dados
	public static function getIntroducaoaBancodeDados($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/introducaoabancodedados',[]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'introducaoabancodedados', '');
	    
	}
	
	//retorna o conteudo (view) Tutoral Create Database
	public static function getCreateDatabase($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/createdatabase',[]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'createdatabase', '');
	    
	}
	
	//retorna o conteudo (view) Tutoral Create Database
	public static function getShowDatabases($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/showdatabases',[]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'showdatabases', '');
	    
	}
	
	
	
}