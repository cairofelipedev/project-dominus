<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
	require_once 'dbconfig.php';
	ini_set('default_charset','utf-8');	
  if(isset($_SESSION['logado'])):
  else:
	  header("Location: login.php");
  endif;
  error_reporting( ~E_NOTICE );

  if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $stmt_edit = $DB_con->prepare('SELECT nome,descricao,img,img2 FROM produtos WHERE id =:uid');
    $stmt_edit->execute(array(':uid' => $id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);
  } 
  else {
    header("Location: painel_planos.php");
  }
  
  if(isset($_POST['btnsave']))
	{
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    
    $imgFile2 = $_FILES['user_image2']['name'];
		$tmp_dir2 = $_FILES['user_image2']['tmp_name'];
		$imgSize2 = $_FILES['user_image2']['size'];

		if(empty($nome)){
			$errMSG = "Por favor Insira o nome";
		}
	
		if($imgFile)
		{
			$upload_dir = 'uploads/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = $nome."-edit1.".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['img']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "Imagem grande demais, max 5MB";
				}
			}
			else
			{
				$errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['img']; // old image from database
    }
    if($imgFile2)
		{
			$upload_dir = 'uploads/'; // upload directory	
			$imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic2 = $nome."-edit2.".$imgExt2;
			if(in_array($imgExt2, $valid_extensions))
			{			
				if($imgSize2 < 5000000)
				{
					unlink($upload_dir.$edit_row['img2']);
					move_uploaded_file($tmp_dir2,$upload_dir.$userpic2);
				}
				else
				{
					$errMSG = "Imagem grande demais, max 5MB";
				}
			}
			else
			{
				$errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic2 = $edit_row['img2']; // old image from database
    }
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE produtos SET nome=:unome, descricao=:udescricao,img=:upic,img2=:upic2 WHERE id=:uid');
			$stmt->bindParam(':unome',$nome);
      $stmt->bindParam(':udescricao',$descricao);
      $stmt->bindParam(':uid', $id);
      $stmt->bindParam(':upic', $userpic);
      $stmt->bindParam(':upic2', $userpic2);
		
			if($stmt->execute())
			{
				echo("<script type= 'text/javascript'>alert('Produto atualizado com sucesso.');</script>
        <script>window.location = 'painel-produtos.php';</script>");
			}
			else
			{
				$errMSG = "Erro Interno..";
			}
		}
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
<body class="user-profile">
  <div class="wrapper ">
    <?php include 'nav.php' ?>
      <div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <?php
                  if(isset($errMSG)){
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
                    <div class="col-md-7">
                      <div class="form-group">
                        <label>Nome do produto</label>
                        <input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" placeholder="Nome">
                      </div>
                      <div class="form-group">
                        <label>Descrição</label>
                        <textarea rows="4" cols="80" name="descricao" class="form-control" placeholder="Descreva as principais caracteristicas do seu produtos"><?php echo $descricao; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Imagem</label>
                        <br>
                        <img src="uploads/<?php echo $img; ?>" class="img-fluid" onerror="this.src='./assets/img/sem.jpg'" />
                        <input  type="file" name="user_image" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label>Imagem 2</label>
                        <br>
                        <img src="uploads/<?php echo $img2; ?>" class="img-fluid" onerror="this.src='./assets/img/sem.jpg'" />
                        <input  type="file" name="user_image2" accept="image/*" />
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