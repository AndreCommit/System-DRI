<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}
$logado = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
          table, th {
    border: 1px hidden;
    width: 90%;
    margin: 0 auto;
    padding: 30px; 
    text-align: center;
    width: 75%;
  }
  
  tr:hover {
    background-color: rgb(190, 223, 236);
  }
  
  td{
    border-bottom: 1px solid;
    padding: 2px;  
  }
  </style>
</head>
</HTML>
<?php
 //conectar ao banco de dados
 $servername = "localhost";
 $usernameDB = "";
 $passwordDB = "";
 $dbname = "";

 $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
 if (!$conn) {
   die("Conexão falhou: " . mysqli_connect_error());
 }

  // Consulta à tabela
  $result = mysqli_query($conn, "SELECT * FROM dados_wyntech WHERE status='registrado' ORDER BY ID DESC");

  // Verifica se a consulta retornou algum resultado
  if (mysqli_num_rows($result) > 0) {
      echo "<table>";
      echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>NOME LOGICO</th>";
      echo "<th>NUMERO SERIE</th>";
      echo "<th>DATA</th>";
      echo "<th>NOME SUPORTE</th>";
      echo "<th>OCORRENCIA</th>";
      echo "<th>SITUAÇÃO</th>";
      echo "<th>REQ</th>";
      echo "</tr>";

      // Exibe os resultados da consulta na tabela
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["et"] . "</td>";
          echo "<td>" . $row["numserie"] . "</td>";
          echo "<td>" . $row["data"] . "</td>";
          echo "<td>" . $row["usuario"] . "</td>";
          echo "<td>" . $row["motivo"] . "</td>";
          echo "<td>" . $row["status"] . "</td>";
          echo "<td>" . $row["req"] . "</td>";
          echo "</tr>";
      }
      echo "</table>";
  } else {
      echo "Não foram encontrados resultados.";
  }

  // Fecha a conexão com o banco de dados
  mysqli_close($conn);
?>
<html>
    <header></head>
    <body>
    <ul>
        <li><a href="chamwynadm.php">Voltar ao Painel</a></li>
    </ul>
</body>
</body>