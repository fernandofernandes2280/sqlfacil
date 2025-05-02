<?php

namespace App\Controller\Ajax;
use PDO;

//inicia a sessão caso não esteja ativa
    if(session_status() != PHP_SESSION_ACTIVE ){
        session_start();
    }

//unset($_SESSION['nomeBanco']);

//Credencias Local
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
    $sql = trim(preg_replace('/\s\s+/',' ', strtolower($_POST['resposta'])));
    
    $msgSucesso = "Comando executado com Sucesso!";
    $msgErro = 'Comando SQL inválido para a Questão ou Existe erro de Sintaxe!';
    
    //separa as palavras em array
    $palavra = explode(' ', $sql);
    
  
     
    //recebe a resposta e converte pra minusculas
   $sql = strtolower($_POST['resposta']);

   //Id do usuário logado
   $_SESSION['id_usuario'] = 5;
    // Verificar se a responsta contém ";"
    if (strpos($sql, ";") !== false) {
        // Remove o ";" 
        $sql = str_replace(";", "",($sql));
    }


    // Verificar se a resposta contém "create database"
    if ((strstr($sql, "create") !== false) && (strstr($sql, "database") !== false)) {
        

            //remove espaçoes em branco no final e acrescenta o id do usuário
           $sql = rtrim($resposta).$_SESSION['id_usuario'];
           //executa a instrução
           if ($pdo_Aux ->query($sql)){
               $resultado[0] = $msgSucesso;
           // $resultado[1] = $nomeBanco;
           // $resultado[3] = "createdatabase";
           }else{
               //mensagem de erro sem o id do usuário
               $resultado[0] = str_replace($_SESSION['id_usuario'],'',(($pdo_Aux -> errorInfo()[2])));
           }
       

    }
       
    // Verificar se a resposta contém "show databases"
    if ((strpos($sql, "show") !== false) && (strpos($sql, "databases") !== false)) {
       
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
                       //retorna a posicao do id do usuario no banco
                       $pos = strripos($value, $_SESSION['id_usuario']);
                       if($pos){
                        //remove o id do usuario
                        $value = rtrim($value,$_SESSION['id_usuario']);
                       // exibe apenas os bancos criados pelo usuario, sem o seu id
                        $out .= "<td>$value</td>";
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
        }
    } 
        //executa a instrução SQL livremente
        if ($pdo_Aux ->query($sql)){
            $resultado[0] = $msgSucesso;
          }else{
            //mensagem de erro sem o id do usuário
            $resultado[0] = $pdo_Aux -> errorInfo()[2];
        }
    
    
    
   
  
    echo json_encode($resultado);
    
}else{//se nenhuma resposta tiver sido digitada
    $resultado[0]='Nenhum comando foi digitado!';
    echo json_encode($resultado);
}


?>
