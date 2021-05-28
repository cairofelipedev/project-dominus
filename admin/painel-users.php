<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once 'dbconfig.php';
ini_set('default_charset', 'utf-8');
if (isset($_SESSION['logado'])) :
else :
  header("Location: ../login.php");
endif;

if (isset($_GET['delete_user'])) {
  // it will delete an actual record from db
  $stmt_delete = $DB_con->prepare('DELETE FROM users WHERE id =:uid');
  $stmt_delete->bindParam(':uid', $_GET['delete_user']);
  $stmt_delete->execute();

  header("Location: painel-users.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="../assets/images/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Distribuidora Dominus / Painel Usuários
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
        <div class="col-8">
          <h3>Usuários do sistema</h3>
        </div>
        <div class="col-4 text-right">
          <a href="add-user.php"><button class="btn btn-primary">Adicionar Usuário</button></a>
        </div>
      </div>
      <div class="row">
        <?php
        $stmt = $DB_con->prepare("SELECT id,name, pass,whats, type,email, img, user_create FROM users ORDER BY id DESC");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
        ?>
            <div class="col-lg-4">
              <div class="card card-chart">
                <div class="card-header">
                  <h5 class="card-category">
                    <?php
                    if ($type == '1') {
                      echo "Administrador";
                    }
                    if ($type == '2') {
                      echo "Desenvolvedor";
                    }
                    if ($type == '3') {
                      echo "Vendedor";
                    }
                    ?>

                  </h5>
                  <div class="row">
                    <div class="col-6">
                      <p><?php echo $name ?></p>
                    </div>
                    <div class="col-6">
                      <img onerror="this.src='assets/img/sem.jpg'" class="img-fluid avatar" src="uploads/users/<?php echo $row['img']; ?> ">
                    </div>
                  </div>
                  <div class="dropdown">
                    <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                      <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item text-success" href="edit-user.php?edit_id=<?php echo $row['id']; ?>">Editar Usuário</a>
                      <a class="dropdown-item text-danger" href="?delete_user=<?php echo $row['id']; ?>">Excluir Usuário</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <i class="fab fa-whatsapp"></i> <?php echo $whats; ?>
                  <br>
                  <i class="fas fa-at"></i> <?php echo $email; ?>
                  <hr>
                  <div class="row container">
                    Adicionado por: <?php echo $user_create ?>
                  </div>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
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