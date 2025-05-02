<?php

namespace App\Controller\Ajax;
use PDO;

//inicia a sessão caso não esteja ativa
    if(session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }

//unset($_SESSION['nomeBanco']);

$dbuser = "root";
$dbsenha = "root";
//$dbsenha = "3duc4unifap";
$banco = 'sqlfacildb';

/* Credenciais WEB Hostinger
$dbuser = "u806908271_sqlfacil";
$dbsenha = "fShv|A^";
//$dbsenha = "3duc4unifap";
$banco = 'u806908271_sqlfacil';
*/

//codificacao de caracteres
$acentos = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');

//estabelece a primeira conexão com o servidor sem nenhum banco selecionado
$dsn_Aux = "mysql:dbname=;host=localhost";
global $banco_aluno;
try{
    $pdo_Aux = new \PDO($dsn_Aux, $dbuser, $dbsenha,$acentos);
    $pdo_Aux -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
    //echo "Conexão estabelecida com sucesso!";
}catch(\PDOException $e){
    //echo "Falhou: ".$e->getMessage();
    echo "Erro de Conexão para Executar os Comandos SQL!";
}




//verifica se alguma resposta foi digitada
if (isset($_POST['resposta']) && ($_POST['resposta']!='')){
    
    //retira excessos de espaços em branco 
    $sql = trim(preg_replace('/\s\s+/',' ',($_POST['resposta'])));
    $sql = str_replace(";", "",($sql));
    $msgSucesso = "Comando executado com Sucesso!";
    $msgErro = 'Comando executado com Erro';
    
    //separa as palavras em array
    $palavra = explode(' ', $sql);
    
   /* 
                    $resultado[0] = mensagem de succeso ou erro;
                    $resultado[1] = nomeBanco;
                    $resultado[2] = tabela gerada;
                    $resultado[3] = comando utilizado;
   */
     
   
    //Todos os comandos sql com pelo menos duas palavras
    if(count($palavra) >1){
        //sempre haverá um usuário logado
        $id = 5;
        $_SESSION['id_usuario'] = $id;
        //Comando create database
        if((strtolower($palavra[0].$palavra[1]) == 'createdatabase')){
            if(count($palavra) == 2){
                $sql = $palavra[0].' '.$palavra[1];
            }else if (count($palavra) == 3){
                $nomeBanco = $_SESSION['id_usuario'].$palavra[2];
                $sql = $palavra[0].' '.$palavra[1].' '.$nomeBanco;
            }else $sql = $sql;
            
                //executa a instrução
                if ($pdo_Aux ->query($sql)){
                    $resultado[0] = $msgSucesso;
                    $resultado[1] = $nomeBanco;
                    $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    $resultado[3] = "createdatabase";
                }else{
                    //mensagem de erro sem o id do usuário
                    $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                  //   $resultado[0] = $sql;
                }
        }else
        
        //Comando show databases
        if(strtolower($palavra[0].$palavra[1]) == 'showdatabases'){
            //."'".$data."'"
            //pesquisa apenas as bases de dados do usuário
            if($showColumnsTables = $pdo_Aux -> query($sql.' like '."'".$_SESSION['id_usuario']."%'")){
                $row = $showColumnsTables -> fetchAll(PDO::FETCH_ASSOC);
                function array2Html($array, $table = true){
                    $out = '';
                    //  $tableHeader='';
                    foreach ($array as $key => $value) {
                        if (is_array($value)) {
                            if (!isset($tableHeader)) {
                                //captura o valor da array (Database (id_usuario%))
                                $header = implode('</th><th>', array_keys($value));
                                //deixa apenas o nome Database
                                $header = str_replace("(".$_SESSION['id_usuario']."%)",'',$header);
                                $tableHeader =
                                '<th style="padding: 5px;">' .
                                $header.
                                '</th>';
                            }
                           
                            array_keys($value);
                            
                                $out .= '<tr>';
                                $out .= array2Html($value, false);
                                $out .= '</tr>';
                            
                        }else{

                            // exibe apenas os bancos criados pelo usuario logado
                            if($value[0] == $_SESSION['id_usuario']){
                                
                                $value = str_replace($_SESSION['id_usuario'],'',$value);
                                $out .= '<td style="padding: 5px;">'.$value.'</td>';
                            }
                        }
                    }
                    if ($table){
                        return '<table border="1" style="margin: 5px">' . $tableHeader . $out . '</table>';
                    }else{
                        return $out;
                    }
                }
                if (empty($row)){
                    $resultado[0] = $msgSucesso;
                    $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                }else{
                    $resultado[0] = $msgSucesso;
                    $resultado[2] = html_entity_decode(array2Html($row));
                    
                }
            }else{
                //mensagem de erro sem o id do usuário
                $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));

            }
            
        }// Fim show databases
            else if((strtolower($palavra[0])== 'use')){
                //verifica quantas palavras foram usadas junto com o comando use
              
                   if(count($palavra) == 2){
                       $nomeBanco = $_SESSION['id_usuario'].$palavra[1];
                       $sql = $palavra[0].' '.$nomeBanco;
                        
                    }else{
                        $sql = $sql;
                    }

                if ($pdo_Aux ->query($sql)){
                    $resultado[0] = $msgSucesso;
                    //armazena o nome do banco para exibir na tela 
                    $resultado[1] =  str_replace($_SESSION['id_usuario'],'',($nomeBanco));
                    $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    $resultado[3] = 'use';
                  
                    //Define a sessao do banco em uso
                    $_SESSION['nomeBanco'] = $resultado[1]; 
                    
                }else{
                    //tira o id do usuario da mensagem
                    $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                  
                }
            }else
            //Comando Create Table
            if(strtolower($palavra[0].$palavra[1]) == 'createtable'){
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                
           
                if ($pdo_Aux ->query($sql)){
                    $resultado[0] = $msgSucesso;
                    $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                }else{
                    //tira o id do usuario da mensagem
                    $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                }
                
                //Comando Show Tables
            }else if((strtolower($palavra[0].$palavra[1]) == 'showcolumns') ||
            (strtolower($palavra[0].$palavra[1]) == 'showtables')){
             
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                
                if($showColumnsTables = $pdo_Aux -> query($sql)){
                    $row = $showColumnsTables -> fetchAll(PDO::FETCH_ASSOC);
                    function array2Html($array, $table = true){
                        $out = '';
                        // $tableHeader='';
                        foreach ($array as $key => $value) {
                            if (is_array($value)) {
                                if (!isset($tableHeader)) {
                                    $tableHeader =
                                    '<th style="padding: 5px;">' .
                                    implode('</th><th>', array_keys($value)) .
                                    '</th>';
                                }
                                array_keys($value);
                                $out .= '<tr>';
                                $out .= array2Html($value, false);
                                $out .= '</tr>';
                            }else{
                                $out .= '<td style="padding: 5px;">'.$value.'</td>';
                            }
                        }
                        
                        if ($table) {
                            return '<table border="1" style="margin: 5px">' . $tableHeader . $out . '</table>';
                        }else{
                            return $out;
                        }
                    }
                     //caso não retorne nada
                     if (empty($row)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    }else{//envia o resultado do comando
                        
                        $resultado[0] = $msgSucesso;
                        $resultado[2] = html_entity_decode(array2Html($row));}
                }
                
                else{
                    //mensagem de erro sem o id do usuário
                    $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                }
                
                
            
              //Comando Alter Table
            }else if(strtolower($palavra[0].$palavra[1]) == 'altertable'){
        
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                
                if ($pdo_Aux ->query($sql)){
                    $resultado[0] = $msgSucesso;
                    $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                }else{
                    //mensagem de erro sem o id do usuário
                    $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                }
                
                
                //Comando Insert Into
            }else if(strtolower($palavra[0].$palavra[1]) == 'insertinto'){
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                    
                    if ($pdo_Aux ->query($sql)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    }else{
                        //mensagem de erro sem o id do usuário
                        $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                    }
        
                    
                    //Comando Select
            }else if((strtolower($palavra[0])) == 'select'){
                
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                    
                    if($showColumnsTables = $pdo_Aux -> query($sql)){
                        $row = $showColumnsTables -> fetchAll(PDO::FETCH_ASSOC);
                        function array2Html($array, $table = true){
                            $out = '';
                            // $tableHeader='';
                            foreach ($array as $key => $value) {
                                if (is_array($value)) {
                                    if (!isset($tableHeader)) {
                                        $tableHeader =
                                        '<th style="padding: 5px;">' .
                                        implode('</th><th>', array_keys($value)) .
                                        '</th>';
                                    }
                                    array_keys($value);
                                    $out .= '<tr>';
                                    $out .= array2Html($value, false);
                                    $out .= '</tr>';
                                }else{
                                    $out .= '<td style="padding: 5px;">'.$value.'</td>';
                                }
                            }
                            
                            if ($table) {
                                return '<table border="1" style="margin: 5px">' . $tableHeader . $out . '</table>';
                            }else{
                                return $out;
                            }
                        }
                        //caso nao existam tabelas 
                        if (empty($row)){
                            $resultado[0] = $msgSucesso;
                            $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                        }else{//envia o resultado do comando
                            
                            $resultado[0] = $msgSucesso;
                            $resultado[2] = html_entity_decode(array2Html($row));}
                        
                    }
                    
                    else{
                        //mensagem de erro sem o id do usuário
                        $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                    }
                
                
                    //Comando Update
            }else if(strtolower($palavra[0]) == 'update'){
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                    
                    if ($pdo_Aux ->query($sql)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    
                    }else{
                        //mensagem de erro sem o id do usuário
                        $resultado[2] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                    }
                    //Comando Delete
            }else if(strtolower($palavra[0]) == 'delete'){
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                    
                    if ($pdo_Aux ->query($sql)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    }else{
                        //mensagem de erro sem o id do usuário
                        $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                    }
                    //Comando Drop Table
            }else if(strtolower($palavra[0].$palavra[1]) == 'droptable'){
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                    
                    if ($pdo_Aux ->query($sql)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    }else{
                        //mensagem de erro sem o id do usuário
                        $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                    }
                    //Comando Truncate 
            }else if(strtolower($palavra[0]) == 'truncate'){
                
                //como o banco em uso
                if(isset($_SESSION['nomeBanco']))
                    $pdo_Aux->query('use '.$_SESSION['id_usuario'].$_SESSION['nomeBanco']);
                    
                    if ($pdo_Aux ->query($sql)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                    }else{
                        //mensagem de erro sem o id do usuário
                        $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                    }
                    
                    //Comando Drop Database
            }else if(strtolower($palavra[0].$palavra[1]) == 'dropdatabase'){
                    $sql = 'drop database '.$_SESSION['id_usuario'].$palavra[2];
                    if ($pdo_Aux ->query($sql)){
                        $resultado[0] = $msgSucesso;
                        $resultado[2] ="<table><th>O MySQL retornou um conjunto vazio (ex. zero registros).</th></table>";
                        //parei aqui
                        if(isset($_SESSION['nomeBanco'])){
                            
                            if($_SESSION['id_usuario'].$palavra[2] == $_SESSION['id_usuario'].$_SESSION['nomeBanco']) {
                                unset($_SESSION['nomeBanco']);
                                $resultado[3] = 'dropDatabase';}
                        }
                        
                    }else{
                        //mensagem de erro sem o id do usuário
                        $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                       
                    }
        
    }else if($pdo_Aux ->query($sql)){
                $resultado[0] = $msgSucesso;
                
            }else{
                //mensagem de erro sem o id do usuário
                $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                
            }
            
            
            //apenas 1 palavra na resposta
            }else if($pdo_Aux ->query($sql)){
                $resultado[0] = $msgSucesso;
                }else{
                    //mensagem de erro sem o id do usuário
                   $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
                }

    echo json_encode($resultado);
    
}else{//se nenhuma resposta tiver sido digitada
    $resultado[0]='Nenhum comando foi digitado!';
    echo json_encode($resultado);
}


?>
