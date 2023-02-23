<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}

//Incluir a conexao com o banco de dados
include_once "conexao.php";

//Receber os dados do formulário
if (isset($_POST['Registrar'])) {
  $id = $_POST['id'];
  $usuario = $_POST['usuario'];
  $status = $_POST['status'];
  $req = $_POST['req'];
}
    //Preparar a query de update:
    $sql = "UPDATE dados_wyntech SET usuario=:usuario, status=:status, req=:req WHERE id=:id";
    $stmt = $conn->prepare($sql);

    //Vincular os valores aos parâmetros da query:
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':req', $req);


    //Verificar se a query foi executada com sucesso:
        if ($usuario == "") {
          echo"<script language='javascript' type='text/javascript'>
          alert('Por favor selecione o usuario, para registrar o chamado.');window.location
          .href='paineluser.php';</script>";
        } else {
          if ($status == ""){
            echo"<script language='javascript' type='text/javascript'>
            alert('Por favor selecione para fechar o chamado.');window.location
            .href='paineluser.php';</script>";
          } else {
            if (substr($req, 0, 3) !== "REQ") {
              $req = "REQ" . $req;
              echo"<script language='javascript' type='text/javascript'>
              alert('Por favor, insira a REQ CORRETAMENTE');window.location
              .href='chamadoff.php';</script>";
              } else {
                if ($stmt->execute()) {
                  echo"<script language='javascript' type='text/javascript'>
                  alert('Chamado Registrado com sucesso.');window.location
                  .href='paineluser.php';</script>";
                } else {
                    echo "Erro ao inserir informação: " . mysqli_error($conn);
                }
              }
            }
          }
    
