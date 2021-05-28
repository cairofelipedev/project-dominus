<?php
session_start();
require_once "classes/conexao.php";
require_once "classes/logar.php";
ini_set('default_charset', 'utf-8');
require_once 'dbconfig.php';
error_reporting(~E_ALL);

if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;

if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
  $id = $_GET['edit_id'];
  $stmt_edit = $DB_con->prepare('SELECT name,login,email,whats,type,img FROM users WHERE id =:uid');
  $stmt_edit->execute(array(':uid' => $id));
  $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);
} else {
  header("Location: painel.php");
}

if (isset($_POST['btnsave'])) {
  $name = $_POST['name'];
  $login = $_POST['login'];
  $email = $_POST['email'];
  $whats = $_POST['whats'];
  $type = $_POST['type'];
  $pass = $_POST['pass'];

  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];


  if ($imgFile) {
    $upload_dir = 'uploads/users/'; // upload directory	
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $titulo2 = preg_replace("/\s+/", "", $titulo);
    $userpic = $titulo2 . "-edit1." . $imgExt;
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

  if (!isset($errMSG)) {
    $stmt = $DB_con->prepare('UPDATE users
        SET 
        name=:uname,
        login=:ulogin,
        email=:uemail,
        type=:utype,
        whats=:uwhats,
        pass=:upass,
        img=:upic

        WHERE id=:uid');

    $stmt->bindParam(':uname', $name);
    $stmt->bindParam(':ulogin', $login);
    $stmt->bindParam(':uemail', $email);
    $stmt->bindParam(':utype', $type);
    $stmt->bindParam(':uwhats', $whats);
    $stmt->bindParam(':upass', $pass);

    $stmt->bindParam(':upic', $userpic);
    $stmt->bindParam(':uid', $id);

    if ($stmt->execute()) {
?>
      <script>
        alert('Usuário atualizado...');
        window.location.href = 'painel-users.php';
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
    Distribuidora Dominus / Editar Usuário
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

<body>
  <div class="wrapper">
    <?php include "nav.php" ?>
    <div class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h5 class="title">Editar Perfil</h5>
            </div>
            <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>Nome</label>
                      <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                    </div>
                  </div>
                  <div class="col-md-4 px-1">
                    <div class="form-group">
                      <label>Login</label>
                      <input type="text" name="login" class="form-control" value="<?php echo $login; ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pl-1">
                    <div class="form-group">
                      <label for="">Senha</label>
                      <input type="password" name="pass" class="form-control" value="<?php echo $pass; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pr-1">
                    <div class="form-group">
                      <label>Whats Profissional</label>
                      <input type="text" name="whats" class="form-control" value="<?php echo $whats; ?>">
                    </div>
                  </div>
                  <div class="col-md-4 pl-1 mt-2">
                    <div class="form-group pt-3">
                      <select name="type" class="form-control">
                        <option value="<?php echo $type; ?>">
                          <?php
                          if ($type == 1) {
                            echo "ADMIN";
                          }
                          if ($type == 2) {
                            echo "DESENVOLVEDOR";
                          }
                          if ($type == 3) {
                            echo "VENDENDOR";
                          }
                          ?>
                        </option>
                        <option value='1'>Administrador</option>
                        <option value='2'>Desenvolvedor</option>
                        <option value='3'>Vendendor</option>
                      </select>
                    </div>
                  </div>
                </div>
                <label class="control-label pt-3">Imagem Principal</label>
                <input class="input-group" type="file" name="user_image" accept="image/*" />
                <img onerror="this.src='sem.jpg'" class="img-fluid avatar" src="uploads/users/<?php echo $img; ?> ">
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