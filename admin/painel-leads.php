<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once 'dbconfig.php';
ini_set('default_charset', 'utf-8');
if (isset($_SESSION['logado'])) :
else :
  header("Location: login.php");
endif;

if (isset($_GET['delete_id'])) {
  // it will delete an actual record from db
  $stmt_delete = $DB_con->prepare('DELETE FROM forms WHERE id =:uid');
  $stmt_delete->bindParam(':uid', $_GET['delete_id']);
  $stmt_delete->execute();

  header("Location: painel-leads.php");
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
    Formulários / Distribuidora Dominus
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

<body class="">
  <div class="wrapper ">
    <?php include 'nav.php'; ?>
    <div class="content">
      <div class="row">
        <div class="col-8">
        <div class="row pb-4">
        <div class="col-12">
          <ul class="nav">
            <li class="n-l"></li><span>GERAL</span>
            <li class="n-v ml-2"></li><span>LIGAMOS</span>
            <li class="n-o ml-2"></li><span>NOVIDADES</span>
          </ul>
        </div>
      </div>
        </div>
        <div class="col-4 text-right">
          <a href="gerador-excel-leads.php" class="baixar-excel"><i class="bi bi-download"></i><i class="bi bi-file-earmark-excel-fill"></i></a>
        </div>
      </div>
      <div class="row">
        <?php
        $stmt = $DB_con->prepare("SELECT id, nome, whats,email,mensagem,opc,data_envio,tipo FROM forms ORDER BY id DESC");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
        ?>
            <div class="col-lg-4">
              <div class="card card-chart pb-3" <?php
                                                if ($tipo == '1') {
                                                  echo "style='background-color:#0c3333;color:white;'";
                                                }
                                                if ($tipo == '3') {
                                                  echo "style='background-color:#bfdaf5;color:black;'";
                                                }
                                                ?>>
                <div class="card-header">
                  <i class="fas fa-fw fa-clock"></i> <?php $date = new DateTime($data_envio);
                                                      echo $date->format('H:i d-m-Y'); ?>
                  <br>
                  <i class="fas fa-fw fa-user"></i> <?php echo $nome; ?>
                  <br>
                  <?php
                  if (($tipo == '2') or ($tipo == '1')) { ?>
                    <i class="fab fa-whatsapp"></i> <?php echo $whats; ?>
                    <br>
                  <?php } ?>
                  <?php
                  if (($tipo == '1') or ($tipo == '3')) { ?>
                    <i class="fas fa-at"></i> <?php echo $email; ?>
                  <?php } ?>
                  <br>
                  <?php
                  if ($tipo == '1') { ?>
                    <i class="fas fa-comment-alt"></i>
                  <?php
                    if ($mensagem == '') {
                      echo "(sem mensgem)";
                    } else {
                      echo $mensagem;
                    }
                  }
                  ?>
                </div>
                <div class="row container">
                  <div class="col-6">
                    <a class="btn btn-danger" href="?delete_id=<?php echo $row['id']; ?>" title="clique para deletar" onclick="return confirm('Excluir Lead?')"><i class="now-ui-icons ui-1_simple-remove"></i> Excluir</a>
                  </div>
                </div>
              </div>
            </div>

          <?php
          }
        } else {
          ?>
          <div class="pt-4 col-xs-12">
            <div class="alert alert-warning">
              Sem registro ...
            </div>
          </div>
        <?php
        }
        ?>
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