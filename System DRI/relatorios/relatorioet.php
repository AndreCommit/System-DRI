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
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico">
	<title>Relatórios DATA</title>

    <!-- Bootstrap core CSS -->
    <link href="/archerx/public/wyntech/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="/archerx/public/wyntech/css/font-awesome.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="/archerx/public/wyntech/css/style1.css" rel="stylesheet">
    
</head>
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
				<h1 class="site-title"><a href="/archerx/public/wyntech/relatorio.php">Desenvolvimento André</a></h1>
													
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				<ul class="nav nav-pills flex-column sidebar-nav">
				<li class="nav-item"><a class="nav-link" href="/archerx/public/wyntech/paineluser.php"><em class="fa fa-calendar-o"></em> Painel Plansul</a></li>
				<li class="nav-item"><a class="nav-link" href="/archerx/public/wyntech/inserirtabela.php"><em class="fa fa-calendar-o"></em> Consulta/Registros</a></li>
					<li class="nav-item"><a class="nav-link" href="/archerx/public/wyntech/chamadoff.php"><em class="fa fa-hand-o-up"></em> Chamados OFF</a></li>
					<li class="nav-item"><a class="nav-link" href="/archerx/public/wyntech/relatorio.php"><em class="fa fa-pencil-square-o"></em> Relatórios</a></li>
				</ul>
				<a href="/archerx/public/wyntech/relatorio.php" class="logout-button"><img src="/archerx/public/wyntech/img/logoWT-1-300x75.png" style="width: 95%"></a>
			</nav>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h5 class="float-left text-center text-md-left">Relatórios</h5>
					</div>
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
						<div class="username mt-1">
							<h4 class="mb-1">					
								<?php
						 echo "<h4> $logado </h4>"
						?>
						</h4>
						</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
						     <a class="dropdown-item" href="/wyntech/logoff.php"><em class="fa fa-power-off mr-1"></em> Logout</a></div>
					<div class="clear"></div>
				</header>
				
					<div class="col-sm-12">
						<section class="row">
							<div class="col-sm-12 col-md-6">
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title">Relatório por Estação:</h3>
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
										
											// Verificar se o formulário foi enviado
											if (isset($_POST['submit'])) {
												// Obter o valor da coluna "et" enviado pelo formulário
												$et = mysqli_real_escape_string($conn, $_POST['et']);
											  
												// Executar a consulta SQL para buscar as informações
												$sql = "SELECT et, numserie, data, usuario, motivo, req FROM dados_wyntech WHERE et = '$et'";
												$result = mysqli_query($conn, $sql);
											  
												// Exibir os resultados na tela
												if (mysqli_num_rows($result) > 0) {
												  while ($row = mysqli_fetch_assoc($result)) {
													echo "Nome Lógico: " . $row["et"] . "<br>";
													echo "Num/Serie: " . $row["numserie"] . "<br>";
													echo "Data: " . $row["data"] . "<br>";
													echo "Usuário: " . $row["usuario"] . "<br>";
													echo "Ocorrência: " . $row["motivo"] . "<br>";
													echo "Req: " . $row["req"] . "<br>";
													echo "<h2></h2>";
													echo "<br>";
												  }
												} else {
												  echo "Nenhum resultado encontrado.";
												}
											  }
											  
											  // Fechar a conexão com o banco de dados
											  mysqli_close($conn);
											  ?>
											<button onclick="goBack()">Voltar</button>
											<script>
											function goBack() {
											window.history.back();
											}
											</script>
										</div>
								</div>
								
							</div>

						</div>
						</section>
					</div>
				</section>
			</main>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom2.js"></script>
    <script>
	    var startCharts = function () {
	                var chart1 = document.getElementById("line-chart").getContext("2d");
	                window.myLine = new Chart(chart1).Line(lineChartData, {
	                responsive: true,
	                scaleLineColor: "rgba(0,0,0,.2)",
	                scaleGridLineColor: "rgba(0,0,0,.05)",
	                scaleFontColor: "#c5c7cc "
	                });
	            }; 
	        window.setTimeout(startCharts(), 1000);
	</script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
	</body>
</html>