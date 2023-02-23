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
    $servername = "localhost";
    $usernameDB = "";
    $passwordDB = "";
    $dbname = "";

    $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Receber informações do formulário HTML
    $et = $_POST["et"];
    $numserie = $_POST["numserie"];
    $motivo = $_POST["motivo"];
    $data =$_POST['data'];
    $usuario =$_POST['usuario'];
    $status =$_POST['status'];
    $req =$_POST['req'];

    // Inserir informações no banco de dados
    $sql = "INSERT INTO dados_wyntech (et, numserie, data, usuario, motivo, status, req) 
    VALUES ('PR6534ET$et', '$numserie', now(), '$usuario', '$motivo', '$status', '$req')";

//Verifica se todo o formulário foi preenchido corretamente, se estiver ok, ele executa
if ($et == "") {
    echo"<script language='javascript' type='text/javascript'>
    alert('Campo ET não preenchido.');window.location
    .href='chamadoff.php';</script>";
    }else {
        if ($numserie == "") {
        echo"<script language='javascript' type='text/javascript'>
        alert('Campo Número de Série nao preenchido.');window.location
        .href='chamadoff.php';</script>";
        } else {
            if ($motivo == ""){
                echo"<script language='javascript' type='text/javascript'>
            alert('Campo de Ocorrência não preenchido.');window.location
            .href='chamadoff.php';</script>";
            } else {
                if ($usuario == "") {
                echo"<script language='javascript' type='text/javascript'>
                alert('Por favor selecione o usuario, para registrar o chamado.');window.location
                .href='chamadoff.php';</script>";
                } else {
                    if ($status == ""){
                        echo"<script language='javascript' type='text/javascript'>
                        alert('Por favor selecione para fechar o chamado.');window.location
                        .href='chamadoff.php';</script>";
                    } else {
                        if (substr($req, 0, 3) !== "REQ") {
                            $req = "REQ" . $req;
                            echo"<script language='javascript' type='text/javascript'>
                            alert('Por favor, insira a REQ CORRETAMENTE');window.location
                            .href='chamadoff.php';</script>";
                            } else {
                                if (mysqli_query($conn, $sql)) {
                                    echo"<script language='javascript' type='text/javascript'>
                                    alert('Informação Registrada com sucesso.');window.location
                                    .href='chamadoff.php';</script>";
                                } 
                                else {
                                    echo "Erro ao registrar informação: " . mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }
        }
                
  
// Fechar conexão
mysqli_close($conn);
?>

