<?php
session_start();
require_once "classes/conexao.php";
require_once "classes/logar.php";
ini_set('default_charset', 'utf-8');
require_once 'dbconfig.php';
error_reporting(~E_WARNING);
error_reporting(~E_NOTICE);

if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;

if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
  $id = $_GET['edit_id'];
  $stmt_edit = $DB_con->prepare('SELECT nome,cpf_cnpj,email,endereco,whats,telefone2,nome_arq1,arq1,id_estadual,data_nascimento FROM clientes WHERE id =:uid');
  $stmt_edit->execute(array(':uid' => $id));
  $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);
} else {
  header("Location: painel.php");
}

if (isset($_POST['btnsave'])) {
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $estado_civil = $_POST['estado_civil'];
  $email = $_POST['email'];
  $renda_tipo = $_POST['renda_tipo'];
  $renda_valor = $_POST['renda_valor'];

  $endereco = $_POST['endereco'];
  $telefone1 = $_POST['telefone1'];
  $telefone2 = $_POST['telefone2'];
  $status = $_POST['status'];

  $nome_arq1 = $_POST['nome_arq1'];
  $nome_arq2 = $_POST['nome_arq2'];

  $equipe = $_POST['equipe'];
  $restricao = $_POST['restricao'];
  $preferencia = $_POST['preferencia'];

  $cidade = $_POST['cidade'];
  $fgts = $_POST['fgts'];
  $dependente = $_POST['dependente'];
  $valor_imovel = $_POST['valor_imovel'];
  $corretor = $_POST['corretor'];

  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];

  $imgFile2 = $_FILES['user_image2']['name'];
  $tmp_dir2 = $_FILES['user_image2']['tmp_name'];
  $imgSize2 = $_FILES['user_image2']['size'];

  if ($imgFile) {
    $upload_dir = 'images/clientes/'; // upload directory	
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $nome2 = preg_replace("/\s+/", "", $nome);
    $userpic = $nome2 . "-edit1." . $imgExt;
    if (in_array($imgExt, $valid_extensions)) {
      if ($imgSize < 5000000) {
        unlink($upload_dir . $edit_row['arq1']);
        move_uploaded_file($tmp_dir, $upload_dir . $userpic);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF files are allowed.";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic = $edit_row['arq1']; // old image from database
  }
  if ($imgFile2) {
    $upload_dir = 'images/clientes/'; // upload directory	
    $imgExt2 = strtolower(pathinfo($imgFile2, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $nome2 = preg_replace("/\s+/", "", $nome);
    $userpic2 = $nome2 . "-edit2." . $imgExt2;
    if (in_array($imgExt2, $valid_extensions)) {
      if ($imgSize2 < 5000000) {
        unlink($upload_dir . $edit_row['arq2']);
        move_uploaded_file($tmp_dir2, $upload_dir . $userpic2);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic2 = $edit_row['arq2']; // old image from database
  }

  if (!isset($errMSG)) {
    $stmt = $DB_con->prepare('UPDATE clientes
        SET 
        nome=:unome,
        cpf=:ucpf,
        estado_civil=:uestado_civil,
        email=:uemail,
        renda_tipo=:urenda_tipo,
        renda_valor=:urenda_valor,
        endereco=:uendereco,
        telefone1=:utelefone1,
        telefone2=:utelefone2,
        nome_arq1=:unome_arq1,
        nome_arq2=:unome_arq2,
        arq1=:upic,
        arq2=:upic2,
        equipe=:uequipe,
        preferencia=:upreferencia,
        restricao=:urestricao,
        cidade=:ucidade,
        fgts=:ufgts,
        dependente=:udependente,
        valor_imovel=:uvalor_imovel,
        corretor=:ucorretor,
        status=:ustatus
        WHERE id=:uid');

    $stmt->bindParam(':unome', $nome);
    $stmt->bindParam(':ucpf', $cpf);
    $stmt->bindParam(':uestado_civil', $estado_civil);
    $stmt->bindParam(':uemail', $email);
    $stmt->bindParam(':urenda_tipo', $renda_tipo);
    $stmt->bindParam(':urenda_valor', $renda_valor);
    $stmt->bindParam(':uendereco', $endereco);
    $stmt->bindParam(':utelefone1', $telefone1);
    $stmt->bindParam(':utelefone2', $telefone2);
    $stmt->bindParam(':ustatus', $status);
    $stmt->bindParam(':uid', $id);

    $stmt->bindParam(':unome_arq1', $nome_arq1);
    $stmt->bindParam(':unome_arq2', $nome_arq2);

    $stmt->bindParam(':uequipe', $equipe);
    $stmt->bindParam(':urestricao', $restricao);
    $stmt->bindParam(':upreferencia', $preferencia);

    $stmt->bindParam(':ucidade', $cidade);
    $stmt->bindParam(':ufgts', $fgts);
    $stmt->bindParam(':udependente', $dependente);
    $stmt->bindParam(':ucorretor', $corretor);
    $stmt->bindParam(':uvalor_imovel', $valor_imovel);

    if (empty($imgFile)) {
      $stmt->bindValue(':upic', $nulo);
      $nulo = '';
    }

    if (!empty($imgFile)) {
      $stmt->bindParam(':upic', $userpic);
    }

    if (empty($imgFile2)) {
      $stmt->bindValue(':upic2', $nulo2);
      $nulo2 = '';
    }

    if (!empty($imgFile2)) {
      $stmt->bindParam(':upic2', $userpic2);
    }



    if ($stmt->execute()) {
?>
      <script>
        alert('Cliente atualizado...');
        window.location.href = 'painel-clientes.php';
      </script>
<?php
    } else {
      $errMSG = "Erro!";
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
            <div class="card">
              <div class="card-header">
                <h5 class="title">Editar Cliente</h5>
              </div>
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="<?php echo $nome; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>CPF/CNPJ</label>
                        <input type="text" name="cpf_cnpj" class="form-control" placeholder="CPF" value="<?php echo $cpf_cnpj; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="endereco" class="form-control" placeholder="Endereço Completo" value="<?php echo $endereco; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Whatsapp</label>
                        <input value="<?php echo $whats; ?>" type="text" name="whats" class="form-control" placeholder="Número">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Telefone 2</label>
                        <input type="text" value="<?php echo $telefone2; ?>" name="telefone2" class="form-control" placeholder="Número 2">
                      </div>
                    </div>
                  </div>
              </div>
              <hr>
              <div class="container">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Inscrição Estadual</label>
                    <input value="<?php echo $id_estadual; ?>" type="text" name="id_estadual" class="form-control" placeholder="Cidade">
                  </div>
                </div>
              </div>
              <div class="container">
              <h5>Arquivos</h5>
              <?php
              if (!($arq1 == '')) {
              ?>
                <i class='bi bi-file-earmark-text-fill'></i> Arquivo 1 - <a target="_blank" href="images/clientes/<?php echo $row['arq1']; ?>">Visualizar</a>
                <br>
              <?php
              }
              ?>
              <?php
              if ($arq1 == '') {
              ?>
                <input type="text" name="nome_arq1" class="form-control" placeholder="Nome do Arquivo 1">
                <br>
                <input class="input-group" type="file" name="user_image" accept="image/*" />
              <?php
              }
              ?>
              <button type="submit" name="btnsave" class="btn btn-primary shadow-sm mt-4">
                <span class="glyphicon glyphicon-save"></span><i class="fas fa-download fa-sm text-white-50"></i>Enviar
              </button>
              </form>
            </div>

            </div>
      </div>

  <?php include "footer.php"; ?>
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
