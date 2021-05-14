<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once 'dbconfig.php';
ini_set('default_charset', 'utf-8');
if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;
error_reporting(~E_NOTICE);

if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
  $id = $_GET['edit_id'];
  $stmt_edit = $DB_con->prepare('SELECT nome,descricao,price,category,img,img2,img3,status FROM produtos WHERE id =:uid');
  $stmt_edit->execute(array(':uid' => $id));
  $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);
} else {
  header("Location: painel_planos.php");
}

if (isset($_POST['btnsave'])) {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $price = $_POST['price'];
  $category = $_POST['category'];

  $status = $_POST['status'];

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
  }

  if ($imgFile) {
    $upload_dir = 'uploads/produtos/'; // upload directory	
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $userpic = $nome . "-edit1." . $imgExt;
    if (in_array($imgExt, $valid_extensions)) {
      if ($imgSize < 5000000) {
        unlink($upload_dir . $edit_row['img']);
        move_uploaded_file($tmp_dir, $upload_dir . $userpic);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF files are allowed.";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic = $edit_row['img']; // old image from database
  }
  if ($imgFile2) {
    $upload_dir = 'uploads/produtos/'; // upload directory	
    $imgExt2 = strtolower(pathinfo($imgFile2, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $userpic2 = $nome . "-edit2." . $imgExt2;
    if (in_array($imgExt2, $valid_extensions)) {
      if ($imgSize2 < 5000000) {
        unlink($upload_dir . $edit_row['img2']);
        move_uploaded_file($tmp_dir2, $upload_dir . $userpic2);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic2 = $edit_row['img2']; // old image from database
  }
  if ($imgFile3) {
    $upload_dir = 'uploads/produtos/'; // upload directory	
    $imgExt3 = strtolower(pathinfo($imgFile3, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $userpic3 = $nome . "-edit3." . $imgExt3;
    if (in_array($imgExt3, $valid_extensions)) {
      if ($imgSize3 < 5000000) {
        unlink($upload_dir . $edit_row['img3']);
        move_uploaded_file($tmp_dir3, $upload_dir . $userpic3);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic3 = $edit_row['img3']; // old image from database
  }
  if (!isset($errMSG)) {
    $stmt = $DB_con->prepare('UPDATE produtos SET nome=:unome,descricao=:udescricao,price=:uprice,category=:ucategory,img=:upic,img2=:upic2,status=:ustatus,img3=:upic3 WHERE id=:uid');
    $stmt->bindParam(':unome', $nome);
    $stmt->bindParam(':udescricao', $descricao);
    $stmt->bindParam(':uprice', $price);
    $stmt->bindParam(':ucategory', $category);
    $stmt->bindParam(':uid', $id);
    $stmt->bindParam(':upic', $userpic);
    $stmt->bindParam(':upic2', $userpic2);
    $stmt->bindParam(':upic3', $userpic3);
    $stmt->bindParam(':ustatus', $status);

    if ($stmt->execute()) {
      echo ("<script type= 'text/javascript'>alert('Produto atualizado com sucesso.');</script>
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
  <link href="../assets/img/favicon.ico" rel="icon">
  <link href="../assets/img/logo.png" rel="apple-touch-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Rancher / Editar Produto
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="./assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="./assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
</head>

<body class="user-profile">
  <div class="wrapper ">
    <?php include 'nav.php' ?>
    <div class="content">
      <div class="row">
        <div class="col-md-12">
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
                  <div class="col-md-5">
                    <p class="title text-center">Informações</p>
                    <div class="border p-3 rounded">
                      <div class="form-group">
                        <label class="title">Nome do produto</label>
                        <input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" placeholder="Nome">
                      </div>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label class="title">Valor</label>
                            <input value="<?php echo $price; ?>" name="price" type="text" class="form-control" placeholder="Valor do produto">
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group">
                            <label class="title">Categoria</label>
                            <select name="category" class="form-control">

                              <option value='<?php echo $category; ?>'><?php echo $category; ?></option>
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
                      <div class="form-group">
                        <label class="title">ATIVO</label>
                        <select name="status" class="form-control">

                          <option value='<?php echo $status; ?>'><?php echo $status; ?></option>
                          <option value='ATIVO'>SIM</option>
                          <option value='DESATIVADO'>NÃO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <p class="title text-center">Imagens</p>
                    <div class="border p-3 rounded">
                      <div class="form-group">
                        <label class="title">Imagem 1</label>
                        <br>
                        <img src="uploads/produtos/<?php echo $img; ?>" class="img-fluid pb-2" onerror="this.src='./assets/img/sem.jpg'" width="150px" />
                        <input type="file" name="user_image" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label class="title">Imagem 2</label>
                        <br>
                        <img src="uploads/produtos/<?php echo $img2; ?>" class="img-fluid pb-2" onerror="this.src='./assets/img/sem.jpg'" width="150px" />
                        <input type="file" name="user_image2" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label class="title">Imagem 3</label>
                        <br>
                        <img src="uploads/produtos/<?php echo $img3; ?>" class="img-fluid pb-2" onerror="this.src='./assets/img/sem.jpg'" width="150px" />
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