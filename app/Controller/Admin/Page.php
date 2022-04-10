<?php

namespace App\Controller\Admin;

use App\Utils\View;

class Page{
	
	//Módulos disponíveis no painel
	private static $modules = [
		'home' =>[
				'label' => 'Home',
				'link' => URL.'/admin'
		],
		'testimonies' =>[
				'label' => 'Depoimentos',
				'link' => URL.'/admin/testimonies'
		],
		'users' =>[
				'label' => 'Usuários',
				'link' => URL.'/admin/users'
		]
			
			
	];
	
	//Método responsavel por retornar o conteudo (view) da estrutura generica de página do painel
	public static function getPage($title,$content){
		return View::render('admin/page',[
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
			$links .= View::render('admin/menu/link',[
					'label' => $module['label'],
					'link' => $module['link'],
					'current' => $hash == $currentModule ? 'text-danger' : ''
 					
			]);
			
		}
		
		//Retorna a renderização do menu
		return View::render('admin/menu/box',[
				'links' => $links
		]);
		
	}
	
	
	//Método resposanvel por renderizar a view do painel com conteúdos dinâmicos
	public static function getPanel($title, $content, $currentModule){
		
		//Renderiza a view do painel
		$contentPanel = View::render('admin/panel',[
				'menu' => self::getMenu($currentModule),
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