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
      $stmt_edit = $DB_con->prepare('SELECT titulo,sub_titulo,texto_1,texto_2,texto_3,texto_4,img1, img2, img3, categoria_1,categoria_2,categoria_3,data_criacao,autor FROM posts WHERE id =:uid');
      $stmt_edit->execute(array(':uid'=>$id));
      $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
      extract($edit_row);
    }
    else
    {
      header("Location: painel_posts.php");
    }
  error_reporting( ~E_NOTICE ); // avoid notice
  
  if(isset($_POST['btnsave']))
	{
		$titulo = $_POST['titulo'];
		$sub_titulo = $_POST['sub_titulo'];
        $texto_1 = $_POST['texto_1'];
        $texto_2 = $_POST['texto_2'];
        $texto_3 = $_POST['texto_3'];
        $texto_4 = $_POST['texto_4'];
        $categoria_1 = $_POST['categoria_1'];
        $categoria_2 = $_POST['categoria_2'];
        $categoria_3 = $_POST['categoria_3'];
        $autor = $_POST['autor'];
		
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
        
        $imgFile2 = $_FILES['user_image2']['name'];
		$tmp_dir2 = $_FILES['user_image2']['tmp_name'];
		$imgSize2 = $_FILES['user_image2']['size'];
		
		$imgFile3 = $_FILES['user_image3']['name'];
		$tmp_dir3 = $_FILES['user_image3']['tmp_name'];
		$imgSize3 = $_FILES['user_image3']['size'];

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
					unlink($upload_dir.$edit_row['img1']);
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
			$userpic = $edit_row['img1']; // old image from database
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
				$errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic2 = $edit_row['img2']; // old image from database
        }
        if($imgFile3)
		{
			$upload_dir = 'uploads/'; // upload directory	
			$imgExt3 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic3 = rand(1000,1000000).".".$imgExt2;
			if(in_array($imgExt3, $valid_extensions))
			{			
				if($imgSize3 < 5000000)
				{
					unlink($upload_dir.$edit_row['img3']);
					move_uploaded_file($tmp_dir3,$upload_dir.$userpic3);
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
			$userpic3 = $edit_row['img3']; // old image from database
        }		
        
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE posts
									     SET titulo=:utitulo,
											 sub_titulo=:usub_titulo,
										     texto_1=:utexto_1,
                                             texto_2=:utexto_2,
                                             texto_3=:utexto_3,
                                             texto_4=:utexto_4,
											 img1=:upic,
                                             img2=:upic2,
                                             img3=:upic3,
                                             categoria_1=:ucategoria_1,
                                             categoria_2=:ucategoria_2,
                                             categoria_3=:ucategoria_3,
                                             autor=:uautor
								       WHERE id=:uid');
			$stmt->bindParam(':utitulo',$titulo);
			$stmt->bindParam(':usub_titulo',$sub_titulo);
			$stmt->bindParam(':utexto_1',$texto_1);
            $stmt->bindParam(':utexto_2',$texto_2);
            $stmt->bindParam(':utexto_3',$texto_3);
            $stmt->bindParam(':utexto_4',$texto_4);
            $stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':upic2',$userpic2);
            $stmt->bindParam(':upic3',$userpic3);
            $stmt->bindParam(':ucategoria_1',$categoria_1);
            $stmt->bindParam(':ucategoria_2',$categoria_2);
            $stmt->bindParam(':ucategoria_3',$categoria_3);
            $stmt->bindParam(':uautor',$autor);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Post Atualizado ...');
				window.location.href='painel-blog.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../img/icone.png">
  <link rel="icon" type="image/png" href="../img/icone.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Painel Blog / Fruta Polpa
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
                <h5 class="title">Editar Post</h5>
              </div>
              <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Título</label>
                        <input value="<?php echo $titulo; ?>" name="titulo" type="text" class="form-control" placeholder="Título da postagem">
                      </div>
                      <div class="form-group">
                        <label>Subtítulo</label>
                        <input value="<?php echo $sub_titulo; ?>" name="sub_titulo" type="text" class="form-control" placeholder="Subtítulo da postagem">
                      </div>
                      <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Categoria 1</label>
                          <input value="<?php echo $categoria_1; ?>" name="categoria_1" type="text" class="form-control" placeholder="Insira uma categoria">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Categoria 2</label>
                          <input value="<?php echo $categoria_2; ?>" name="categoria_2" type="text" class="form-control" placeholder="Insira mais uma categoria">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Categoria 3</label>
                          <input value="<?php echo $categoria_3; ?>" name="categoria_3" type="text" class="form-control" placeholder="Insira mais uma categoria">
                        </div>
                      </div>
                      </div>
                      <div class="form-group">
                        <label>Imagem Capa</label>
                        <br>
                        <img src="uploads/<?php echo $img1; ?>" class="img-fluid" onerror="this.src='./assets/img/sem.jpg'" />
                        <input  type="file" name="user_image" accept="image/*" />
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto Principal</label>
                        <textarea style="max-height: 300px;" rows="5" cols="80" name="texto_1" class="form-control" placeholder="Texto principal da postagem"><?php echo $texto_1; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Imagem 2</label>
                        <img src="uploads/<?php echo $img2; ?>" class="img-fluid" onerror="this.src='./assets/img/sem.jpg'" />
                        <br>
                        <input  type="file" name="user_image2" accept="image/*" />
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 2</label>
                        <textarea  rows="5" cols="80" name="texto_2" class="form-control" placeholder="Texto 2, após imagem 2 (Opcional)"><?php echo $texto_2; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Imagem 3, após texto 2 (Opcional)</label>
                        <img src="uploads/<?php echo $img3; ?>" class="img-fluid" onerror="this.src='./assets/img/sem.jpg'" />
                        <br>
                        <input  type="file" name="user_image3" accept="image/*" />
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 3</label>
                        <textarea rows="5" cols="80" name="texto_3" class="form-control" placeholder="Texto 3, após imagem 3 (Opcional)"><?php echo $texto_3; ?></textarea>
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 4</label>
                        <textarea rows="5" cols="80" name="texto_4" class="form-control" placeholder="Texto 4, após texto 3 (Opcional)"><?php echo $texto_4; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      
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