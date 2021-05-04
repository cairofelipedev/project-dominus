<?php
session_start();
require_once "classes/conexao.php";
require_once "classes/logar.php";
ini_set('default_charset', 'utf-8');
require_once 'dbconfig.php';
error_reporting(~E_ALL);


$nome = $_GET['nome'];
$whats = $_GET['whats'];
$email = $_GET['email'];

if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;

if (isset($_POST['btnsave'])) {
  $nome = $_POST['nome'];
  $cpf_cnpj = $_POST['cpf_cnpj'];
  $email = $_POST['email'];
  $endereco = $_POST['endereco'];
  $whats = $_POST['whats'];
  $telefone2 = $_POST['telefone2'];
  $data_nascimento = $_POST['data_nascimento'];
  $tipo = $_POST['tipo'];
  $user_create = $_POST['user_create'];
  $id_estadual = $_POST['id_estadual'];
  $nome_arq1 = $_POST['nome_arq1'];
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];


  // function validaCPF($cpf) {

  // Extrai somente os números
  //  $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

  // Verifica se foi informado todos os digitos corretamente
  // if (strlen($cpf) != 11) {
  //   return false;
  // }
  // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
  //   if (preg_match('/(\d)\1{10}/', $cpf)) {
  //    return false;
  //  }
  // Faz o calculo para validar o CPF
  //  for ($t = 9; $t < 11; $t++) {
  //    for ($d = 0, $c = 0; $c < $t; $c++) {
  //         $d += $cpf{$c} * (($t + 1) - $c);
  //    }
  //    $d = ((10 * $d) % 11) % 10;
  //    if ($cpf{$c} != $d) {
  //       return false;
  //   }
  // }
  // return true;
  // }
  // if (validaCPF($cpf)==false) {
  //  $errMSG = "CPF INVALIDO";
  // }
  if (empty($nome)) {
    $errMSG = "Por favor Insira o nome";
  } elseif (empty($nome_arq1) and (!empty($imgFile))) {
    $errMSG = "Por favor Insira o nome do arquivo";
  } else {

    $upload_dir = 'images/clientes/'; // upload directory

    $imgExt =  strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $imgExt2 = strtolower(pathinfo($imgFile2, PATHINFO_EXTENSION));

    $valid_extensions = array('jpeg', 'jpg', 'png', 'pdf'); // valid extensions

    $nome2 = preg_replace("/\s+/", "", $nome);
    // rename uploading image
    $userpic = $nome2 . "-arquivo1." . $imgExt;
    $userpic2  = $nome2 . "-arquivo2." . $imgExt2;

    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize < 5000000) {
        move_uploaded_file($tmp_dir, $upload_dir . $userpic);
      } else {
        $errMSG = "Imagem 1 muito grande.";
      }
    } else {
    }
    if (in_array($imgExt2, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize2 < 5000000) {
        move_uploaded_file($tmp_dir2, $upload_dir . $userpic2);
      } else {
        $errMSG = "Imagem 2 muito grande.";
      }
    } else {
    }
  }
  if (!isset($errMSG)) {
    $stmt = $DB_con->prepare('INSERT INTO clientes (nome,cpf_cnpj,email,endereco,whats,telefone2,tipo,user_create,arq1,nome_arq1,id_estadual,data_nascimento) VALUES(:unome,:ucpf_cnpj,:uemail,:uendereco,:whats,:utelefone2,:utipo,:uuser_create,:upic,:unome_arq1,:uid_estadual,:udata_nascimento)');
    $stmt->bindParam(':unome', $nome);
    $stmt->bindParam(':ucpf_cnpj', $cpf_cnpj);
    $stmt->bindParam(':uemail', $email);
    $stmt->bindParam(':uendereco', $endereco);
    $stmt->bindParam(':whats', $whats);
    $stmt->bindParam(':utelefone2', $telefone2);
    $stmt->bindParam(':utipo', $tipo);
    $stmt->bindParam(':udata_nascimento', $data_nascimento);
    $stmt->bindParam(':uid_estadual', $id_estadual);
    $stmt->bindParam(':uuser_create', $user_create);
    $stmt->bindParam(':unome_arq1', $nome_arq1);

    if (empty($imgFile)) {
      $stmt->bindValue(':upic', $nulo);
      $nulo = '';
    }

    if (!empty($imgFile)) {
      $stmt->bindParam(':upic', $userpic);
    }

    if ($stmt->execute()) {
      $successMSG = "Cliente cadastrado com sucesso ...";
      header("refresh:3;painel-clientes.php"); // redirects image view page after 5 seconds.
    } else {
      $errMSG = "Erro.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="../assets/images/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Distribuidora Dominus / Adicionar Cliente
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="./assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="./assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
</head>
<?php
if (($_SESSION['type'] != 1) and ($_SESSION['type'] != 2)) {
  echo ("
    <script type= 'text/javascript'>alert('Acesso Restrito!');</script>
    <script>window.location = 'painel.php';</script>");
}
?>

<body>
  <div class="wrapper">
    <?php include "nav.php" ?>

    <div class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="card-header">
              <?php
              if (isset($errMSG)) {
              ?>
                <div class="alert alert-danger">
                  <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                </div>
              <?php
              } else if (isset($successMSG)) {
              ?>
                <div class="alert alert-success">
                  <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
                </div>
              <?php
              }
              ?>
              <h5 class="title">Adicionar Cliente</h5>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                      <label for="">TIPO</label>
                      <select name="tipo" class="form-control">
                        <option value='CPF'>CPF</option>
                        <option value='CNPJ'>CNPJ</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>Nome/RAZÃO SOCIAL</label>
                      <input type="text" name="nome" class="form-control" placeholder="Nome ou Razão Social">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>CPF/CNPJ</label>
                      <input type="text" name="cpf_cnpj" class="form-control" placeholder="CPF ou CNPJ">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Data de Nascimento</label>
                      <input type="text" name="data_nascimento" class="form-control" placeholder="00/00/0000">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Inscrição Estadual</label>
                      <input type="text" name="id_estadual" class="form-control" placeholder="Inscrição Estadual">
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                      <label>Endereço Completo</label>
                      <input type="text" name="endereco" class="form-control" placeholder="Endereço Completo">
                    </div>
                  </div>
                <div class="col-md-2 pr-1">
                    <div class="form-group">
                      <label>Email</label>
                      <input value="<?php echo $email; ?>" type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Whats</label>
                      <input type="text" value="<?php echo $whats; ?>" name="whats" class="form-control" placeholder="Número 1">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Telefone 2</label>
                      <input type="text" name="telefone2" class="form-control" placeholder="Número 2">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                    <label class="control-label">Arquivo</label>
                <input type="text" name="nome_arq1" class="form-control" placeholder="Nome do Arquivo 1">
                <br>
                <input class="input-group" type="file" name="user_image" accept="image/*" />
                    </div>
                  </div>
                  <input type="hidden" name="user_create" value="<?php echo $_SESSION['name']; ?>" />
                </div>

        
          
                <button type="submit" name="btnsave" class="btn btn-primary shadow-sm mt-4">
                  <span class="glyphicon glyphicon-save"></span><i class="fas fa-download fa-sm text-white-50"></i>Enviar
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </div>
  </div>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js" integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js" integrity="sha512-vCgNjt5lPWUyLz/tC5GbiUanXtLX1tlPXVFaX5KAQrUHjwPcCwwPOLn34YBFqws7a7+62h7FRvQ1T0i/yFqANA==" crossorigin="anonymous"></script>
  <script src="./assets/js/owl.carousel.min.js"></script>
  <script src="./assets/js/now-ui-dashboard.js" type="text/javascript"></script>

</body>

</html>