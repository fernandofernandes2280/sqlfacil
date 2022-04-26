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
	            'titulo'=>'CREATE DATABASE',
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
	            'titulo'=> 'SHOW DATABASE',
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
	            'titulo'=> 'USE DATABASE',
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
	            'titulo'=> 'CRIANDO tabelas (CREATE TABLE)',
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
	            'titulo'=> 'Comando SHOW TABLES',
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
	            'titulo'=> 'Comando SHOW COLUMNS',
	            'descricao' => View::render('pages/tutorial/comandosSql/showcolumns',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/show-columns.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'showcolumns', '');
	    
	}
	//retorna o conteudo (view) Tutoral Alter Table
	public static function getAlterTable($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'Comando ALTER TABLE',
	            'descricao' => View::render('pages/tutorial/comandosSql/altertable',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/alter-table.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'altertable', '');
	    
	}
	
	//retorna o conteudo (view) Tutoral Restricoes
	public static function getRestricoes($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'Restrições (Constraints)',
	            'descricao' => View::render('pages/tutorial/comandosSql/restricoes',[]),
	            'link' =>'https://dev.mysql.com/doc/search/?d=12&p=1&q=constraints'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'restricoes', '');
	    
	}
	//retorna o conteudo (view) Insert
	public static function getInsert($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'INSERINDO registros (INSERT INTO)',
	            'descricao' => View::render('pages/tutorial/comandosSql/insert',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/insert.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'insert', '');
	    
	}
	
	//retorna o conteudo (view) getSelect
	public static function getSelect($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'Comando SELECT',
	            'descricao' => View::render('pages/tutorial/comandosSql/select',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/select.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'select', '');
	    
	}
	
	//retorna o conteudo (view) Orderby
	public static function getOrderby($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'ORDENANDO os registros de uma CONSULTA (ORDER BY)',
	            'descricao' => View::render('pages/tutorial/comandosSql/orderby',[]),
	            'link' =>'https://dev.mysql.com/doc/internals/en/optimizer-order-by-clauses.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'orderby', '');
	    
	}
	//retorna o conteudo (view) Update
	public static function getUpdate($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'Comando UPDATE',
	            'descricao' => View::render('pages/tutorial/comandosSql/update',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/update.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'update', '');
	    
	}
	
	//retorna o conteudo (view) Delete
	public static function getDelete($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'DELETANDO/EXCLUINDO registros (DELETE)',
	            'descricao' => View::render('pages/tutorial/comandosSql/delete',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/delete.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'delete', '');
	    
	}
	
	//retorna o conteudo (view) DropTable
	public static function getDropTable($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'Remover tabelas (DROP TABLE)',
	            'descricao' => View::render('pages/tutorial/comandosSql/droptable',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/drop-table.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'droptable', '');
	    
	}
	
	
	//retorna o conteudo (view) Truncate Table
	public static function getTruncateTable($request){
	    //View da
	    $content = View::render('pages/tutorial/index',[
	        
	        'comandosSql' => View::render('pages/tutorial/comandosSql/index',[
	            'titulo'=> 'TRUNCATE TABLE',
	            'descricao' => View::render('pages/tutorial/comandosSql/truncatetable',[]),
	            'link' =>'https://dev.mysql.com/doc/refman/5.7/en/truncate-table.html'
	        ]),
	        'treineSql' => ''
	    ]);
	    
	    //Retorna a página completa
	    return parent:: getPanel(  'SqlFácil > Tutorial', $content,'truncatetable', '');
	    
	}
	
}