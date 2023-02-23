
<?php
	session_start();
	if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['senha'])) 
	{
		//configuração com o banco de dados
  // Conecte-se ao banco de dados
  $usuario_db = '';
  $senha_db = '';
  $database_db = '';
  $host_db = 'localhost';
  
  $conn = new mysqli($host_db, $usuario_db, $senha_db, $database_db);
      if (!$conn) {
      die("Conexão falhou: " . mysqli_connect_error());
      }
 
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	//print_r('login: ' . $login);
	//print_r('senha: ' . $senha);

	$sql = "SELECT * FROM usuarios_wyntech WHERE LOGIN = '$login' AND SENHA ='$senha'";
	
	$result = $conn->query($sql);
	//print_r($result);
	
	if(mysqli_num_rows($result) < 1)
	{
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location: login.html');
	}
	else
	{
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		$logado = $_SESSION['login'];
		
		echo"<script language='javascript' type='text/javascript'>
		alert('Login efetuado com sucesso, seja bem vindo. $logado');window.location
		.href='paineluser.php';</script>";
	}
			}
	else
	{
		header('location: login.html');
	}

?>

