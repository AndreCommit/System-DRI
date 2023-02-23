<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}
$logado = $_SESSION['login'];

//conectar ao banco de dados
$usuario_db = '';
$senha_db = '';
$database_db = '';
$host_db = 'localhost';

$conn = new mysqli($host_db, $usuario_db, $senha_db, $database_db);

// Receber informações do formulário HTML
$et = $_POST["et"];
$numserie = $_POST["numserie"];
$motivo = $_POST["motivo"];
$status =$_POST['status'];

// Inserir informações no banco de dados
$sql = "INSERT INTO dados_wyntech (et, numserie, data, motivo, status) VALUES ('PR6534ET$et', '$numserie', now(), '$motivo', '$status')";

//Verifica se todo o formulário foi preenchido
if ($et == "") {
  echo"<script language='javascript' type='text/javascript'>
    alert('Campo ET não preenchido.');window.location
    .href='painel.php';</script>";
}else {
  if ($numserie == "") {
    echo"<script language='javascript' type='text/javascript'>
    alert('Campo Número de Série nao preenchido.');window.location
    .href='painel.php';</script>";
  } else {
    if ($motivo == ""){
      echo"<script language='javascript' type='text/javascript'>
    alert('Campo de Ocorrência não preenchido.');window.location
    .href='painel.php';</script>";
    } else {
      if ($status == ""){
        echo"<script language='javascript' type='text/javascript'>
    alert('Campo de abertura de chamado, não preenchido.');window.location
    .href='painel.php';</script>";
      } else {
          if (mysqli_query($conn, $sql)) {
            echo"<script language='javascript' type='text/javascript'>
            alert('Informação Registrada com sucesso.');window.location
            .href='chamwynadm.php';</script>";
        } 
        else {
            echo "Erro ao registrar informação: " . mysqli_error($conn);
        }
      }
    }
  }
}

// Fechar conexão
mysqli_close($conn);
?>

