<?php

namespace App\Controller\Ajax;

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
    $sql =strtolower($_POST['resposta']);
    
    $comandoInformado = explode(" ", $sql.' ');
    $msgSucesso = "Comando executado com Sucesso!";
    $msgErro = 'Comando SQL inválido para a Questão ou Existe erro de Sintaxe!';
    
    $tira_espacos = strtolower(str_replace(' ','',$sql));
    $tiraEspaco = strtolower(str_replace(' ','', $sql));
    
    //pega apenas o nome do banco de dados que será criado
    $nomeBanco =trim(str_replace('createdatabase',' ',$tiraEspaco));
    
    //pega as 14 primeiras letras do comando digitado - CREATEDATABASE
    $createDatabase = strtolower(substr($tira_espacos, 0, 14));
    //pega as 13 primeiras letras do comando digitado - SHOWDATABASES
    $showDatabases = strtolower(substr($tira_espacos, 0, 13));

    //sempre haverá um usuário logado
    $id = 5;
    $id_usuario = $id."_";
     
   
    //Comando create database
    if($createDatabase == 'createdatabase'){
            //monta a query
            $sql =strtolower("create database ".$id_usuario.$nomeBanco);
            //executa a instrução
            if ($pdo_Aux ->query($sql)){
                $resultado[0] = $msgSucesso;
                $resultado[1] = $id_usuario.$nomeBanco;
                $resultado[3] = "createdatabase";
            }else{
                //mensagem de erro sem o id do usuário
                $resultado[0] = str_replace($id_usuario,'',(($pdo_Aux -> errorInfo()[2])));
            }
     //Comando show databases       
    }else if ($showDatabases == 'showdatabases'){
        if($showColumnsTables = $pdo_Aux -> query($sql)){
            $row = $showColumnsTables -> fetchAll(\PDO::FETCH_ASSOC);
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
        
        
        
        
        
            
            
            
    }else  if($pdo_Aux ->query($sql)){
              $resultado[0] = $msgSucesso;
            
            }else{
                //armazena a msg de erro
                $resultado[0] = $pdo_Aux -> errorInfo()[2];
                //tira o id do usuario da mensagem de erro
                $resultado[0] = str_replace($id_usuario,'',(($resultado[0])));
            }
    



echo json_encode($resultado);
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}else{//se nenhuma resposta tiver sido digitada
    $resultado[0]='Nenhum comando foi digitado!';
    echo json_encode($resultado);
}


?>