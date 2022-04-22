<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;
use \App\Session\Admin\Login as SessionAdminLogin;

class Login extends Page{
	
	//Método responsável poer retornar a renderizacao da página de login
	public static function getLogin($request,$errorMessage = null){
		
		//Status
		$status = !is_null($errorMessage) ? Alert::getError($errorMessage)  : '';
		
		
		//COnteúdo da página de login
		$content = View::render('admin/login',[
				'status' => $status
		]);
		
		
		//Retornar a página completa
		return parent::getPage('Login > SQLFácil', $content);
		
	}
	
	//Método responsavel por definir o login do usuario
	public static function setLogin($request){
		
		//Post Vars
		$postVars = $request->getPostVars();
		//Recebe o array email. Se não existir retorna vazio
		$email = $postVars['email'] ?? '';
		$senha = $postVars['senha'] ?? '';
		
		
		//busca usuário pelo e-mail
		$obUser = User::getUserByEmail($email);
	
		if(!$obUser instanceof User){
			return self::getLogin($request,'E-mail ou senha inválidos-Email');
		}
		
		//Verifica a senha do usuário
		if(!password_verify($senha, $obUser->senha)){
			return self::getLogin($request,'E-mail ou senha inválidos-Senha');
		}
		
		//Cria a sessão de Login
		SessionAdminLogin::login($obUser);
		//redireciona o usuario para a home do admin
		$request->getRouter()->redirect('/admin');
		
	}
	
	//Método responsavel por deslogar o usuario
	public static function setLogout($request){
		//Destroi a sessão de Login
		SessionAdminLogin::logout();
		//redireciona o usuario para a tela de login
		$request->getRouter()->redirect('/admin/login');
		
		
	}
	
	
	
	
}