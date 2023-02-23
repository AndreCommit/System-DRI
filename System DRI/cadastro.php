<?php
  $username = $_POST["login"];
  $password = $_POST["senha"];
  $nome = $_POST["nome"];

  // Conecte-se ao banco de dados
  $usuario_db = '';
  $senha_db = '';
  $database_db = '';
  $host_db = 'localhost';
  
  $conn = new mysqli($host_db, $usuario_db, $senha_db, $database_db);

   // Verifique se o usuário já existe no banco de dados
   $sql = "SELECT id FROM usuarios_wyntech WHERE login = '$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 0) {
    // Hash da senha
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // Inserir o novo usuário no banco de dados
    $sql = "INSERT INTO usuarios_wyntech (login, senha, nome)
    VALUES ('$username', '$password', '$nome')";
    if (mysqli_query($conn, $sql)) {
      echo"<script language='javascript' type='text/javascript'>
        alert('Usuário cadastrado com sucesso');window.location
        .href='login.html';</script>";

    } else {
      echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo"<script language='javascript' type='text/javascript'>
        alert('Usuário já existe');window.location
        .href='cadastro.html';</script>";
  }
    mysqli_close($conn);
?>