<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
	require_once 'dbconfig.php';
	ini_set('default_charset','utf-8');	
  if(isset($_SESSION['logado'])):
  else:
	  header("Location: login.php");
  endif;
  if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
  {
      $id = $_GET['edit_id'];
      $stmt_edit = $DB_con->prepare('SELECT home,text_intro,texto1,texto2,texto3,texto4,texto5, img, img2 FROM quem_somos WHERE id =:uid');
      $stmt_edit->execute(array(':uid'=>$id));
      $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
      extract($edit_row);
  }
  else
  {
      header("Location: painel-quemsomos.php");
  }
  error_reporting( ~E_NOTICE ); // avoid notice
  
  if(isset($_POST['btnsave']))
	{
    $home = $_POST['home'];
    $text_intro = $_POST['text_intro'];
		$texto1 = $_POST['texto1'];
    $texto2 = $_POST['texto2'];
    $texto3 = $_POST['texto3'];
    $texto4 = $_POST['texto4'];
    $texto5 = $_POST['texto5'];
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
        
    $imgFile2 = $_FILES['user_image2']['name'];
		$tmp_dir2 = $_FILES['user_image2']['tmp_name'];
		$imgSize2 = $_FILES['user_image2']['size'];
		
		if($imgFile)
		{
			$upload_dir = 'uploads/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = rand(1000,1000000).".".$imgExt;
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
				$errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";		
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
			$userpic2 = rand(1000,1000000).".".$imgExt2;
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
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE quem_somos
	     SET 
       home=:uhome,
			 text_intro=:utext_intro,
	     texto1=:utexto1,
       texto2=:utexto2,
       texto3=:utexto3,
       texto4=:utexto4,
       texto5=:utexto5,
		   img=:upic,
       img2=:upic2
       WHERE id=:uid');
			$stmt->bindParam(':uhome',$home);
			$stmt->bindParam(':utext_intro',$text_intro);
			$stmt->bindParam(':utexto1',$texto1);
      $stmt->bindParam(':utexto2',$texto2);
      $stmt->bindParam(':utexto3',$texto3);
      $stmt->bindParam(':utexto4',$texto4);
      $stmt->bindParam(':utexto5',$texto5);
      $stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':upic2',$userpic2);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
        <script>
				  alert('Quem somos Atualizado ...');
				  window.location.href='painel_quemsomos.php?edit_id=1';
				</script>
      <?php
			  }
			else {
				$errMSG = "Erro!";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logosemfundo.png">
  <link rel="icon" type="image/png" href="../assets/img/logosemfundo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Painel Quem Somos / ÁguaDaBoaFonthe
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
                <h5 class="title">Quem somos</h5>
              </div>
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Texto da Home</label>
                        <textarea style="max-height: 300px;" rows="5" cols="80" name="home" class="form-control" ><?php echo $home; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Imagem 1</label>
                        <img src="uploads/<?php echo $img; ?>" class="img-fluid" onerror="this.src='./img/sem.jpg'" />
                        <br>
                        <input  type="file" name="user_image" accept="image/*" />
                      </div>
                      <div class="form-group">
                        <label>Texto da Intro</label>
                        <textarea style="max-height: 300px;" rows="2" cols="80" name="text_intro" class="form-control"><?php echo $text_intro; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Imagem 2</label>
                        <br>
                        <img src="uploads/<?php echo $img2; ?>" class="img-fluid" onerror="this.src='./img/sem.jpg'" />
                        <input  type="file" name="user_image2" accept="image/*" />
                      </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group pt-3">
                      <label>Texto 1</label>
                      <textarea style="max-height: 300px;" rows="5" cols="80" name="texto1" class="form-control" placeholder="Texto principal da postagem"><?php echo $texto1; ?></textarea>
                    </div>
                      <div class="form-group pt-3">
                        <label>Texto 2</label>
                        <textarea style="max-height: 500px;"  rows="5" cols="80" name="texto2" class="form-control"><?php echo $texto2; ?></textarea>
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 3</label>
                        <textarea style="max-height: 500px;" rows="5" cols="80" name="texto3" class="form-control"><?php echo $texto3; ?></textarea>
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 4</label>
                        <textarea style="max-height: 500px;" rows="5" cols="80" name="texto4" class="form-control"><?php echo $texto4; ?></textarea>
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 5</label>
                        <textarea style="max-height: 500px;" rows="5" cols="80" name="texto5" class="form-control" ><?php echo $texto5; ?></textarea>
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