<?php
	session_start();
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
  echo"<script language='javascript' type='text/javascript'>
  alert('Você foi DESCONECTADO com sucesso');window.location
  .href='login.html';</script>";
?>