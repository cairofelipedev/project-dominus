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

if (isset($_GET['delete_id'])) {
    // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM categorys WHERE id =:uid');
    $stmt_delete->bindParam(':uid', $_GET['delete_id']);
    $stmt_delete->execute();
  
    header("Location: add-category.php");
  }

if (isset($_POST['btnsave'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];


    if (empty($nome)) {
        $errMSG = "Por favor Insira o nome";
    }

    if (!isset($errMSG)) {
        $stmt = $DB_con->prepare('INSERT INTO categorys (nome,tipo) VALUES(:unome,:utipo)');
        $stmt->bindParam(':unome', $nome);
        $stmt->bindParam(':utipo', $tipo);

        if ($stmt->execute()) {
            echo ("<script>window.location = 'add-category.php';</script>");
        } else {
            $errMSG = "Erro..";
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
        Painel Categorias / Distribuidora Dominus
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
                            <h5 class="title text-center">Adicionar Categoria</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="title">NOME</label>
                                            <input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" placeholder="Nome da Categoria">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="title">TIPO</label>
                                        <select name="tipo" class="form-control">
                                            <option value='produto'>PRODUTO</option>
                                            <option value='blog'>BLOG</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" name="btnsave" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-save"></span>Salvar
                                </button>
                            </form>
                            <h5 class="title pt-4">Categorias: </h5>
                            <?php
                            $stmt = $DB_con->prepare("SELECT id,nome,tipo FROM categorys ORDER BY id DESC");
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);
                            ?>
                                    <h6 class="title"><?php echo $nome ?> / <?php echo $tipo ?> <a class="text-danger pl-4 pr-4" href="?delete_id=<?php echo $row['id']; ?>" title="clique para deletar" onclick="return confirm('Excluir categoria?')"><i class="now-ui-icons ui-1_simple-remove"></i> Excluir</a> https://distribuidoradominus.com/busca.php?pesquisa=<?php echo $nome ?></h6>

                                <?php
                                }
                            } else {
                                ?>
                                Sem categoria Cadastrada ...
                            <?php
                            }
                            ?>
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