<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
	require_once 'dbconfig.php';
	ini_set('default_charset','utf-8');	
  if(isset($_SESSION['logado'])):
  else:
	  header("Location: login.php");
  endif;
  error_reporting( ~E_ALL ); // avoid notice
  
  if(isset($_POST['btnsave']))
	{
		$nome = $_POST['nome'];
	
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    
    $imgFile2 = $_FILES['user_image2']['name'];
    $tmp_dir2 = $_FILES['user_image2']['tmp_name'];
    $imgSize2 = $_FILES['user_image2']['size'];

		if(empty($nome)){
			$errMSG = "Por favor Insira o nome";
		}
		else
		{
			$upload_dir = 'uploads/banners/'; // upload directory
	
      $imgExt =  strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
      $imgExt2 = strtolower(pathinfo($imgFile2, PATHINFO_EXTENSION));

	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'mp4'); // valid extensions
			// rename uploading image
      $nome2 = preg_replace("/\s+/", "", $nome);
      $userpic = "banner-".$nome2.".".$imgExt;
      $userpic2 = "banner2-".$nome2.".".$imgExt2;

			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$errMSG = "Imagem muito grande.";
				}
			}
      if (in_array($imgExt2, $valid_extensions)) {
        // Check file size '5MB'
        if ($imgSize2 < 5000000) {
          move_uploaded_file($tmp_dir2, $upload_dir . $userpic2);
        } else {
          $errMSG = "Imagem 2 muito grande.";
        }
      }
		}
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO banners (nome,img,img2) VALUES(:unome,:upic,:upic2)');
			$stmt->bindParam(':unome',$nome);
      $stmt->bindParam(':upic',$userpic);
      $stmt->bindParam(':upic2',$userpic2);
 		
			if($stmt->execute())
			{
				$successMSG = "Banner adicionado com sucesso ...";
				header("refresh:2;painel-banners.php"); // redirects image view page after 5 seconds.
			}
			else
			{
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
    Painel Banner / Distribuidora Dominus
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
                if(isset($errMSG)){
              ?>
                <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                </div>
              <?php
              }
                else if(isset($successMSG)){
              ?>
                <div class="alert alert-success">
                <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
                </div>
              <?php
              }
              ?>
                <h5 class="title">Adicionar Banner</h5>
              </div>
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nome</label>
                        <input value="<?php echo $nome; ?>" name="nome" type="text" class="form-control" placeholder="Nome do Banner">
                      </div>
                      <div class="form-group">
                        <label>Banner Desktop</label>
                        <br>
                        <input  type="file" name="user_image" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label>Banner Mobile</label>
                        <br>
                        <input  type="file" name="user_image2" accept="image/*" />
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="btnsave" class="btn btn-primary">
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