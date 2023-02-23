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
$et1 = $_POST["et1"];
$numserie1 = $_POST["numserie1"];

// Inserir informações no banco de dados
$sql = "INSERT INTO consulta2 (numserie, et) VALUES ('$numserie1', '$et1')";

//Verifica se todo o formulário foi preenchido
    if ($et1 == "") {
      echo"<script language='javascript' type='text/javascript'>
        alert('Por favor insira a ET para cadastramento.');window.location
        .href='paineluser.php';</script>";
      }else{
        if ($numserie1 == "") {
          echo"<script language='javascript' type='text/javascript'>
        alert('Por favor insira o número de série válida para Registro.');window.location
        .href='paineluser.php';</script>";
        }else{
          if (mysqli_query($conn, $sql)) {
            echo"<script language='javascript' type='text/javascript'>
            alert('Informação Registrada com sucesso.');window.location
            .href='inserirtabela.php';</script>";
        } 
        else {
            echo "Erro ao registrar informação: " . mysqli_error($conn);
        }
      }
    }
      

  


// Fechar conexão
mysqli_close($conn);
?>

