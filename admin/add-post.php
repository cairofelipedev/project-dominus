<?php
  session_start();
  date_default_timezone_set('America/Sao_Paulo');
	require_once 'dbconfig.php';
	ini_set('default_charset','utf-8');	
  if(isset($_SESSION['logado'])):
  else:
	  header("Location: login.php");
  endif;
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
    
    $imgFile4 = $_FILES['user_image4']['name'];
		$tmp_dir4 = $_FILES['user_image4']['tmp_name'];
    $imgSize4 = $_FILES['user_image4']['size'];
        
    $imgFile5 = $_FILES['user_image5']['name'];
		$tmp_dir5 = $_FILES['user_image5']['tmp_name'];
		$imgSize5 = $_FILES['user_image5']['size'];
		
		$imgFile6 = $_FILES['user_image6']['name'];
		$tmp_dir6 = $_FILES['user_image6']['tmp_name'];
		$imgSize6 = $_FILES['user_image6']['size'];

		if(empty($titulo)){
			$errMSG = "Por favor Insira o Titulo";
		}
	
		else if(empty($imgFile)){
			$errMSG = "Selecione a imagem.";
		}
		else
		{
			$upload_dir = 'uploads/'; // upload directory
	
      $imgExt =  strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
      $imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION));
      $imgExt3 = strtolower(pathinfo($imgFile3,PATHINFO_EXTENSION));
      $imgExt4 = strtolower(pathinfo($imgFile4,PATHINFO_EXTENSION));
      $imgExt5 = strtolower(pathinfo($imgFile5,PATHINFO_EXTENSION));
      $imgExt6 = strtolower(pathinfo($imgFile6,PATHINFO_EXTENSION));
	
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			// rename uploading image
      $userpic = $titulo."1.".$imgExt;
			$userpic2 = $titulo."2.".$imgExt2;
			$userpic3 = $titulo."3.".$imgExt3;
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
			else{
						
          }
      if(in_array($imgExt2, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize2 < 5000000)				{
					move_uploaded_file($tmp_dir2,$upload_dir.$userpic2);
				}
				else{
					$errMSG = "Banner muito grande.";
				}
			}
			else{}
			if(in_array($imgExt3, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize3 < 5000000)				{
					move_uploaded_file($tmp_dir3,$upload_dir.$userpic3);
				}
				else{
					$errMSG = "IMAGEM 3 muito grande.";
				}
			}
			else{}
		}
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO posts (titulo,sub_titulo,texto_1,texto_2,texto_3,texto_4,categoria_1,categoria_2,categoria_3,autor,img1,img2,img3) VALUES(:utitulo,:usub_titulo,:utexto_1,:utexto_2,:utexto_3,:utexto_4,:ucategoria_1,:ucategoria_2,:ucategoria_3,:uautor,:upic,:upic2, :upic3)');
			$stmt->bindParam(':utitulo',$titulo);
			$stmt->bindParam(':usub_titulo',$sub_titulo);
      $stmt->bindParam(':utexto_1',$texto_1);
      $stmt->bindParam(':utexto_2',$texto_2);
      $stmt->bindParam(':utexto_3',$texto_3);
      $stmt->bindParam(':utexto_4',$texto_4);
      $stmt->bindParam(':ucategoria_1',$categoria_1);
      $stmt->bindParam(':ucategoria_2',$categoria_2);
      $stmt->bindParam(':ucategoria_3',$categoria_3);
      $stmt->bindParam(':uautor',$autor);
      $stmt->bindParam(':upic',$userpic);
           
      if(empty($imgFile2)){
        $stmt->bindValue(':upic2', $nulo);
        $nulo = '';
      }

      if(!empty($imgFile2)){
      $stmt->bindParam(':upic2',$userpic2);
      }
            
      if(empty($imgFile3)){
        $stmt->bindValue(':upic3', $nulo2);
        $nulo2 = '';
      }

      if(!empty($imgFile3)){
      $stmt->bindParam(':upic3',$userpic3);
      }
		
			if($stmt->execute())
			{
				$successMSG = "Post adicionado com sucesso ...";
				header("refresh:2;painel-blog.php"); // redirects image view page after 5 seconds.
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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logofonte.png">
  <link rel="icon" type="image/png" href="../assets/img/logofonte.png">
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
                <h5 class="title">Adicionar Post</h5>
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
                        <br>
                        <input  type="file" name="user_image2" accept="image/*" />
                      </div>
                      <div class="form-group pt-3">
                        <label>Texto 2</label>
                        <textarea  rows="5" cols="80" name="texto_2" class="form-control" placeholder="Texto 2, após imagem 2 (Opcional)"><?php echo $texto_2; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label>Imagem 3, após texto 2 (Opcional)</label>
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