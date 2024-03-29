<?php
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
require_once './admin/dbconfig.php';
include './admin/lead-insert.php';
$dv = $_GET['dv'];
?>
<!doctype php>
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
  <!-- SLIDER -->
  <section>
    <div data-flickity='{"prevNextButtons": true,"pageDots": true, "autoPlay": true}'>

      <!-- Item -->
      <?php
      $stmt = $DB_con->prepare("SELECT id,nome,data_create,img,img2,link FROM banners ORDER BY id DESC");
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
      ?>

          <div class="w-100 img-contain">
            <a href="<?php echo $link ?>">
              <picture>
                <source media="(max-width: 576px)" srcset="admin/uploads/banners/<?php echo $row['img']; ?>">
                <source media="(min-width: 577px)" srcset="admin/uploads/banners/<?php echo $row['img']; ?>">
                <img class="w-100" src="admin/uploads/banners/<?php echo $row['img']; ?>">
              </picture>
            </a>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </section>


  <!-- Categorias 
  <section class="py-6">
    <div class="container">
       Slider 
      <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": false,"cellAlign": "center", "contain": true, "groupCells": true, "pageDots": false}'>

        <div class="category">
          <a href="search.php">
            <div class="category-icon">
              <i class="fas fa-box-open"></i>
            </div>
            <p class="text-center">Embalagens</p>
          </a>

        </div>

        <div class="category">
          <a href="search.php">
            <div class="category-icon">
              <i class="fas fa-cog"></i>
            </div>
            <p class="text-center"> Máquinas e Equipamentos</p>
          </a>

        </div>

        <div class="category">
          <a href="search.php">
            <div class="category-icon">
              <i class="fas fa-heart"></i>
            </div>
            <p class="text-center">Saúde</p>
          </a>

        </div>

        <div class="category">
          <a href="search.php">
            <div class="category-icon">
              <i class="fas fa-coffee"></i>
            </div>
            <p class="text-center">Utilidades Domésticas</p>
          </a>
        </div>

        <div class="category">
          <a href="search.php">
            <div class="category-icon">
              <i class="fas fa-seedling"></i>
            </div>
            <p class="text-center">Jardinagem</p>
          </a>

        </div>

      </div>
    </div>
  </section> -->
  <section class="py-8" id="leads">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h4>ATENDIMENTO DOMINUS. NÓS ENTRAMOS EM CONTATO COM VOCÊ</h4>
        </div>

        <div class="col-lg-8">
          <form class="form-inline" action="envia-email.php" method="POST">
            <input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required />
            <input type="text" class="form-control mb-2 phone" name="whats" placeholder="Número" required />
            <input type="hidden" type="text" name="dv" value="<?php echo $dv; ?>" />
            <input type="hidden" name="tipo" value="2">
            <input type="hidden" name="status" value="1">
            <button type="submit" class="btn btn-primary mb-2">Cadastrar</button>
          </form>
        </div>

      </div>
    </div>

  </section>
  <!-- Produtos -->
  <section class="py-4" style="background-color:#ebecf1">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Heading -->
          <h4 class="mb-5 pl-8">Novidades</h4>
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <?php
            $stmt = $DB_con->prepare("SELECT id,nome,price,category,img,desconto,valor_desconto FROM produtos where status='3' ORDER BY id DESC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
            ?>
                <div class="col-lg-3 col-md-6" style="min-width: 220px;">
                  <div class="card mb-7 shadow">

                    <!-- Image -->
                    <div class="card-img">
                      <!-- Image -->
                      <a class="card-img-hover" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                        <img class="card-img-top" src="admin/uploads/produtos/<?php echo $row['img']; ?>" alt="...">
                      </a>
                    </div>
                    <!-- Body -->
                    <div class="card-body  m-2 px-0">
                      <!-- Category -->
                      <div class="font-size-xs">
                        <a class="text-muted" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>"><?php echo $category ?></a>
                      </div>
                      <!-- Title -->
                      <div class="font-weight-bold">
                        <a class="text-body" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                          <?php echo $nome ?>
                        </a>
                      </div>
                      <!-- Price -->
                      <div class="font-weight-bold">

                          <span class="text-primary"><?php echo "R$ " . $price ?></span>
          
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Produtos em Oferta -->
  <section class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Heading -->
          <h4 class="mb-5 pl-8">Ofertas especiais</h4>
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <?php
            $stmt = $DB_con->prepare("SELECT id,nome,price,category,img,desconto,valor_desconto FROM produtos where status='2' ORDER BY id DESC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
            ?>
                <div class="col-lg-3 col-md-6" style="min-width: 220px;">
                  <div class="card mb-7">
                    <!-- Badge -->
                    <?php if ($desconto != '') { ?>
                      <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                        -<?php echo $desconto . "%" ?>
                      </div>
                    <?php } ?>
                    <!-- Image -->
                    <div class="card-img">
                      <!-- Image -->
                      <a class="card-img-hover" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                        <img class="card-img-top" src="admin/uploads/produtos/<?php echo $row['img']; ?>" alt="...">
                      </a>
                    </div>
                    <!-- Body -->
                    <div class="card-body px-0 m-2">
                      <!-- Category -->
                      <div class="font-size-xs">
                        <a class="text-muted" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>"><?php echo $category ?></a>
                      </div>
                      <!-- Title -->
                      <div class="font-weight-bold">
                        <a class="text-body" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                          <?php echo $nome ?>
                        </a>
                      </div>
                      <!-- Price -->
                      <div class="font-weight-bold">

                        <?php if ($valor_desconto  != '') { ?>
                          <span class="font-size-xs text-gray-350 text-decoration-line-through"><?php echo "R$ " . $price ?></span>
                          <span class="text-primary"><?php echo "R$ " . $valor_desconto ?></span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Produtos -->
  <section class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Heading -->
          <h4 class="mb-5 pl-8">Nossos produtos</h4>
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <?php
            $stmt = $DB_con->prepare("SELECT id,nome,price,category,img,desconto,valor_desconto FROM produtos where status='1' ORDER BY id DESC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
            ?>
                <div class="col-lg-3 col-md-6" style="min-width: 220px;">
                  <div class="card mb-7">

                    <!-- Image -->
                    <div class="card-img">
                      <!-- Image -->
                      <a class="card-img-hover" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                        <img class="card-img-top" src="admin/uploads/produtos/<?php echo $row['img']; ?>" alt="...">
                      </a>
                    </div>
                    <!-- Body -->
                    <div class="card-body px-0">
                      <!-- Category -->
                      <div class="font-size-xs">
                        <a class="text-muted" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>"><?php echo $category ?></a>
                      </div>
                      <!-- Title -->
                      <div class="font-weight-bold">
                        <a class="text-body" href="<?php echo $URI->base('/produto/' . $id . '/' . slugify($nome)); ?>">
                          <?php echo $nome ?>
                        </a>
                      </div>
                      <!-- Price -->
                      <div class="font-weight-bold">

                          <span class="text-primary"><?php echo "R$ " . $price ?></span>
          
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOG -->
  <section class="py-8 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Preheading -->
          <h6 class="heading-xxs mb-3 text-center text-gray-400">
            Nosso Blog
          </h6>
          <!-- Heading -->
          <h2 class="mb-10 text-center">Últimas do blog</h2>
        </div>
        <div class="col-12">
          <!-- Heading -->
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <?php
            $stmt = $DB_con->prepare("SELECT id,titulo,categoria_1,img1,data_criacao FROM posts ORDER BY id DESC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
            ?>
                <div class="col-lg-3 col-md-6" style="min-width: 220px;">
                  <div class="card mb-7">

                    <!-- Image -->
                    <div class="card-img">
                      <!-- Image -->
                      <a class="card-img-hover" href="<?php echo $URI->base('/blog-post/' . $id . '/' . slugify($titulo)); ?>">
                        <img class="card-img-top" src="admin/uploads/blog/<?php echo $row['img1']; ?>" alt="...">
                      </a>
                    </div>
                    <!-- Body -->
                    <div class="card-body px-0">
                      <!-- Category -->
                      <div class="font-size-xs">
                        <a class="text-muted" href="<?php echo $URI->base('/blog-post/' . $id . '/' . slugify($titulo)); ?>"><?php echo $categoria_1 ?></a>
                      </div>
                      <!-- Title -->
                      <div class="font-weight-bold">
                        <a class="text-body" href="<?php echo $URI->base('/blog-post/' . $id . '/' . slugify($titulo)); ?>">
                          <?php echo $titulo ?>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-8" id="leads">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          Quer saber todos os lançamentos e promoções da nossa loja? Deixe seu email com a gente!
        </div>

        <div class="col-lg-8">
          <form class="form-inline" action="envia-email.php" method="POST">
            <input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required />
            <input type="text" class="form-control mb-2" name="email" placeholder="Email" required />
            <input type="hidden" type="text" name="dv" value="<?php echo $dv; ?>" />
            <input type="hidden" name="tipo" value="3">
            <input type="hidden" name="status" value="1">
            <button type="submit" class="btn btn-primary mb-2">Cadastrar</button>
          </form>
        </div>

      </div>
    </div>

  </section>
  <?php include "views/footer.php" ?>
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