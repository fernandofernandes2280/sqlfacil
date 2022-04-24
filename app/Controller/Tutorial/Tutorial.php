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
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
            'descricao' => View::render('pages/tutorial/comandosSql/createdatabase',[]),
            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/create-database.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'createdatabase', '');
	    
	}
	
	//retorna o conteudo (view) Tutoral ShOW Database
	public static function getShowDatabases($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
            'descricao' => View::render('pages/tutorial/comandosSql/showdatabases',[]),
            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/show-databases.html'
            ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'showdatabases', '');
	    
	}
	//retorna o conteudo (view) Tutoral USE DATABASE
	public static function getUseDatabase($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
            'descricao' => View::render('pages/tutorial/comandosSql/usedatabase',[]),
            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/database-use.html' 
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'usedatabase', '');
	    
	}
	//retorna o conteudo (view) Tutoral CREATE TABLE
	public static function getCreateTable($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
            'descricao' => View::render('pages/tutorial/comandosSql/createtable',[]),
            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/create-table.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'createtable', '');
	    
	}
	//retorna o conteudo (view) Tutoral ShowTables
	public static function getShowTables($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'descricao' => View::render('pages/tutorial/comandosSql/showtables',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/show-tables.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'showtables', '');
	    
	}
	//retorna o conteudo (view) Tutoral ShowTables
	public static function getShowColumns($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'descricao' => View::render('pages/tutorial/comandosSql/showcolumns',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/show-columns.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'showcolumns', '');
	    
	}
	
	
}