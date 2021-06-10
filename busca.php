<?php
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
require_once 'admin/dbconfig.php';
include './admin/lead-insert.php';
// palavra digitada na busca 
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
$sql = "SELECT * FROM produtos WHERE nome LIKE :pesquisa OR category LIKE :pesquisa";

// cria o Prepared Statement e o executa
$stmt = $DB_con->prepare($sql);
$stmt->bindValue(':pesquisa', '%' . $pesquisa . '%');
$stmt->execute();

// cria um array com os resultados
$busca = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Distribuidora Dominus" name="description">
  <!-- Favicons -->
  <link rel="icon" href="./assets/images/favicon.ico">
  <!-- Libs CSS -->
  <link rel="stylesheet" href="./assets/libs/jquery.fancybox.min.css">
  <link rel="stylesheet" href="./assets/libs/flickity.min.css">
  <link rel="stylesheet" href="./assets/libs/vs2015.css">
  <link rel="stylesheet" href="./assets/libs/simplebar.min.css">
  <link rel="stylesheet" href="./assets/libs/flickity-fade.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
  <!-- Theme CSS -->
  <link rel="stylesheet" href="./assets/css/theme.css">
  <title>Distribuidora Dominus </title>
</head>

<body>

  <?php include "views/nav.php" ?>
  <!-- CONTENT -->
  <section class="py-11">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-3">

          <!-- Filters -->
          <form class="mb-10 mb-md-0 mr-5">
            <ul class="nav nav-vertical" id="filterNav">
              <li class="nav-item">
                <div class="border-bottom mb-6 w-100"><b>Categorias</b></div>
                <!-- Collapse -->
                <div class="collapse show" id="categoryCollapse">
                  <div class="form-group">
                    <ul class="list-styled mb-0" id="productsNav">
                      <li class="list-styled-item">
                        <a class="list-styled-link" href="busca.php">
                          Todos os produtos
                        </a>
                      </li>
                      <?php

                      $stmt = $DB_con->prepare("SELECT id, nome, tipo FROM categorys where tipo='produto'");
                      $stmt->execute();

                      if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          extract($row);
                      ?>
                          <li class="list-styled-item">

                            <!-- Toggle -->
                            <a class="list-styled-link" data-toggle="collapse" href="<?php echo $URI->base("/busca.php?pesquisa=$nome") ?>">
                            <?php echo $nome ?>
                            </a>

                          </li>
                      <?php
                        }
                      }
                      ?>

                    </ul>
                  </div>
                </div>

              </li>

            </ul>
          </form>

        </div>
        <div class="col-12 col-md-8 col-lg-9">

          <!-- Header -->
          <div class="row align-items-center mb-7">
            <div class="col-12 col-md">

              <!-- Heading -->
              <h3 class="mb-1"><?php echo $pesquisa ?></h3>

              <!-- Breadcrumb -->
              <ol class="breadcrumb mb-0 font-size-xs text-gray-400">
                <li class="breadcrumb-item">
                  <a class="text-gray-400" href="home">Página inicial <i class="fas fa-angle-right"></i></a>
                </li>
                <li class="breadcrumb-item active">
                  <?php echo $pesquisa ?>
                </li>
              </ol>

            </div>

          </div>

          <!-- Products -->
          <div class="row">
            <?php
            if (count($busca) > 0) :
              foreach ($busca as $busca) :
            ?>

                <div class="col-12 col-md-4">

                  <!-- Card -->
                  <div class="card mb-7">
                    <!-- Image -->
                    <div class="card-img">
                      <!-- Image -->
                      <a class="card-img-hover" href="<?php echo $URI->base('/produto/' . $busca['id'] . '/' . slugify($busca['nome'])); ?>">
                        <img class="card-img-top" src="./admin/uploads/produtos/<?php echo $busca['img']; ?>" alt="...">
                      </a>

                    </div>

                    <!-- Body -->
                    <div class="card-body px-0">
                      <!-- Category -->
                      <div class="font-size-xs">
                        <a class="text-muted"><?php echo $busca['category']; ?></a>
                      </div>
                      <!-- Title -->
                      <div class="font-weight-bold">
                        <a class="text-body" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                          <?php echo $busca['nome']; ?>
                        </a>
                      </div>
                      <!-- Price -->
                      <div class="font-weight-bold text-muted">
                        R$ <?php echo $busca['price']; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach;
            else :
              ?>
          </div>

          <div class="search-else">
            <button class="btn btn-primary">Nenhum resultado encontrado...</button>
          </div>
          <div class="form-busca-else pt-4">
            <form action="" method="POST">
              <p>Ajudamos você a encontrar o seu produto ideal, preencha o formulário</p>
              <div class="row">
                <div class="form-group col-lg-6 col-6">
                  <label class="modal-label" for="NomeSobrenome">Nome</label>
                  <input type="text" name="nome" class="form-control shadow-none" id="nome" placeholder="Digite seu nome" required>
                </div>
                <div class="form-group col-lg-6 col-6">
                  <label class="modal-label" for="Whats">Whatsapp</label>
                  <input size="20" maxlength="14" type="tel" class="form-control shadow-none phone" name="whats" placeholder="Número" required>
                </div>
              </div>
              <div class="form-group">
                <label class="modal-label" for="Email">Email</label>
                <input type="text" class="form-control shadow-none" name="email" id="email" placeholder="E-mail" required />
              </div>
              <div class="form-group pb-3">
                <textarea class="form-control shadow-none" name="mensagem" rows="3" placeholder="Nos deixe uma mensagem (Opcional)"></textarea>
              </div>
              <input type="hidden" type="text" name="dv" value="<?php echo $dv; ?>" />
              <input type="hidden" name="tipo" value="1">
              <input type="hidden" name="status" value="1">
              <div class="text-center"><button type="submit" class="btn btn-primary" name="submit">Enviar</button></div>
            </form>
          </div>
        </div>
      <?php endif; ?>
      </div>
    </div>
    </div>
    </div>
  </section>
  <?php include "views/footer.php" ?>
  <!-- JAVASCRIPT -->
  <!-- Libs JS -->
  <script src="<?php echo $URI->base('/assets/libs/js/jquery.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/jquery.fancybox.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/flickity.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/highlight.pack.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/jarallax.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/list.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/simplebar.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/smooth-scroll.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/flickity-fade.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
  <script src="<?php echo $URI->base('/assets/js/theme.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/js/jquery.mask.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/js/custom.js') ?>"></script>

  <script>
    $('.phone').mask('(00) 00000-0000');
  </script>
</body>

</html>