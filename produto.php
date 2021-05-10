<?php
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
require_once './admin/dbconfig.php';
include './admin/lead-insert.php';
$url = explode("/", $_SERVER['REQUEST_URI']);
(is_numeric($url[3])) ? $idProduto = $url[3] : $idProduto = 1;

$stmt = $DB_con->prepare("SELECT nome,category FROM produtos where id='$idProduto' ORDER BY id DESC");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  extract($row);
  $produto = $nome;
  $category2 = $category;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Distribuidora Dominus" name="description">
  <!-- Favicons -->
  <link rel="icon" href="<?php echo $URI->base('/assets/images/favicon.ico') ?>">
  <!-- Libs CSS -->
  <link rel="stylesheet" href="<?php echo $URI->base('/assets/libs/jquery.fancybox.min.css') ?>">
  <link rel="stylesheet" href="<?php echo $URI->base('/assets/libs/flickity.min.css') ?>">
  <link rel="stylesheet" href="<?php echo $URI->base('/assets/libs/vs2015.css') ?>">
  <link rel="stylesheet" href="<?php echo $URI->base('/assets/libs/simplebar.min.css') ?>">
  <link rel="stylesheet" href="<?php echo $URI->base('/assets/libs/flickity-fade.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
  <!-- Theme CSS -->
  
  <link rel="stylesheet" href="<?php echo $URI->base('/assets/css/theme.css') ?>">
  <title><?php echo $produto ?></title>
</head>

<body>

  <?php include "views/nav.php" ?>

  <!-- BREADCRUMB -->
  <nav class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">

          <!-- Breadcrumb -->
          <ol class="breadcrumb mb-0 font-size-xs text-gray-400">
            <li class="breadcrumb-item">
              <a class="text-gray-400" href="<?php echo $URI->base('/home')?>">Página inicial <i class="fas fa-angle-right"></i></a>
            </li>
            <li class="breadcrumb-item">
              <a class="text-gray-400" href="<?php echo $URI->base('/busca.php?pesquisa='.$category2.''); ?>">Utilidades Domésticas <i class="fas fa-angle-right"></i></a>
            </li>
            <li class="breadcrumb-item active">
              <?php echo $produto; ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </nav>

  <!-- PRODUCT -->
  <?php

  $stmt = $DB_con->prepare("SELECT id, nome, descricao,category,price, img,img2,img3 FROM produtos where nome='$produto'");
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
  ?>
      <section>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="row">
                <div class="col-12 col-md-6">
                  <!-- Card -->
                  <div class="card">
                    <!-- Badge -->
                    <div class="badge badge-danger card-badge text-uppercase">
                      -40%
                    </div>
                    <!-- Slider -->
                    <div class="mb-4" data-flickity='{"draggable": false, "fade": true, "wrapAround": true}' id="productSlider">
                      <!-- Item -->
                      <a href="assets/images/produto2.jpeg" class="w-100" data-fancybox>
                        <img src="<?php echo $URI->base('/admin/uploads/produtos/'.$row['img'].'')?>" alt="..." class="card-img-top">
                      </a>
                      <!-- Item -->
                      <a href="assets/images/produto3.jpeg" class="w-100" data-fancybox>
                        <img src="<?php echo $URI->base('/admin/uploads/produtos/'.$row['img2'].'')?>" alt="..." class="card-img-top">
                      </a>
                      <!-- Item -->
                      <a href="assets/images/produto12.jpeg" class="w-100" data-fancybox>
                        <img src="<?php echo $URI->base('/admin/uploads/produtos/'.$row['img3'].'')?>" alt="..." class="card-img-top">
                      </a>
                    </div>
                  </div>
                  <!-- Slider -->
                  <div class="flickity-nav mx-n2 mb-10 mb-md-0" data-flickity='{"asNavFor": "#productSlider", "contain": true, "wrapAround": false}'>
                    <!-- Item -->
                    <div class="col-12 px-2" style="max-width: 113px;">
                      <!-- Image -->
                      <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/'.$row['img'].'')?>);"></div>
                    </div>
                    <!-- Item -->
                    <div class="col-12 px-2" style="max-width: 113px;">
                      <!-- Image -->
                      <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/'.$row['img2'].'')?>);"></div>
                    </div>
                    <!-- Item -->
                    <div class="col-12 px-2" style="max-width: 113px;">
                      <!-- Image -->
                      <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/'.$row['img3'].'')?>);"></div>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 pl-lg-10">
                  <!-- Header -->
                  <div class="row mb-1">
                    <div class="col">
                      <!-- Preheading -->
                      <a class="text-muted" href="search.html"><?php echo $category ?></a>
                    </div>
                  </div>

                  <!-- Heading -->
                  <h3 class="mb-2"><?php echo $nome ?></h3>
                  <!-- Price -->
                  <div class="mb-7">
                    <span class="text-gray-350 text-decoration-line-through font-size-lg font-weight-bold">R$170,99</span>
                    <span class="text-primary font-size-h5 font-weight-bold"><?php echo $price ?></span>
                  </div>

                  <div class="form-group">
                    <!-- Label -->
                    <h6>Descrição</h6>
                    <p class="mb-5">
                      <?php echo $descricao ?>
                    </p>
                    <!-- Radio -->

                    <div class="form-row mb-7">
                      <div class="col-12 col-lg">
                        <!-- Submit -->
                        <a class="btn btn-block btn-primary mb-2 text-white" target="_blank" href="https://api.whatsapp.com/send?phone=5586994459897&text=Ol%C3%A1!%20Gostaria%20de%20comprar%3A%20Tapete%20higi%C3%AAnico%20para%20carro">
                          <i class="fab fa-whatsapp ml-2"></i> Solicitar
                        </a>
                      </div>
                    </div>

                    <!-- Share -->
                    <p class="mb-0">
                      <span class="mr-4">Compartilhar:</span>
                      <a class="btn btn-xxs btn-circle btn-light font-size-xxxs text-gray-350" href="#!">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <a class="btn btn-xxs btn-circle btn-light font-size-xxxs text-gray-350" href="#!">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a class="btn btn-xxs btn-circle btn-light font-size-xxxs text-gray-350" href="#!">
                        <i class="fab fa-whatsapp"></i>
                      </a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  <?php
    }
  } ?>

  <!-- PRODUCTS -->
  <section class="pt-11">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Heading -->
          <h4 class="mb-10 text-center">Você pode gostar também</h4>
          <!-- Items -->
          <div class="row">
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
              <!-- Card -->
              <a href="product.html">
                <div class="card mb-7">

                  <div class="card-img">
                    <img class="card-img-top" src="assets/images/produto1.jpeg" alt="...">
                  </div>
                  <!-- Body -->
                  <div class="card-body px-0">
                    <!-- Category -->
                    <div class="font-size-xs">
                      <a class="text-muted" href="search.html">Embalagem</a>
                    </div>
                    <!-- Title -->
                    <div class="font-weight-bold">
                      <a class="text-body" href="">
                        Cachaça Burarama 600ml
                      </a>
                    </div>
                    <!-- Price -->
                    <div class="font-weight-bold text-muted">
                      R$11.00
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
              <!-- Card -->
              <a href="product.html">
                <div class="card mb-7">

                  <div class="card-img">
                    <img class="card-img-top" src="assets/images/produto9.jpeg" alt="...">
                  </div>
                  <!-- Body -->
                  <div class="card-body px-0">
                    <!-- Category -->
                    <div class="font-size-xs">
                      <a class="text-muted" href="search.html">Utilidades Domésticas</a>
                    </div>
                    <!-- Title -->
                    <div class="font-weight-bold">
                      <a class="text-body" href="">
                        Conjunto chá
                      </a>
                    </div>
                    <!-- Price -->
                    <div class="font-weight-bold text-muted">
                      R$76.00
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
              <!-- Card -->
              <a href="product.html">
                <div class="card mb-7">

                  <div class="card-img">
                    <img class="card-img-top" src="assets/images/produto5.jpeg" alt="...">
                  </div>
                  <!-- Body -->
                  <div class="card-body px-0">
                    <!-- Category -->
                    <div class="font-size-xs">
                      <a class="text-muted" href="search.html">Utilidades Domésticas</a>
                    </div>
                    <!-- Title -->
                    <div class="font-weight-bold">
                      <a class="text-body" href="">
                        Bowl de Porcelana
                      </a>
                    </div>
                    <!-- Price -->
                    <div class="font-weight-bold text-muted">
                      R$76.00
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
              <!-- Card -->
              <a href="product.html">
                <div class="card mb-7">

                  <div class="card-img">
                    <img class="card-img-top" src="assets/images/produto10.jpeg" alt="...">
                  </div>
                  <!-- Body -->
                  <div class="card-body px-0">
                    <!-- Category -->
                    <div class="font-size-xs">
                      <a class="text-muted" href="search.html">Utilidades Domésticas</a>
                    </div>
                    <!-- Title -->
                    <div class="font-weight-bold">
                      <a class="text-body" href="">
                        Pote de barro
                      </a>
                    </div>
                    <!-- Price -->
                    <div class="font-weight-bold text-muted">
                      R$26.00
                    </div>
                  </div>
                </div>
              </a>
            </div>


          </div>
        </div>
      </div>
  </section>

  <!-- Whatsapp -->
  <div class="whatsapp">
    <a href="https://wa.me/5586994459897" target="_blank" class="text-white"><i class="fab fa-whatsapp"></i></a>
  </div>

  <section class="py-8" id="leads">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          Quer saber todos os lançamentos e promoções da nossa loja? Deixe seu email com a gente!
        </div>

        <div class="col-lg-8">
          <form class="form-inline">
            <input type="text" class="form-control mb-2" placeholder="Nome" required />
            <input type="email" class="form-control mb-2" placeholder="Email" required />
            <button type="submit" class="btn btn-primary mb-2">Casdastrar</button>
          </form>
        </div>

      </div>
    </div>

  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="py-12 border-bottom border-opacity">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-12 my-auto">
            <h4 class="mb-6 text-white text-center"><img width="200px" src="./assets/images//logo3.png"></h4>
            <!-- Social -->
            <ul class="list-unstyled list-inline mb-7 mb-md-0 text-center">
              <li class="list-inline-item">
                <a href="https://wa.me/5586994459897" target="_blank" class="text-gray-300">
                  <i class="fa-2x fab fa-whatsapp"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.instagram.com/dominus_distribuidora/" target="_blank" class="text-gray-300">
                  <i class="fa-2x fab fa-instagram"></i>
                </a>
              </li>
            </ul>

          </div>
          <div class="col-md-3">
            <!-- Heading -->
            <h6 class="heading-xxs mb-4 text-white">
              Produtos
            </h6>
            <!-- Links -->
            <ul class="list-unstyled mb-7 mb-sm-0">
              <li>
                <a class="text-gray-300" href="">Embalagens </a>
              </li>
              <li>
                <a class="text-gray-300" href="">Máquinas e Equipamentos</a>
              </li>
              <li>
                <a class="text-gray-300" href="">Saúde</a>
              </li>
              <li>
                <a class="text-gray-300" href="">Utilidades Domésticas</a>
              </li>

            </ul>
          </div>
          <div class="col-md-5">
            <!-- Heading -->
            <h6 class="heading-xxs mb-4 text-white">
              Contato
            </h6>
            <!-- Links -->
            <ul class="list-unstyled mb-0">
              <li>
                <a class="text-gray-300" target="_blank" href="https://www.google.com/maps/place/Condom%C3%ADnio+Edif%C3%ADcio+Jesus+Thomaz+Tajra+-+R.+Rui+Barbosa,+146+-+308+-+Centro+(Sul),+Teresina+-+PI,+64000-090/@-3.7722139,-38.5795397,15z/data=!3m1!4b1!4m2!3m1!1s0x78e377b4e7fb103:0x602a5261095f246a"><i class="fas fa-map-marker-alt"></i> Rua Rui Barbosa 146, sala 308, Centro, Teresina - PI
                </a>
              </li>
              <li>
                <a class="text-gray-300" href="mailto:dominusdistribuidora@hotmail.com"><i class="fas fa-envelope"></i> dominusdistribuidora@hotmail.com</a>
              </li>
              <li>
                <a class="text-gray-300" href="tel:86994459897"><i class="fas fa-phone-alt"></i> (86) 99445-9897</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="py-6">
      <div class="container">
        <div class="row">
          <div class="col">
            <!-- Copyright -->
            <p class="mb-3 mb-md-0 font-size-xxs text-white text-center">
              © 2021 Todos os direitos reservados
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- JAVASCRIPT -->
  <!-- Libs JS -->
  <script src="<?php echo $URI->base('/assets/libs/js/jquery.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/jquery.fancybox.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/flickity.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/highlight.pack.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/jarallax.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/list.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/simplebar.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/smooth-scroll.min.js') ?>"></script>
  <script src="<?php echo $URI->base('/assets/libs/js/flickity-fade.js') ?>"></script>

  <!-- Theme JS -->
  <script src="<?php echo $URI->base('/assets/libs/js/jquery.min.js') ?>./assets/js/theme.min.js"></script>
</body>

</html>