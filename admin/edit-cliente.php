<?php
  session_start();
  require_once "classes/conexao.php";
  require_once "classes/logar.php";
  ini_set('default_charset', 'utf-8');
  require_once 'dbconfig.php';
  error_reporting(~E_WARNING);
  error_reporting(~E_NOTICE);

  if (isset($_SESSION['logado'])) :
    else :
      header("Location: login.php");
  endif;

  if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
  {
    $id = $_GET['edit_id'];
    $stmt_edit = $DB_con->prepare('SELECT nome,cpf,estado_civil,email,renda_tipo,renda_valor,endereco,telefone1,telefone2,nome_arq1,nome_arq2,arq1,arq2,status,equipe,restricao,preferencia,cidade,fgts,dependente,corretor,valor_imovel FROM clientes WHERE id =:uid');
    $stmt_edit->execute(array(':uid'=>$id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);
  }
  else
  {
    header("Location: painel.php");
  }

  if(isset($_POST['btnsave']))
	{
		$nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $estado_civil = $_POST['estado_civil'];
    $email = $_POST['email'];
    $renda_tipo = $_POST['renda_tipo'];
    $renda_valor = $_POST['renda_valor'];

    $endereco = $_POST['endereco'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];
    $status= $_POST['status'];

    $nome_arq1 = $_POST['nome_arq1'];
    $nome_arq2 = $_POST['nome_arq2'];

    $equipe = $_POST['equipe'];
    $restricao = $_POST['restricao'];
    $preferencia = $_POST['preferencia'];

    $cidade = $_POST['cidade'];
    $fgts = $_POST['fgts'];
    $dependente = $_POST['dependente'];
    $valor_imovel = $_POST['valor_imovel'];
    $corretor = $_POST['corretor'];

    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    $imgFile2 = $_FILES['user_image2']['name'];
    $tmp_dir2 = $_FILES['user_image2']['tmp_name'];
    $imgSize2 = $_FILES['user_image2']['size'];

    if($imgFile)
		{
			$upload_dir = 'images/clientes/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      $nome2 = preg_replace("/\s+/", "", $nome);
			$userpic = $nome2."-edit1.".$imgExt;
			if(in_array($imgExt, $valid_extensions)) {			
				if($imgSize < 5000000) {
					unlink($upload_dir.$edit_row['arq1']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}else {
					$errMSG = "Imagem grande demais, max 5MB";
				}
			}else {
				$errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		} else {
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['arq1']; // old image from database
    }
    if($imgFile2) {
			$upload_dir = 'images/clientes/'; // upload directory	
			$imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      $nome2 = preg_replace("/\s+/", "", $nome);
			$userpic2 = $nome2."-edit2.".$imgExt2;
			if(in_array($imgExt2, $valid_extensions)){			
				if($imgSize2 < 5000000){
					unlink($upload_dir.$edit_row['arq2']);
					move_uploaded_file($tmp_dir2,$upload_dir.$userpic2);
				}else{
					$errMSG = "Imagem grande demais, max 5MB";
				}
			}else{
				$errMSG = "Imagens apenas nos formatos JPG, JPEG, PNG & GIF";		
			}	
		}else{
			// if no image selected the old image remain as it is.
			$userpic2 = $edit_row['arq2']; // old image from database
    }	
   
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE clientes
        SET 
        nome=:unome,
        cpf=:ucpf,
        estado_civil=:uestado_civil,
        email=:uemail,
        renda_tipo=:urenda_tipo,
        renda_valor=:urenda_valor,
        endereco=:uendereco,
        telefone1=:utelefone1,
        telefone2=:utelefone2,
        nome_arq1=:unome_arq1,
        nome_arq2=:unome_arq2,
        arq1=:upic,
        arq2=:upic2,
        equipe=:uequipe,
        preferencia=:upreferencia,
        restricao=:urestricao,
        cidade=:ucidade,
        fgts=:ufgts,
        dependente=:udependente,
        valor_imovel=:uvalor_imovel,
        corretor=:ucorretor,
        status=:ustatus
        WHERE id=:uid');
        
      $stmt->bindParam(':unome', $nome);
      $stmt->bindParam(':ucpf', $cpf);
      $stmt->bindParam(':uestado_civil', $estado_civil);
      $stmt->bindParam(':uemail', $email);
      $stmt->bindParam(':urenda_tipo', $renda_tipo);
      $stmt->bindParam(':urenda_valor', $renda_valor);
      $stmt->bindParam(':uendereco', $endereco);
      $stmt->bindParam(':utelefone1', $telefone1);
      $stmt->bindParam(':utelefone2', $telefone2);
      $stmt->bindParam(':ustatus', $status);
      $stmt->bindParam(':uid',$id);

      $stmt->bindParam(':unome_arq1', $nome_arq1);
      $stmt->bindParam(':unome_arq2', $nome_arq2);

      $stmt->bindParam(':uequipe', $equipe);
      $stmt->bindParam(':urestricao', $restricao);
      $stmt->bindParam(':upreferencia', $preferencia);

      $stmt->bindParam(':ucidade', $cidade);
      $stmt->bindParam(':ufgts', $fgts);
      $stmt->bindParam(':udependente', $dependente);
      $stmt->bindParam(':ucorretor', $corretor);
      $stmt->bindParam(':uvalor_imovel', $valor_imovel);
      
      if (empty($imgFile)) {
        $stmt->bindValue(':upic', $nulo);
        $nulo = '';
      }

      if (!empty($imgFile)) {
        $stmt->bindParam(':upic', $userpic);
      }

      if (empty($imgFile2)) {
        $stmt->bindValue(':upic2', $nulo2);
        $nulo2 = '';
      }

      if (!empty($imgFile2)) {
        $stmt->bindParam(':upic2', $userpic2);
      }



			if($stmt->execute()){
				?>
                <script>
				alert('Cliente atualizado...');
				window.location.href='painel-clientes.php';
				</script>
      <?php
			}
			else{
				$errMSG = "Erro!";
    			}
    		}
    	}
      ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/logo.jpg">
  <link rel="icon" type="image/png" href="./assets/img/logo.jpg">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Painel Administrativo / Terras Imobiliária
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  <link href="./assets/css/now-ui-dashboard.css" rel="stylesheet" />
</head>

<body>
  <?php
      if (($_SESSION['type'] != 1) and ($_SESSION['type'] != 2)){
        echo ("
      <script type= 'text/javascript'>alert('Acesso Restrito!');</script>
      <script>window.location = 'painel.php';</script>");
      }
    ?>
  <div class="wrapper">
    <?php include "views/sidebar.php"?>
    <div class="main-panel" id="main-panel">
    <?php include "views/navbar.php"?>

    <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Editar Cliente</h5>
              </div>
              <div class="card-body">
              <form method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="<?php echo $nome; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>CPF</label>
                        <input type="text" name="cpf" class="form-control" placeholder="CPF" value="<?php echo $cpf; ?>" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Estado Cívil</label>
                        <select name="estado_civil"  class="form-control">
                          <option value='<?php echo $estado_civil; ?>'><?php echo $estado_civil; ?></option>
                          <option value='Solteiro'>Solteiro</option>
                          <option value='Casado'>Casado</option>
                          <option value='Viúvo'>Viúvo</option>
                          <option value='Separado judicialmente'>Separado judicialmente</option>
                          <option value='Divorciado'>Divorciado</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Tipo de Renda</label>
                        <input type="text" name="renda_tipo" class="form-control" placeholder="Tipo da Renda" value="<?php echo $renda_tipo; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Valor da Renda</label>
                        <input type="text" name="renda_valor" class="form-control" placeholder="Digite um valor" value="<?php echo $renda_valor; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="endereco" class="form-control" placeholder="Endereço Completo" value="<?php echo $endereco; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Telefone 1</label>
                        <input value="<?php echo $telefone1; ?>" type="text" name="telefone1" class="form-control" placeholder="Número 1">
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Telefone 2</label>
                        <input type="text" value="<?php echo $telefone2; ?>" name="telefone2" class="form-control" placeholder="Número 2">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Trajetoria da Casa Propria</label>
                        <select name="status"  class="form-control">
                          <option value="<?php echo $status; ?>">
                            <?php
                              if ($status=='0') {
                                echo "TRIAGEM";
                              }
                              if ($status=='1') {
                                echo "1º Etapa (Análise de Crédito)";
                              }
                              if ($status=='2') {
                                echo "2º Etapa (Aprovação)";
                              }
                              if ($status=='3') {
                                echo "3º Etapa (Engenharia)";
                              }
                              if ($status=='4') {
                                echo "4º Etapa (Análise Técnica)";
                              }
                              if ($status=='5') {
                                echo "5º Etapa (Assinatura Contrato)";
                              }
                              if ($status=='6') {
                                echo "6º Etapa (Registro e Entrega das Chaves)";
                              }
                            ?>
                          </option>
                          <option value='2'>2º Etapa (Aprovação)</option>
                          <option value='3'>3º Etapa (Engenharia)</option>
                          <option value='4'>4º Etapa (Análise Técnica)</option>
                          <option value='5'>5º Etapa (Assinatura Contrato)</option>
                          <option value='6'>6º Etapa (Registro e Entrega das Chaves)</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Restrição</label>
                        <select name="restricao"  class="form-control">
                        <option value="<?php echo $restricao; ?>">
                            <?php
                              if ($restricao=='n') {
                                echo "NÃO";
                              }
                            ?>
                            <?php
                              if ($restricao=='s') {
                                echo "SIM";
                              }
                            ?>
                        </option>
                          <option value='n'>NÃO</option>
                          <option value='s'>SIM</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Preferência</label>
                        <input type="text" name="preferencia" class="form-control" placeholder="Preferência do Cliente" value="<?php echo $preferencia; ?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Equipe</label>
                        <select name="equipe"  class="form-control">
                        <option value="<?php echo $equipe; ?>">
                          <?php echo $equipe; ?>
                        </option>
                          <option value='azul'>AZUL</option>
                          <option value='branco'>BRANCO</option>
                          <option value='externa'>EXTERNA</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Cidade</label>
                        <input  value="<?php echo $cidade; ?>" type="text" name="cidade" class="form-control" placeholder="Cidade">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>FGTS</label>
                        <select name="fgts"  class="form-control">
                          <option value='n'>NÃO</option>
                          <option value='s'>SIM</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Valor do Imóvel</label>
                        <input type="text" value="<?php echo $valor_imovel; ?>" name="valor_imovel" class="form-control" placeholder="Digite um valor">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Dependente</label>
                        <input  value="<?php echo $dependente; ?>" type="text" name="dependente" class="form-control" placeholder="Dependente">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Corretor</label>
                        <input  value="<?php echo $corretor; ?>" type="text" name="corretor" class="form-control" placeholder="Corretor">
                      </div>
                    </div>
                  </div>
                  <h5>Arquivos</h5>
                  <label class="control-label pt-3">Arquivo 1</label>
                  <?php 
                   if (!($arq1=='')) {
                  ?>
                  <i class='bi bi-file-earmark-text-fill'></i> Arquivo 1 - <a target="_blank" href="images/clientes/<?php echo $row['arq1']; ?>">Visualizar</a>
                  <br>
                  <?php
                    }
                  ?>
                  <?php 
                   if ($arq1=='') {
                  ?>
                    <input type="text" name="nome_arq1" class="form-control" placeholder="Nome do Arquivo 1"> 
                    <br>
                    <input class="input-group" type="file" name="user_image" accept="image/*" />
                  <?php
                  }
                  ?>
                  <label class="control-label pt-3">Arquivo 2</label>
                  <?php 
                   if (!($arq2=='')) {
                  ?>
                  <i class='bi bi-file-earmark-text-fill'></i> Arquivo 1 - <a target="_blank" href="images/clientes/<?php echo $row['arq2']; ?>">Visualizar</a>
                  <br>
                  <?php
                    }
                  ?>
                  <?php 
                   if ($arq2=='') {
                  ?>
                    <input type="text" name="nome_arq2" class="form-control" placeholder="Nome do Arquivo 1"> 
                    <br>
                    <input class="input-group" type="file" name="user_image2" accept="image/*" />
                  <br>
                  <?php
                  }
                  ?>
                  <button type="submit" name="btnsave" class="btn btn-primary shadow-sm mt-4">
                      <span class="glyphicon glyphicon-save"></span><i class="fas fa-download fa-sm text-white-50"></i>Enviar
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php include "views/footer.php"; ?>