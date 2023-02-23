<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}
$logado = $_SESSION['login'];

 $servername = "localhost";
 $usernameDB = "";
 $passwordDB = "";
 $dbname = "";

 $conn = new PDO("mysql:host=$servername;dbname=" . $dbname, $usernameDB, $passwordDB);
 if (!$conn) {
   die("Conexão falhou: " . mysqli_connect_error());
 }
?>