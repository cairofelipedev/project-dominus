<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once 'dbconfig.php';
ini_set('default_charset', 'utf-8');
if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;
error_reporting(~E_ALL); // avoid notice

if (isset($_POST['btnsave'])) {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $price = $_POST['price'];
  $category = $_POST['category'];

  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];

  $imgFile2 = $_FILES['user_image2']['name'];
  $tmp_dir2 = $_FILES['user_image2']['tmp_name'];
  $imgSize2 = $_FILES['user_image2']['size'];

  $imgFile3 = $_FILES['user_image3']['name'];
  $tmp_dir3 = $_FILES['user_image3']['tmp_name'];
  $imgSize3 = $_FILES['user_image3']['size'];


  if (empty($nome)) {
    $errMSG = "Por favor Insira o nome";
  } else if (empty($imgFile)) {
    $errMSG = "Selecione imagem 1.";
  } else {
    $upload_dir = 'uploads/produtos/'; // upload directory
    $imgExt =  strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $imgExt2 = strtolower(pathinfo($imgFile2, PATHINFO_EXTENSION));
    $imgExt3 = strtolower(pathinfo($imgFile3, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $nome2 = preg_replace("/\s+/", "", $nome);
    // rename uploading image
    $userpic = $nome2 . "." . $imgExt;
    $userpic2 = $nome2 . "." . $imgExt2;
    $userpic3 = $nome2 . "." . $imgExt2;


    // allow valid image file formats
    if (in_array($imgExt, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize < 5000000) {
        move_uploaded_file($tmp_dir, $upload_dir . $userpic);
      } else {
        $errMSG = "Imagem 1 muito grande.";
      }
    }
    if (in_array($imgExt2, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize2 < 5000000) {
        move_uploaded_file($tmp_dir2, $upload_dir . $userpic2);
      } else {
        $errMSG = "Imagem 2 muito grande.";
      }
    }

    if (in_array($imgExt3, $valid_extensions)) {
      // Check file size '5MB'
      if ($imgSize3 < 5000000) {
        move_uploaded_file($tmp_dir3, $upload_dir . $userpic3);
      } else {
        $errMSG = "Imagem 3 muito grande.";
      }
    }
  }
  if (!isset($errMSG)) {
    $stmt = $DB_con->prepare('INSERT INTO produtos (nome,descricao,price,category,img,img2,img3) VALUES(:unome,:udescricao,:uprice,:ucategory,:upic,:upic2,:upic3)');
    $stmt->bindParam(':unome', $nome);
    $stmt->bindParam(':udescricao', $descricao);
    $stmt->bindParam(':uprice', $price);
    $stmt->bindParam(':ucategory', $category);
    $stmt->bindParam(':upic', $userpic);

    if (empty($imgFile2)) {
      $stmt->bindValue(':upic2', $nulo);
      $nulo = '';
    }

    if (!empty($imgFile2)) {
      $stmt->bindParam(':upic2', $userpic2);
    }

    if (empty($imgFile3)) {
      $stmt->bindValue(':upic3', $nulo);
      $nulo = '';
    }

    if (!empty($imgFile3)) {
      $stmt->bindParam(':upic3', $userpic3);
    }


    if ($stmt->execute()) {
      echo ("<script type= 'text/javascript'>alert('Produto adicionado com sucesso.');</script>
        <script>window.location = 'painel-produtos.php';</script>");
    } else {
      $errMSG = "Erro Interno..";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicon.ico">
  <link rel="icon" type="image/png" href="../assets/images/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Painel Produtos / Distribuidora Dominus
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include 'nav.php' ?>
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
              }
              ?>
              <h5 class="title">Adicionar produto</h5>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <p class="title text-center">Informações</p>
                    <div class="border p-3 rounded">
                      <div class="form-group">
                        <label class="title">Nome do produto</label>
                        <input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" placeholder="Nome">
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Valor</label>
                            <input value="<?php echo $price; ?>" name="price" type="text" class="form-control" placeholder="Valor do produto">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Categoria</label>
                            <select name="category" class="form-control">
                              <option value='Utilidades Domésticas'>Utilidades Domésticas</option>
                              <option value='Jardinagem'>Jardinagem</option>
                              <option value='Embalagem'>Embalagem</option>
                              <option value='Pets'>Pets</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="title">Descrição</label>
                        <textarea rows="4" cols="80" name="descricao" class="form-control" placeholder="Descreva as principais caracteristicas do seu produto"><?php echo $descricao; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <p class="title text-center">Imagens</p>
                    <div class="border p-3 rounded">
                      <div class="form-group">
                        <label class="title">Imagem 1</label>
                        <br>
                        <input type="file" name="user_image" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label class="title">Imagem 2</label>
                        <br>
                        <input type="file" name="user_image2" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label class="title">Imagem 3</label>
                        <br>
                        <input type="file" name="user_image3" accept="image/*" />
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" name="btnsave" class="btn btn-info">
                  <span class="glyphicon glyphicon-save"></span>Salvar
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
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
</body>

</html>