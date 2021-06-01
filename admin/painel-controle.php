<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once 'dbconfig.php';
ini_set('default_charset', 'utf-8');
if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;
if (isset($_GET['delete_produto'])) {
  // it will delete an actual record from db
  $stmt_delete = $DB_con->prepare('DELETE FROM produtos WHERE id =:uid');
  $stmt_delete->bindParam(':uid', $_GET['delete_produto']);
  $stmt_delete->execute();

  header("Location: painel-controle.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="../assets/images/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Distribuidora Dominus / Painel de Controle
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
    <?php include 'nav.php'; ?>
    <div class="content">
      <div class="row">
        <div class="col-lg-4">
          <a href="painel-leads.php">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons files_single-copy-04"></i>Leads</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <b><?php
                      $sth = $DB_con->prepare("SELECT count(*) as total from forms");
                      $sth->execute();
                      print_r($sth->fetchColumn()); ?></b> leads
                </div>
              </div>
            </div>
          </a>
        </div>

        <div class="col-lg-4">
          <a href="painel-produtos.php">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons shopping_cart-simple"></i> Produtos</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <b><?php
                      $sth = $DB_con->prepare("SELECT count(*) as total from produtos");
                      $sth->execute();
                      print_r($sth->fetchColumn()); ?></b> produtos
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4">
          <a href="painel-quemsomos.php?edit_id=1">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons files_paper"></i> Quem somos</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4">
          <a href="painel-blog.php">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons media-1_album"></i> Blog</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                <b><?php
                      $sth = $DB_con->prepare("SELECT count(*) as total from posts");
                      $sth->execute();
                      print_r($sth->fetchColumn()); ?></b> posts
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4">
          <a href="painel-banners.php">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons design_image"></i> Banners</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                <b><?php
                      $sth = $DB_con->prepare("SELECT count(*) as total from banners");
                      $sth->execute();
                      print_r($sth->fetchColumn()); ?></b> banners
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4">
          <a href="painel-clientes.php">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons users_single-02"></i> Clientes</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                <b><?php
                      $sth = $DB_con->prepare("SELECT count(*) as total from clientes");
                      $sth->execute();
                      print_r($sth->fetchColumn()); ?></b> clientes
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-6">
                <h4 class="card-title">Produtos</h4>
              </div>
              <div class="col-6 text-right">
                <a href="add-produto.php"><button class="btn btn-primary">Adicionar Produtos</button></a>
                <a href="painel-produtos.php" style="color:#33306A">
                  <p class="card-title2">Ver todos</p>
                </a>
              </div>
            </div>
          </div>
          <div class="card-body row">
            <div class="owl-carousel owl-produtos">
              <?php
              $stmt = $DB_con->prepare("SELECT id,nome, category, img FROM produtos ORDER BY id DESC");
              $stmt->execute();
              if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
              ?>

                  <div class="produto-item">
                    <div class="card card-chart">
                      <div class="card-header">
                        <h5 class="card-category">
                          <?php echo $category;
                          ?>
                        </h5>
                        <h4 class="card-title"><?php echo $nome ?></h4>
                        <div class="dropdown">
                          <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                            <i class="fas fa-cog"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item text-success" href="edit-produto.php?edit_id=<?php echo $row['id']; ?>" onclick="return confirm('Editar Produto?')">Editar Produto</a>
                            <a class="dropdown-item text-danger" href="?delete_produto=<?php echo $row['id']; ?>" onclick="return confirm('Excluir Produto?')">Excluir Produto</a>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <img class="img-fluid" src="uploads/produtos/<?php echo $row['img']; ?>">
                      </div>
                    </div>
                  </div>
                <?php
                }
              } else {
                ?>
                <div class="pt-4 col-xs-12 container">
                  <div class="alert alert-danger">
                    Sem produto cadastrado ...
                  </div>
                </div>
            <?php
              }
            ?>
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