<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}
$logado = $_SESSION['login'];


include_once('conexao.php');
 

// Receber dados da id
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

If(!empty($id)){

    //Criar a Query para recuperar os dados do ID
    $sql = "SELECT et, numserie, motivo, status FROM dados_wyntech WHERE id =:id";

    //preparar a QUERY
    $result_id = $conn->prepare($sql);

    //substituir o link id pelo id 
    $result_id->bindParam(':id',$id);

    //executar a Query
    $result_id->execute();


      if($result_id->rowCount() != 0){
        $row_id = $result_id->fetch(PDO::FETCH_ASSOC);
        $retorna = ['erro' => false, 'dados' => $row_id];
        }else{
            $retorna = ['erro' => true, 'msg' => "<p style='color: #f00'>Erro: ID não encontrada.</p>"];
        }

    }
    
echo json_encode($retorna);
