<?php

namespace App\Controller\Tutorial;

use App\Utils\View;

class Page{
	
	//Módulos disponíveis no painel
	private static $modules = [
		'home' =>[
				'label' => 'Home',
				'link' => URL.'/'
		]
	];

	
	private static $modulesVertical = [
	    'antesdecomecar' =>[
	        'label' => 'Antes de Começar',
	        'link' => URL.'/antesdecomecar',
	        'classe' => '',
	        'icon' => 'noise_control_off'
	    ],
	    'introducaoabancodedados' =>[
	        'label' => 'Introdução a Banco de Dados',
	        'link' => URL.'/introducaoabancodedados',
	        'classe' => '',
	        'icon' => 'noise_control_off'
	    ],
	    'oqueesql' =>[
	        'label' => 'O que é SQL',
	        'link' => URL.'/oqueesql',
            'classe' => '',
	        'icon' => 'noise_control_off'
	    ],
	    'comandosbasicos' =>[
	        'label' => 'Comandos Básicos',
	        'link' => '',
	        'classe' => 'disabled',
	        'icon' => 'arrow_drop_down'
	    ],
	    'createdatabase' =>[
	        'label' => 'Create Database',
	        'link' => URL.'/createdatabase',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'showdatabases' =>[
	        'label' => 'Show Databases',
	        'link' => URL.'/showdatabases',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'usedatabase' =>[
	        'label' => 'Use Database',
	        'link' => URL.'/usedatabase',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'createtable' =>[
	        'label' => 'Create Table',
	        'link' => URL.'/createtable',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'showtables' =>[
	        'label' => 'Show Tables',
	        'link' => URL.'/showtables',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'showcolumns' =>[
	        'label' => 'Show Columns',
	        'link' => URL.'/showcolumns',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'altertable' =>[
	        'label' => 'Alter Table',
	        'link' => URL.'/altertable',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'restricoes' =>[
	        'label' => 'Restrições (Constraints)',
	        'link' => URL.'/restricoes',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'insert' =>[
	        'label' => 'Insert',
	        'link' => URL.'/insert',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'select' =>[
	        'label' => 'Select',
	        'link' => URL.'/select',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'orderby' =>[
	        'label' => 'Order By',
	        'link' => URL.'/orderby',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'update' =>[
	        'label' => 'Update',
	        'link' => URL.'/update',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'delete' =>[
	        'label' => 'Delete',
	        'link' => URL.'/delete',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'droptable' =>[
	        'label' => 'Drop Table',
	        'link' => URL.'/droptable',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'truncatetable' =>[
	        'label' => 'Truncate Table',
	        'link' => URL.'/truncatetable',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'dropdatabase' =>[
	        'label' => 'Drop Database',
	        'link' => URL.'/dropdatabase',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'play_arrow'
	    ],
	    'comandosavancados' =>[
	        'label' => 'Comandos Avançados',
	        'link' => '',
	        'classe' => 'disabled',
	        'icon' => 'arrow_drop_down'
	    ],
	    'join' =>[
	        'label' => 'Join',
	        'link' => URL.'/join',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'arrow_drop_down'
	    ],
	    'innerjoin' =>[
	        'label' => 'Inner Join',
	        'link' => URL.'/innerjoin',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'arrow_drop_down'
	    ],
	    'leftjoin' =>[
	        'label' => 'Left Join',
	        'link' => URL.'/leftjoin',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'arrow_drop_down'
	    ],
	    'rightjoin' =>[
	        'label' => 'Right Join',
	        'link' => URL.'/rightjoin',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'arrow_drop_down'
	    ],
	    'union' =>[
	        'label' => 'Union',
	        'link' => URL.'/union',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'arrow_drop_down'
	    ],
	    'referencias' =>[
	        'label' => 'Referências',
	        'link' => URL.'/referencias',
	        'classe' => 'nav-link-subitem',
	        'icon' => 'arrow_drop_down'
	    ]
	];
	
	
	//Método responsável por renderizar a view do menu Vertical do painel Tutorial
	private static function getMenuVertical($currentModule){
	        
	        //Links do Menu
	    $links ='';
	    //Itera os módulos
	    foreach (self::$modulesVertical as $hash=>$module){
	        $links .= View::render('pages/tutorial/menu/link',[
	            'label' => $module['label'],
	            'link' => $module['link'],
	            'classe' => $module['classe'],
	            'icon' => $module['icon'],
	            //'current' => $hash == $currentModule ? 'text-danger' : ''
	            'current' => $hash == $currentModule ? 'active"  style="font-weight:bold;' : ''
	            
	        ]);
	    }
	    //Retorna a renderização do menu
	    return View::render('pages/tutorial/menu/box',[
	        'links' => $links
	    ]);
	}
	
	
	
	//Método responsavel por retornar o conteudo (view) da estrutura generica de página do painel
	public static function getPage($title, $content){
		return View::render('pages/page',[
				'title' => $title,
				'content' => $content
		]);
	}
	
	//Método responsável por renderizar a view do menu do painel
	private static function getMenu($currentModule){
		
		//Links do Menu
		$links ='';
		
		//Itera os módulos
		foreach (self::$modules as $hash=>$module){
			$links .= View::render('pages/menu/link',[
					'label' => $module['label'],
					'link' => $module['link'],
					'current' => $hash == $currentModule ? 'text-danger' : ''
 					
			]);
			
		}
		
		//Retorna a renderização do menu Principal
		return View::render('pages/menu/box',[
				//'links' => $links
				'links' => ''
		]);
		
	}
	
	
	
	
	
	//Método resposanvel por renderizar a view do painel com conteúdos dinâmicos
	public static function getPanel($title, $content, $currentModule){
		
		//Renderiza a view do painel
		$contentPanel = View::render('pages/tutorial/panel',[
				'menu' => self::getMenu($currentModule),
		        'menuVertical' => self::getMenuVertical($currentModule),
				'content' => $content
		]);
		
		//Retorna a página renderizada
		return self::getPage($title, $contentPanel);
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//Método responsvel por renderizar o layout de paginação
	public static function getPagination($request,$obPagination){
		//Páginas
		$pages = $obPagination->getPages();
		
		//Verifica a quantidade de páginas
		if(count($pages) <=1) return '';
		
		//Links
		$links = '';
		
		//url atual (sem gets)
		$url = $request->getRouter()->getCurrentUrl();
		
		//GET
		$queryParams = $request->getQueryParams();
		
		//Renderiza os Links
		foreach ($pages as $page){
			
			//Altera a página
			$queryParams['page'] = $page['page'];
			
			//Link
			$link = $url.'?'.http_build_query($queryParams);
			
			//view
			$links .= View::render('admin/pagination/link',[
					'page' => $page['page'],
					'link' => $link,
					'active' => $page['current'] ? 'active' : ''
			]);
		}
		
		//Renderiza box de paginação
		return View::render('admin/pagination/box',[
				'links' => $links
				
		]);
		
		
		
		
	}
	
	
}