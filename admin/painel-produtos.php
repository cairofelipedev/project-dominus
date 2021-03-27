<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
	require_once 'dbconfig.php';
	ini_set('default_charset','utf-8');	
  if(isset($_SESSION['logado'])):
  else:
	  header("Location: login.php");
  endif;
  if(isset($_GET['delete_id']))
    
  {	
  // it will delete an actual record from db
  $stmt_delete = $DB_con->prepare('DELETE FROM produtos WHERE id =:uid');
  $stmt_delete->bindParam(':uid',$_GET['delete_id']);
  $stmt_delete->execute();
  
  header("Location: painel-produtos.php");
  }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logofonte.png">
  <link rel="icon" type="image/png" href="../assets/img/logofonte.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    ÁguDaBoaFonthe / Painel de Controle
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
    <?php include 'nav.php';?>
      <div class="content">
        <a href="add-produto.php">
        <div class="text-right">
            <button class="btn btn-info">Adicionar produto</button>
        </div>
        </a>
        <div class="row">
        <?php
          $stmt = $DB_con->prepare("SELECT id, nome, img,data_add,descricao FROM produtos ORDER BY id DESC");
          $stmt->execute();
          if($stmt->rowCount() > 0) {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
        ?>
          <div class="col-lg-4">
            <div class="card card-chart pb-3">
              <div class="card-header">
                <img class="img-center" src="uploads/produtos/<?php echo $row['img']; ?>" onerror="this.src='./assets/img/sem.jpg'">
                <h4><?php echo $nome ?></h4>
                <p><?php echo $descricao ?></p>
              </div>
              <div class="row">
                <div class="col-6 text-center">
                <a class="btn btn-info" href="edit-produto.php?edit_id=<?php echo $row['id']; ?>" title="clique para editar">Editar</a> 
                </div>
                <div class="col-6">
                <a class="btn btn-danger" href="?delete_id=<?php echo $row['id']; ?>" title="clique para deletar" onclick="return confirm('Excluir Produto?')"><i class="now-ui-icons ui-1_simple-remove"></i> Excluir</a>
                </div>
                </div>
            </div>
          </div>
        <?php 
            }
          }
           else
            {
          ?>
            <div class="pt-4 col-xs-12">
            <div class="alert alert-info">
              Sem produto cadastrado ...
                </div>
            </div>
        <?php
            }
        ?>       
        </div>     
      </div>
    <?php include 'footer.php';?>
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