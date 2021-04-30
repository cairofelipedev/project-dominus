<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once 'dbconfig.php';
ini_set('default_charset', 'utf-8');
if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
                  <i class="now-ui-icons arrows-1_refresh-69"></i>
                  <b><?php
                  $sth = $DB_con->prepare("SELECT count(*) as total from forms");
                  $sth->execute();
                  print_r($sth->fetchColumn()); ?></b> Leads
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
                  <i class="now-ui-icons arrows-1_refresh-69"></i> 1 novo serviço adicionado
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
                  <i class="now-ui-icons arrows-1_refresh-69"></i>Última atualização há 3 dias
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
                  <i class="now-ui-icons arrows-1_refresh-69"></i> 1 novo serviço adicionado
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
                  <i class="now-ui-icons arrows-1_refresh-69"></i> 1 novo serviço adicionado
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4">
          <a href="painel-produtos.php">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title"><i class="now-ui-icons users_single-02"></i> Úsuarios</h4>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> 1 novo serviço adicionado
                </div>
              </div>
            </div>
          </a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"
  integrity="sha512-yUNtg0k40IvRQNR20bJ4oH6QeQ/mgs9Lsa6V+3qxTj58u2r+JiAYOhOW0o+ijuMmqCtCEg7LZRA+T4t84/ayVA=="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"
  integrity="sha512-vCgNjt5lPWUyLz/tC5GbiUanXtLX1tlPXVFaX5KAQrUHjwPcCwwPOLn34YBFqws7a7+62h7FRvQ1T0i/yFqANA=="
  crossorigin="anonymous"></script>
  <script src="./assets/js/owl.carousel.min.js"></script>
  <script src="./assets/js/now-ui-dashboard.js" type="text/javascript"></script><!-- Now Ui Dashboard 

</body>

</html>