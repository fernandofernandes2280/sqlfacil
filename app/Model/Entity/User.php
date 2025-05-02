<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User extends Pessoa{
	
	//Método responsavel por cadastrar o usuário no Banco de Dados
	public function cadastrar(){

		//Insere usuário no Banco de Dados
		$this->id=(new Database('tbl_usuarios'))->insert([
				'nome' 		=> $this->nome,
				'email' 	=> $this->email,
				'senha' 		=> $this->senha
		]);
		
		//Sucesso
		return true;
	}
	
	//Método responsavel por atualizar os dados no banco
	public function atualizar(){
		return (new Database('tbl_usuarios'))->update('id = '.$this->id,[
				'nome' 		=> $this->nome,
				'email' 	=> $this->email,
				'senha' 		=> $this->senha
		]);
		
		
	}
	
	//Método responsavel por excluir usuário do banco
	public function excluir(){
		return (new Database('tbl_usuarios'))->delete('id = '.$this->id);
		
		//Sucesso
		return true;
	}
	
	//Método responsavel por retornar uma instancia com base no id
	public static  function getUserById($id){
		return self::getUsers('id = '.$id)->fetchObject(self::class);
		
	}
	
	
	//Método responsavel por retornar um usuario com base em seu e-mail
	public static function getUserByEmail($email){
		return self::getUsers('email = "'.$email.'"')->fetchObject(self::class);
				
		//Sucesso
		return true;
	}
	
	//Método responsavel por retornar Usuários
	public static function getUsers($where = null, $order = null, $limit = null, $fields = '*') {
		return (new Database('tbl_usuarios'))->select($where,$order,$limit,$fields);
	}
	
}