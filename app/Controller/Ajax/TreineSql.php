<?php

namespace App\Controller\Ajax;
use PDO;

//inicia a sessão caso não esteja ativa
    if(session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }


$dbuser = "root";
$dbsenha = "fl4m3ng0";
//$dbsenha = "3duc4unifap";
$banco = 'sqlfacildb';
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
    $sql = trim(preg_replace('/\s\s+/',' ', strtolower($_POST['resposta'])));
    
    $msgSucesso = "Comando executado com Sucesso!";
    $msgErro = 'Comando SQL inválido para a Questão ou Existe erro de Sintaxe!';
    
    //separa as palavras em array
    $palavra = explode(' ', $sql);
    
    //sempre haverá um usuário logado
    $id = 5;
    $id_usuario = $id."_";
     
   
    //Todos os comandos sql com pelo menos duas palavras
    if(count($palavra) > 1){
        //Comando create database
        if($palavra[0].$palavra[1] == 'createdatabase'){
            if(count($palavra) == 2){
                $sql = $palavra[0].' '.$palavra[1];
            }else if (count($palavra) == 3){
                $nomeBanco = $id_usuario.$palavra[2];
                $sql = $palavra[0].' '.$palavra[1].' '.$nomeBanco;
            }else $sql = $sql;
            
                //executa a instrução
                if ($pdo_Aux ->query($sql)){
                    $resultado[0] = $msgSucesso;
                    $resultado[1] = $id_usuario.$nomeBanco;
                    $resultado[3] = "createdatabase";
                }else{
                    //mensagem de erro sem o id do usuário
                     $resultado[0] = str_replace($id_usuario,'',(($pdo_Aux -> errorInfo()[2])));
                  //   $resultado[0] = $sql;
                }
        }else
        
        //Comando show databases
        if($palavra[0].$palavra[1] == 'showdatabases'){
            
            if($showColumnsTables = $pdo_Aux -> query($sql)){
                $row = $showColumnsTables -> fetchAll(PDO::FETCH_ASSOC);
                function array2Html($array, $table = true){
                    $out = '';
                    //  $tableHeader='';
                    foreach ($array as $key => $value) {
                        if (is_array($value)) {
                            if (!isset($tableHeader)) {
                                $tableHeader =
                                '<th class="active">' .
                                implode('</th><th class="active">', array_keys($value)).
                                '</th>';
                            }
                            array_keys($value);
                            $out .= '<tr>';
                            $out .= array2Html($value, false);
                            $out .= '</tr>';
                        }else{
                            //   if(isset($_SESSION['id_usuario_login'])){$id_usuario = $_SESSION['id_usuario_login'];}
                            // exibe apenas os bancos criados pelo usuario logado
                            $id_usuario = 5;
                            if(strstr($value, '_', true) == $id_usuario){
                                
                                $value = str_replace($id_usuario.'_','',$value);
                                $out .= "<td >$value</td>";
                            }
                        }
                    }
                    if ($table){
                        return '<table class="table table-bordered table-condensed">' . $tableHeader . $out . '</table>';
                    }else{
                        return $out;
                    }
                }
                if (empty($row)){
                    $resultado[0] = "Comando não retornou nenhum registro.";
                }else{
                    $resultado[0] = html_entity_decode(array2Html($row));
                }
            }else{
                //mensagem de erro sem o id do usuário
                $resultado[0] = str_replace($id_usuario,'',(($pdo_Aux -> errorInfo()[2])));
            }
            
        }// Fim show databases
            else if($palavra[0]== 'use'){
                //verifica quantas palavras foram usadas junto com o comando use
              
                   if(count($palavra) == 2){
                       $nomeBanco = $id_usuario.$palavra[1];
                       $sql = $palavra[0].' '.$nomeBanco;
                        
                    }else{
                        $sql = $sql;
                    }

                if ($pdo_Aux ->query($sql)){
                    $resultado[0] = $msgSucesso;
                    //armazena o nome do banco para exibir na tela 
                    $resultado[1] = str_replace($id_usuario,'',($nomeBanco));
                    $resultado[3] = 'use';
                  
                    //Define a sessao do banco em uso
                    $_SESSION['nomeBanco'] = $resultado[1]; 
                    
                }else{
                    //tira o id do usuario da mensagem
                    $resultado[0] = str_replace($id_usuario,'',(($pdo_Aux -> errorInfo()[2])));
                  
                }
            }else if($pdo_Aux ->query($sql)){
                $resultado[0] = $msgSucesso;
                
            }else{
                //mensagem de erro sem o id do usuário
                $resultado[0] = str_replace($id_usuario,'',(($pdo_Aux -> errorInfo()[2])));
                
            }
            
            
            
            
            
            
            //apenas 1 palavra na resposta
            }else if($pdo_Aux ->query($sql)){
                $resultado[0] = $msgSucesso;
                
                }else{
                    //mensagem de erro sem o id do usuário
                   $resultado[0] = str_replace($id_usuario,'',(($pdo_Aux -> errorInfo()[2])));
                  
                }
        
            
            
            
            
     //Todos os comandos sql com pelo menos uma palavras
    
       
//$resultado[0] = $sql;

echo json_encode($resultado);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}else{//se nenhuma resposta tiver sido digitada
    $resultado[0]='Nenhum comando foi digitado!';
    echo json_encode($resultado);
}


?>
