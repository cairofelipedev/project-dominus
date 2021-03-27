<?php
session_start();
require_once "classes/conexao.php";
require_once "classes/logar.php";

if (isset($_POST['ok'])):
	$login = filter_input(INPUT_POST,"login");
	$pass = filter_input(INPUT_POST,"pass");
	$_1 = new Login;
	$_1->setLogin($login);
	$_1->Setpass($pass);

	if($_1->logar()):
	header("Location:painel-controle.php");
	else:
?>
	<script>
	alert('Login ou senha invalidos ...');
	window.location.href='login.php';
	</script>
<?php
	endif;
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login - Distribuidora Dominus</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../assets/images/favicon.ico"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="/assets/fonts/iconic/css/material-design-iconic-font.min.css">

	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title p-b-48">
						<img class="img-fluid" src="../assets/images/logo1.png" width="200px">
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="login">
						<span class="focus-input100" data-placeholder="Login"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button  type="submit" name="ok" id="btn_logar" value="logar" class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>