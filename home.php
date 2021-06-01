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
  <div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">
      <?php
      $stmt = $DB_con->prepare("SELECT id,nome,data_create,img,img2 FROM banners ORDER BY id DESC");
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
      ?>
          <div class="carousel-item-a intro-item">
            <img class="img-fluid" src="admin/uploads/banners/<?php echo $row['img']; ?>">
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div><!-- End Intro Section -->

  <!-- Categorias -->
  <section class="py-6">
    <div class="container">
      <!-- Slider -->
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
  </section>
  <section class="py-8" id="leads">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h4>NÓS LIGAMOS PRA VOCÊ</h4>
        </div>

        <div class="col-lg-8">
          <form class="form-inline" action="" method="POST">
            <input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required />
            <input type="text" class="form-control mb-2 phone" name="whats" placeholder="Número" required />
            <input type="hidden" type="text" name="dv" value="<?php echo $dv; ?>" />
            <input type="hidden" name="tipo" value="2">
            <input type="hidden" name="status" value="1">
            <button type="submit" name="submit2" class="btn btn-primary mb-2">Casdastrar</button>
          </form>
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
                    -<?php echo $desconto."%" ?>
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
                        
                        <?php if ($valor_desconto  != '') { ?>
                        <span class="font-size-xs text-gray-350 text-decoration-line-through"><?php echo "R$ ".$price ?></span>
                        <span class="text-primary"><?php echo "R$ ".$valor_desconto ?></span>
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
                        
                        <?php if ($valor_desconto  != '') { ?>
                        <span class="text-primary"><?php echo "R$ ".$price ?></span>
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
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <!-- Card -->
          <a href="blog-post.php">
            <div class="card mb-7 shadow shadow-hover lift h-100">
              <!-- Image -->
              <div class="card-img">
                <img src="assets/images/blog1.jpg" alt="..." class="card-img-top">
              </div>

              <!-- Body -->
              <div class="card-body px-8 py-7">
                <!-- Time -->
                <p class="mb-3 font-size-xs">
                  <span class="text-muted">Dez 23, 2020</span>
                </p>
                <!-- Heading -->
                <h6 class="mb-0">
                  Como higienizar os produtos durante a pandemia
                </h6>
              </div>
            </div>
          </a>

        </div>
        <div class="col-12 col-md-4">
          <!-- Card -->
          <a href="blog-post.php">
            <div class="card mb-7 shadow shadow-hover lift h-100">
              <!-- Image -->
              <div class="card-img">
                <img src="assets/images/blog2.jpg" alt="..." class="card-img-top">
              </div>
              <!-- Body -->

              <div class="card-body px-8 py-7 h-100">
                <!-- Time -->
                <p class="mb-3 font-size-xs">
                  <span class="text-muted">Jan 22, 2021</span>
                </p>

                <!-- Heading -->
                <h6 class="mb-0">
                  Reciclando garrafas PET em casa
                </h6>
              </div>
            </div>
          </a>

        </div>
        <div class="col-12 col-md-4">
          <!-- Card -->
          <a href="blog-post.php">
            <div class="card mb-7 shadow shadow-hover lift h-100">
              <!-- Image -->
              <div class="card-img">
                <img src="assets/images/blog3.jpg" alt="..." class="card-img-top">
              </div>
              <!-- Body -->
              <div class="card-body px-8 py-7">

                <!-- Time -->
                <p class="mb-3 font-size-xs">
                  <span class="text-muted">Fev 08, 2021</span>
                </p>

                <!-- Heading -->
                <h6 class="mb-0">
                  Dicas de como aproveitar o carnaval em casa
                </h6>

              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">

          <!-- Link -->
          <div class="mt-7 text-center">
            <a class="link-underline" href="blog.php">Descubra mais</a>
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
        <form class="form-inline" action="" method="POST">
            <input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required />
            <input type="text" class="form-control mb-2" name="email" placeholder="Email" required />
            <input type="hidden" type="text" name="dv" value="<?php echo $dv; ?>" />
            <input type="hidden" name="tipo" value="3">
            <input type="hidden" name="status" value="1">
            <button type="submit" name="submit3" class="btn btn-primary mb-2">Casdastrar</button>
          </form>
        </div>

      </div>
    </div>

  </section>
  <?php include "views/footer.php" ?>
  <!-- JAVASCRIPT -->
  <!-- Libs JS -->
  <script src="./assets/libs/js/jquery.min.js"></script>
  <script src="./assets/libs/js/jquery.fancybox.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <!-- <script src="https://flickity.metafizzy.co/flickity.pkgd.js"></script> -->
  <script src="./assets/libs/js/flickity.js"></script>
  <script src="./assets/libs/js/highlight.pack.min.js"></script>
  <script src="./assets/libs/js/jarallax.min.js"></script>
  <script src="./assets/libs/js/list.min.js"></script>
  <script src="./assets/libs/js/simplebar.min.js"></script>
  <script src="./assets/libs/js/smooth-scroll.min.js"></script>
  <script src="./assets/libs/js/flickity-fade.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
  <!-- Theme JS -->
  <script src="./assets/js/theme.min.js"></script>
  <script src="./assets/js/jquery.mask.min.js"></script>
  <script src="./assets/js/custom.js"></script>

  <script>
    $('.phone').mask('(00) 00000-0000');
    $('#carousel').owlCarousel({
      loop: true,
      margin: -1,
      items: 1,
      nav: true,
      navText: ['<i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i>'],
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true
    });
  </script>
</body>

</html>