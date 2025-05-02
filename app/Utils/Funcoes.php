<?php 
namespace App\Utils;

class Funcoes{

//Método responsavel por iniciar a sessão
    public static function init(){
    //verifica se a sessao não está ativa
    if(session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }
}



}
?>