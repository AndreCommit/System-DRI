<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}
$logado = $_SESSION['login'];

//Incluir a conexao com o banco de dados
include_once('conexao.php');
 

// Receber dados da ET
$et = filter_input(INPUT_GET, 'et', FILTER_SANITIZE_STRING);

If(!empty($et)){

    //Criar a Query para recuperar os dados da ET
    $sql = "SELECT numserie FROM consulta2 WHERE et like :et";

    //preparar a QUERY
    $result_et = $conn->prepare($sql);

    //substituir o link ET pelo ET 
    $result_et->bindParam(':et',$et);

    //executar a Query
    $result_et->execute();


      if($result_et->rowCount() != 0){
        $row_et = $result_et->fetch(PDO::FETCH_ASSOC);
        $retorna = ['erro' => false, 'dados' => $row_et];
        }else{
            $retorna = ['erro' => true, 'msg' => "<p style='color: #f00'>Erro: ET não encontrada.</p>"];
        }

    }
    
echo json_encode($retorna);
