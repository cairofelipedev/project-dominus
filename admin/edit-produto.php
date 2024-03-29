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
  $stmt_edit = $DB_con->prepare('SELECT nome,descricao,price,category,img,img2,img3,img4,img5,img6,status,cod,altura,profu,largura,cor1,cor2,cor3,cor4,cor5,desconto,valor_desconto,peso FROM produtos WHERE id =:uid');
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
  $cod = $_POST['cod'];
  $altura = $_POST['altura'];
  $profu = $_POST['profu'];
  $largura = $_POST['largura'];
  $cor1 = $_POST['cor1'];
  $cor2 = $_POST['cor2'];
  $cor3 = $_POST['cor3'];
  $cor4 = $_POST['cor4'];
  $cor5 = $_POST['cor5'];
  $desconto = $_POST['desconto'];
  $valor_desconto = $_POST['valor_desconto'];
  $peso = $_POST['peso'];

  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];

  $imgFile2 = $_FILES['user_image2']['name'];
  $tmp_dir2 = $_FILES['user_image2']['tmp_name'];
  $imgSize2 = $_FILES['user_image2']['size'];

  $imgFile3 = $_FILES['user_image3']['name'];
  $tmp_dir3 = $_FILES['user_image3']['tmp_name'];
  $imgSize3 = $_FILES['user_image3']['size'];

  $imgFile4 = $_FILES['user_image4']['name'];
  $tmp_dir4 = $_FILES['user_image4']['tmp_name'];
  $imgSize4 = $_FILES['user_image4']['size'];

  $imgFile5 = $_FILES['user_image5']['name'];
  $tmp_dir5 = $_FILES['user_image5']['tmp_name'];
  $imgSize5 = $_FILES['user_image5']['size'];

  $imgFile6 = $_FILES['user_image6']['name'];
  $tmp_dir6 = $_FILES['user_image6']['tmp_name'];
  $imgSize6 = $_FILES['user_image6']['size'];


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

  if ($imgFile4) {
    $upload_dir = 'uploads/produtos/'; // upload directory	
    $imgExt4 = strtolower(pathinfo($imgFile4, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $userpic4 = $nome . "-edit4." . $imgExt4;
    if (in_array($imgExt3, $valid_extensions)) {
      if ($imgSize4 < 5000000) {
        unlink($upload_dir . $edit_row['img4']);
        move_uploaded_file($tmp_dir4, $upload_dir . $userpic4);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic4 = $edit_row['img4']; // old image from database
  }

  if ($imgFile5) {
    $upload_dir = 'uploads/produtos/'; // upload directory	
    $imgExt5 = strtolower(pathinfo($imgFile5, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $userpic5 = $nome . "-edit5." . $imgExt5;
    if (in_array($imgExt5, $valid_extensions)) {
      if ($imgSize5 < 5000000) {
        unlink($upload_dir . $edit_row['img5']);
        move_uploaded_file($tmp_dir5, $upload_dir . $userpic5);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic5 = $edit_row['img5']; // old image from database
  }

  if ($imgFile6) {
    $upload_dir = 'uploads/produtos/'; // upload directory	
    $imgExt6 = strtolower(pathinfo($imgFile6, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $userpic6 = $nome . "-edit6." . $imgExt6;
    if (in_array($imgExt6, $valid_extensions)) {
      if ($imgSize6 < 5000000) {
        unlink($upload_dir . $edit_row['img6']);
        move_uploaded_file($tmp_dir6, $upload_dir . $userpic6);
      } else {
        $errMSG = "Imagem grande demais, max 5MB";
      }
    } else {
      $errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";
    }
  } else {
    // if no image selected the old image remain as it is.
    $userpic6 = $edit_row['img6']; // old image from database
  }
  if (!isset($errMSG)) {
    $stmt = $DB_con->prepare('UPDATE produtos SET 
    nome=:unome,
    descricao=:udescricao,
    price=:uprice,
    category=:ucategory,
    img=:upic,
    img2=:upic2,
    status=:ustatus,
    cod=:ucod,
    altura=:ualtura,
    largura=:ulargura,
    profu=:uprofu,
    cor1=:ucor1,
    cor2=:ucor2,
    cor3=:ucor3,
    cor4=:ucor4,
    cor5=:ucor5,
    desconto=:udesconto,
    valor_desconto=:uvalor_desconto,
    peso=:upeso,
    img3=:upic3, 
    img4=:upic4,
    img5=:upic5,
    img6=:upic6
    WHERE id=:uid');
    $stmt->bindParam(':uid', $id);
    $stmt->bindParam(':unome', $nome);
    $stmt->bindParam(':udescricao', $descricao);
    $stmt->bindParam(':uprice', $price);
    $stmt->bindParam(':ucategory', $category);
    $stmt->bindParam(':ustatus', $status);
    $stmt->bindParam(':ucod', $cod);
    $stmt->bindParam(':ualtura', $altura);
    $stmt->bindParam(':uprofu', $profu);
    $stmt->bindParam(':ulargura', $largura);
    $stmt->bindParam(':ucor1', $cor1);
    $stmt->bindParam(':ucor2', $cor2);
    $stmt->bindParam(':ucor3', $cor3);
    $stmt->bindParam(':ucor4', $cor4);
    $stmt->bindParam(':ucor5', $cor5);
    $stmt->bindParam(':upeso', $peso);
    $stmt->bindParam(':upic', $userpic);
    $stmt->bindParam(':upic2', $userpic2);
    $stmt->bindParam(':upic3', $userpic3);
    $stmt->bindParam(':upic4', $userpic4);
    $stmt->bindParam(':upic5', $userpic5);
    $stmt->bindParam(':upic6', $userpic6);

    if (empty($desconto)) {
      $stmt->bindValue(':udesconto', $nulo);
      $stmt->bindValue(':uvalor_desconto', $nulo);
      $nulo = '';
    }

    if (!empty($desconto)) {
      $stmt->bindParam(':udesconto', $desconto);
      $valor_desconto = $price - ($price / 100 * $desconto);
      $stmt->bindParam(':uvalor_desconto', $valor_desconto);
    }

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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicon.ico">
  <link rel="icon" type="image/png" href="../assets/images/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Editar Produto / Distribuidora Dominus
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
                  <div class="col-md-6">
                    <p class="title text-center">Informações</p>
                    <div class="border p-3 rounded">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Nome do produto</label>
                            <input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" placeholder="Nome">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Status</label>
                            <select name="status" class="form-control">
                              <option value='<?php echo $status; ?>'>
                                <?php
                                if ($status == '1') {
                                  echo "ATIVO";
                                }
                                if ($status == '2') {
                                  echo "OFERTA";
                                }
                                if ($status == '3') {
                                  echo "NOVIDADE";
                                }
                                if ($status == '4') {
                                  echo "DESATIVADO";
                                }
                                ?>
                              </option>
                              <option value='1'>ATIVO</option>
                              <option value='2'>OFERTA</option>
                              <option value='3'>NOVIDADE</option>
                              <option value='4'>DESATIVADO</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Valor</label>
                            <input value="<?php echo $price; ?>" name="price" type="text" class="form-control" placeholder="Valor do produto">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Desconto</label>
                            <input value="<?php echo $desconto; ?>" name="desconto" type="text" class="form-control" placeholder="Desconto (Opcional)">
                            <input value="<?php echo $valor_desconto; ?>" name="valor_desconto" type="hidden">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <a href="add-category.php">
                              Adicionar Categoria <i class="bi bi-plus-circle-fill"></i>
                            </a>
                            <br>
                            <label class="title">Categoria</label>
                            <select name="category" class="form-control">
                              <option value='<?php echo $category ?>'><?php echo $category ?></option>
                              <?php
                              $stmt = $DB_con->prepare("SELECT id,nome,tipo FROM categorys where tipo='produto' ORDER BY id DESC");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                              ?>
                                  <option value='<?php echo $nome ?>'><?php echo $nome ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="title">Código de Referência</label>
                            <input value="<?php echo $cod; ?>" name="cod" type="text" class="form-control" placeholder="Código do Produto">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="title">Descrição</label>
                        <textarea rows="4" cols="80" name="descricao" class="form-control" placeholder="Descreva as principais caracteristicas do seu produto"><?php echo $descricao; ?></textarea>
                      </div>
                      <p class="title text-center">Especificações</p>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Altura</label>
                            <input value="<?php echo $altura; ?>" name="altura" type="text" class="form-control" placeholder="Altura do Produto">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Largura</label>
                            <input value="<?php echo $largura; ?>" name="largura" type="text" class="form-control" placeholder="Largura do Produto">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Profundidade</label>
                            <input value="<?php echo $profu; ?>" name="profu" type="text" class="form-control" placeholder="Profundidade do Produto">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Peso</label>
                            <input value="<?php echo $peso; ?>" name="peso" type="text" class="form-control" placeholder="Peso do Produto">
                          </div>
                        </div>
                      </div>
                      <p class="title text-center">Cores</p>
                      <a href="add-cor.php">
                        Adicionar Cor <i class="bi bi-plus-circle-fill"></i>
                      </a>
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Cor 1</label>
                            <select name="cor1" class="form-control">
                              <?php
                              if ($cor1 == '') {
                                echo "<option value=''>Escolha uma cor</option>";
                              } else {
                                echo "<option value='$cor1'>$cor1</option>";
                              }
                              ?>
                              <option value=''>Remover Cor</option>
                              <?php
                              $stmt = $DB_con->prepare("SELECT id,cor FROM colors ORDER BY id DESC");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                              ?>
                                  <option value='<?php echo $cor ?>'><?php echo $cor ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Cor 2</label>
                            <select name="cor2" class="form-control">
                              <?php
                              if ($cor2 == '') {
                                echo "<option value=''>Escolha uma cor</option>";
                              } else {
                                echo "<option value='$cor2'>$cor2</option>";
                              }
                              ?>
                              <option value=''>Remover Cor</option>
                              <?php
                              $stmt = $DB_con->prepare("SELECT id,cor FROM colors ORDER BY id DESC");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                              ?>
                                  <option value='<?php echo $cor ?>'><?php echo $cor ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Cor 3</label>
                            <select name="cor3" class="form-control">
                              <?php
                              if ($cor3 == '') {
                                echo "<option value=''>Escolha uma cor</option>";
                              } else {
                                echo "<option value='$cor3'>$cor3</option>";
                              }
                              ?>
                              <option value=''>Remover Cor</option>
                              <?php
                              $stmt = $DB_con->prepare("SELECT id,cor FROM colors ORDER BY id DESC");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                              ?>
                                  <option value='<?php echo $cor ?>'><?php echo $cor ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Cor 4</label>
                            <select name="cor4" class="form-control">
                              <?php
                              if ($cor4 == '') {
                                echo "<option value=''>Escolha uma cor</option>";
                              } else {
                                echo "<option value='$cor4'>$cor4</option>";
                              }
                              ?>
                              <option value=''>Remover Cor</option>
                              <?php
                              $stmt = $DB_con->prepare("SELECT id,cor FROM colors ORDER BY id DESC");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                              ?>
                                  <option value='<?php echo $cor ?>'><?php echo $cor ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="title">Cor 5</label>
                            <select name="cor5" class="form-control">
                              <?php
                              if ($cor5 == '') {
                                echo "<option value=''>Escolha uma cor</option>";
                              } else {
                                echo "<option value='$cor5'>$cor5</option>";
                              }
                              ?>
                              <option value=''>Remover Cor</option>
                              <?php
                              $stmt = $DB_con->prepare("SELECT id,cor FROM colors ORDER BY id DESC");
                              $stmt->execute();
                              if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  extract($row);
                              ?>
                                  <option value='<?php echo $cor ?>'><?php echo $cor ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
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
                      <div class="form-group">
                        <label class="title">Imagem 4</label>
                        <br>
                        <img src="uploads/produtos/<?php echo $img4; ?>" class="img-fluid pb-2" onerror="this.src='./assets/img/sem.jpg'" width="150px" />
                        <input type="file" name="user_image4" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label class="title">Imagem 5</label>
                        <br>
                        <img src="uploads/produtos/<?php echo $img5; ?>" class="img-fluid pb-2" onerror="this.src='./assets/img/sem.jpg'" width="150px" />
                        <input type="file" name="user_image5" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label class="title">Imagem 6</label>
                        <br>
                        <img src="uploads/produtos/<?php echo $img6; ?>" class="img-fluid pb-2" onerror="this.src='./assets/img/sem.jpg'" width="150px" />
                        <input type="file" name="user_image6" accept="image/*" />
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