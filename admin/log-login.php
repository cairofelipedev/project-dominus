<?php
  session_start();

  date_default_timezone_set('America/Sao_Paulo');
  require_once "classes/conexao.php";
  require_once "classes/logar.php";
  require_once 'dbconfig.php';
  ini_set('default_charset', 'utf-8');
  include "add-log-login.php";

  if (isset($_SESSION['logado'])) :
  else :
    header("Location: login.php");
  endif;
  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logofonte.png">
  <link rel="icon" type="image/png" href="../assets/img/logofonte.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Distribuidora Dominus / Painel de Controle
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
</head>
<body>
  <div class="container bem-vindo" align="center">

    <form action="" method="POST" class="form formulario pb-4 " autocomplete="off">
      <input type="hidden" class="form-control" type="text" name="nome" value="<?php echo $_SESSION['name']; ?>" />
      <input type="hidden" class="form-control" type="text" name="tipo" value="login" />

      <button id="clickButton" type="submit" name="submit" class="btn" style="background-color:transparent;" value="ENTRAR">ENTRAR</button>
    </form>
  </div>
  <div id="preloader"></div>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
  <script type="text/javascript">
	window.setTimeout(function(){
		document.getElementById("clickButton").click();
	}, 400);
</script>
</body>

</html>