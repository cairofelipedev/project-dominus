<?php 
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
require_once 'admin/dbconfig.php';

// palavra digitada na busca 
$pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : ''; $sql = "SELECT * FROM produtos WHERE nome LIKE :pesquisa OR category LIKE :pesquisa"; 

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
                          <a class="list-styled-link" href="#">
                            Todos os produtos
                          </a>
                        </li>
                        <li class="list-styled-item">

                          <!-- Toggle -->
                          <a class="list-styled-link" data-toggle="collapse" href="#blousesCollapse">
                            Embalagens
                          </a>

                          <!-- Collapse -->
                          <div class="collapse" id="blousesCollapse" data-parent="#productsNav">
                            <div class="py-4 pl-5">
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="blousesOne" type="checkbox">
                                <label class="custom-control-label" for="blousesOne">
                                  Todos
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="blousesTwo" type="checkbox">
                                <label class="custom-control-label" for="blousesTwo">
                                  Subcategoria 1
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="blousesThree" type="checkbox">
                                <label class="custom-control-label" for="blousesThree">
                                  Subcategoria 2
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="blousesFour" type="checkbox">
                                <label class="custom-control-label" for="blousesFour">
                                  Subcategoria 3
                                </label>
                              </div>
                            </div>
                          </div>

                        </li>
                        <li class="list-styled-item">

                          <!-- Toggle -->
                          <a class="list-styled-link" data-toggle="collapse" href="#coatsCollapse">
                            Máquinas e Equipamentos
                          </a>

                          <!-- Collapse -->
                          <div class="collapse" id="coatsCollapse" data-parent="#productsNav">
                            <div class="py-4 pl-5">
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="coatsOne" type="checkbox">
                                <label class="custom-control-label" for="coatsOne">
                                  Todos
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="coatsTwo" type="checkbox">
                                <label class="custom-control-label" for="coatsTwo">
                                  Subcategoria 1
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="coatsThree" type="checkbox">
                                <label class="custom-control-label" for="coatsThree">
                                  Subcategoria 2
                                </label>
                              </div>
                            </div>
                          </div>

                        </li>
                        <li class="list-styled-item">

                          <!-- Toggle -->
                          <a class="list-styled-link" data-toggle="collapse" href="#dressesCollapse" aria-expanded="false">
                            Saúde
                          </a>

                          <!-- Collapse -->
                          <div class="collapse" id="dressesCollapse" data-parent="#productsNav">
                            <div class="py-4 pl-5">
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="dressesOne" type="checkbox">
                                <label class="custom-control-label" for="dressesOne">
                                  Todos
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="dressesTwo" type="checkbox">
                                <label class="custom-control-label" for="dressesTwo">
                                  Subcategoria 1
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="dressesThree" type="checkbox">
                                <label class="custom-control-label" for="dressesThree">
                                  Subcategoria 2
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="dressesFour" type="checkbox">
                                <label class="custom-control-label" for="dressesFour">
                                  Subcategoria 3
                                </label>
                              </div>
                            </div>
                          </div>

                        </li>
                        <li class="list-styled-item">

                          <!-- Toggle -->
                          <a class="list-styled-link" data-toggle="collapse" href="#hoodiesCollapse">
                            <b>Utilidades Domésticas</b>
                          </a>

                          <!-- Collapse -->
                          <div class="collapse show" id="hoodiesCollapse" data-parent="#productsNav">
                            <div class="py-4 pl-5">
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="hoodiesOne" type="checkbox" checked>
                                <label class="custom-control-label" for="hoodiesOne">
                                  Todos
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="hoodiesTwo" type="checkbox" checked>
                                <label class="custom-control-label" for="hoodiesTwo">
                                  Subcategoria 1
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="hoodiesThree" type="checkbox" checked>
                                <label class="custom-control-label" for="hoodiesThree">
                                  Subcategoria 2
                                </label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="hoodiesFour" type="checkbox" checked>
                                <label class="custom-control-label" for="hoodiesFour">
                                  Subcategoria 3
                                </label>
                              </div>
                            </div>
                          </div>

                        </li>

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
                <h3 class="mb-1">Utilidades Domésticas</h3>

                <!-- Breadcrumb -->
                <ol class="breadcrumb mb-0 font-size-xs text-gray-400">
                  <li class="breadcrumb-item">
                    <a class="text-gray-400" href="index.html">Página inicial <i class="fas fa-angle-right"></i></a>
                  </li>
                  <li class="breadcrumb-item active">
                    Utilidades Domésticas
                  </li>
                </ol>

              </div>

            </div>

            <!-- Products -->
            <div class="row">
            
              <div class="col-12 col-md-4">

                <!-- Card -->
                <div class="card mb-7">

                  <!-- Badge -->
                  <div class="badge badge-white card-badge card-badge-left text-uppercase d-none">
                    New
                  </div>

                  <!-- Image -->
                  <div class="card-img">

                    <!-- Image -->
                    <a class="card-img-hover" href="product.html">
                      <img class="card-img-top" src="assets/images/produto5.jpeg" alt="...">
                    </a>

                  </div>

                  <!-- Body -->
                  <div class="card-body px-0">

                    <!-- Category -->
                    <div class="font-size-xs">
                      <a class="text-muted" href="search.html">Utilidades Domésticas</a>
                    </div>

                    <!-- Title -->
                    <div class="font-weight-bold">
                      <a class="text-body" href="product.html">
                        Porcelana (und)
                      </a>
                    </div>

                    <!-- Price -->
                    <div class="font-weight-bold text-muted">
                      $16,00
                    </div>

                  </div>

                </div>

              </div>

            

              
            </div>

            <!-- Pagination -->
            <nav class="d-flex justify-content-center justify-content-md-end">
              <ul class="pagination pagination-sm text-gray-400">
                <li class="page-item">
                  <a class="page-link page-link-arrow" href="#">
                    <i class="fa fa-caret-left"></i>
                  </a>
                </li>
                <li class="page-item active">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link page-link-arrow" href="#">
                    <i class="fa fa-caret-right"></i>
                  </a>
                </li>
              </ul>
            </nav>

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
<script src="./assets/libs/js/jquery.min.js"></script>
<script src="./assets/libs/js/jquery.fancybox.min.js"></script>
<script src="./assets/libs/js/bootstrap.bundle.min.js"></script>
<script src="./assets/libs/js/flickity.js"></script>
<script src="./assets/libs/js/highlight.pack.min.js"></script>
<script src="./assets/libs/js/jarallax.min.js"></script>
<script src="./assets/libs/js/list.min.js"></script>
<script src="./assets/libs/js/simplebar.min.js"></script>
<script src="./assets/libs/js/smooth-scroll.min.js"></script>
<script src="./assets/libs/js/flickity-fade.js"></script>
<!-- Map (replace the API key to enable) -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnKt8_N4-FKOnhI_pSaDL7g_g-XI1-R9E"></script>
<!-- Theme JS -->
<script src="./assets/js/theme.min.js"></script>
  </body>
</html>
