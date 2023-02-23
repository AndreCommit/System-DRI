
<?php
session_start();
if((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true))
	{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location: login.html');
	}
$logado = $_SESSION['login'];

    // Conecte-se ao banco de dados
    $servername = "localhost";
    $usernameDB = "";
    $passwordDB = "";
    $dbname = "";

    $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico">
	<title>Painel Principal.</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
			<h1 class="site-title"><a href="chamwynadm.php">Desenvolvimento André</a></h1>
													
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item"><a class="nav-link active" href="chamwynadm.php"><em class="fa fa-bar-chart"></em> Painel <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="paineluser.php"><em class="fa fa-calendar-o"></em> Painel Plansul</a></li>
					<li class="nav-item"><a class="nav-link" href="inserirtabela.php"><em class="fa fa-calendar-o"></em> Consulta/Registros</a></li>
					<li class="nav-item"><a class="nav-link" href="chamadoff.php"><em class="fa fa-hand-o-up"></em> Chamados OFF</a></li>
					<li class="nav-item"><a class="nav-link" href="relatorio.php"><em class="fa fa-pencil-square-o"></em> Relatórios</a></li>
				</ul>
				<a href="chamwynadm.php" class="logout-button"><img src="img/logoWT-1-300x75.png" style="width: 95%"></a>
			</nav>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h5 class="float-left text-center text-md-left">Painel Principal</h5>
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
						     <a class="dropdown-item" href="logoff.php"><em class="fa fa-power-off mr-1"></em> Logout</a></div>
					</div>
					<div class="clear"></div>
				</header>
				
					<div class="col-sm-12">
						<section class="row">
						<div class="col-sm-12 col-md-6">
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title">Inserir Registros.</h3>
											<form class="buscar" action="inserir.php" id="buscar" method="post">
												<br> <br>
												<h1>Estação:</h1>
												<input type="text" name="et" id="et" placeholder="Nome Lógico"/>
												<input type="button" onclick="pesquisarEt(document.getElementById('et').value)" value="Buscar"/>
												<br><br>
												<h1>Número de Série:</h1>
												<input type="text" class="numserie" readonly="" name="numserie" id="numserie" placeholder="Numero de serie"/>
												<br><br>
												<h2></h2>
												<h1>Ocorrência:</h1>
												<select name="motivo" id="motivo">
												<option value=""></option>
													<option value="BAIXA DE IMAGEM">BAIXA DE IMAGEM</option>
													<option value="TELA AZUL">TELA AZUL</option>
													<option value="FORA DO DOMINIO">FORA DO DOMINIO</option>
													<option value="REPARO AUTOMÁTICO">REPARO AUTOMÁTICO</option>
													<option value="SUJEIRA / LIMPEZA">SUJEIRA / LIMPEZA</option>
													<option value="MONITOR COM DEFEITO">MONITOR COM DEFEITO</option>
													<option value="NAO LIGA">NÃO LIGA</option>
													<option value="LENTIDAO">LENTIDAO</option>
												</select>
												<BR>
												<br>
												<h1>Status:</h1>
												<select name="status">
													<option value="" selected></option>
													<option value="aberto">Abrir chamado</option>
												</select>
												<br>
												<br>
												<h2></h2>
												<input type="submit" value="Registrar">
												<br>
											</form>
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-6 ">
								<div class="card mb-4">
									<div class="card-block">
										<h3 class="card-title">Chamados Abertos.</h3>

											<?php
												// Consulta à tabela
												$result = mysqli_query($conn, "SELECT * FROM dados_wyntech WHERE status='aberto' ORDER BY data DESC LIMIT 12");

												// Verifica se a consulta retornou algum resultado
												if (mysqli_num_rows($result) > 0) {
													echo "<table>";
													echo "<tr>";
													echo "<th>ID</th>";
													echo "<th>Nome Lógico</th>";
													echo "<th>Num/Serie</th>";
													echo "<th>Motivo</th>";
													echo "</tr>";
	
													// Exibe os resultados da consulta na tabela
													while ($row = mysqli_fetch_assoc($result)) {
														echo "<tr>";
														echo "<td>" . $row["id"] . "</td>";
														echo "<td>" . $row["et"] . "</td>";
														echo "<td>" . $row["numserie"] . "</td>";
														echo "<td>" . $row["motivo"] . "</td>";
														echo "</tr>";
														
													}
													echo "</table>";
												} else {
													echo "Não foram encontrados resultados.";
												}
											?>
											<h2></h2>
											<h1>Verificar todos os chamados abertos</h1>
											<form action="consulta2.php">
											<input type="submit" value="Buscar"/>
											</form>
									</div>
								</div>
							</div>
					
						
							<div class="col-sm-12 col-md-6">
							
								<div class="card mb-4">
									<div class="card-block">
										
											<h3 class="card-title">Chamados Registrados.</h3>
										<?php
											// Consulta à tabela
											$result = mysqli_query($conn, "SELECT * FROM dados_wyntech WHERE status='registrado' ORDER BY ID DESC LIMIT 15");

											// Verifica se a consulta retornou algum resultado
											if (mysqli_num_rows($result) > 0) {
												echo "<table>";
												echo "<tr>";
												echo "<th>Nome Lógico</th>";
												echo "<th>data</th>";
												echo "<th>Suporte</th>";
												echo "<th>REQ</th>";
												echo "</tr>";

												// Exibe os resultados da consulta na tabela
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<tr>";
													echo "<td>" . $row["et"] . "</td>";
													echo "<td>" . $row["data"] . "</td>";
													echo "<td>" . $row["usuario"] . "</td>";
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
										<h2></h2>
											<h1>Verificar todos os chamados Registrados</h1>
											<form action="consulta.php">
											<input type="submit" value="Buscar"/>
											</form>

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
