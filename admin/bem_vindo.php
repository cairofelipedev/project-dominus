<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Entrar no Sistema</title>
   <!-- Favicons -->
 <link href="../img/icone-semfundo.png" rel="icon">
  <link href="../img/icone-semfundo.png" rel="apple-touch-icon">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<?php
session_start();

	date_default_timezone_set('America/Sao_Paulo');
	require_once "classes/conexao.php";
	require_once "classes/logar.php";
	require_once 'dbconfig.php';
    ini_set('default_charset','utf-8');
    include "insert_log_login.php";	

if(isset($_SESSION['logado'])):
else:
	header("Location: login.php");
endif;
?>
<div class="container bem-vindo" align="center">

  <h1>Bem Vindo! <?php echo $_SESSION['nome']; ?></h1>

				<form action="" method="POST" class="form formulario pb-4 " autocomplete="off">
				<input type="hidden" class="form-control" type="text" name="nome" value="<?php echo $_SESSION['nome'];?>"/>
				<input type="hidden" class="form-control" type="text" name="tipo" value="login"/>
        <div class="spinner is-animating"></div>
				<input type="submit" name="submit" class="btn btn-light mt-4" value="ENTRAR"/>
        </form>

</div>
</body>
</html>