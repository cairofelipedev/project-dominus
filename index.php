<?php
require_once './admin/dbconfig.php';
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

  <!-- Produtos -->
  <section class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Heading -->
          <h4 class="mb-5 pl-8">Mais Vendidos</h4>
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <?php
            $stmt = $DB_con->prepare("SELECT id,nome,price,category,img FROM produtos ORDER BY id DESC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
            ?>
                <div class="col-lg-3 col-md-6" style="min-width: 220px;">
                  <div class="card mb-7">
                    <!-- Badge -->
                    <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                      -10%
                    </div>
                    <!-- Image -->
                    <div class="card-img">
                      <!-- Image -->
                      <a class="card-img-hover" href="product.php?nome=<?php echo $nome ?>">
                        <img class="card-img-top" src="admin/uploads/produtos/<?php echo $row['img']; ?>" alt="...">
                      </a>
                    </div>
                    <!-- Body -->
                    <div class="card-body px-0">
                      <!-- Category -->
                      <div class="font-size-xs">
                        <a class="text-muted" href="search.php"><?php echo $category ?></a>
                      </div>
                      <!-- Title -->
                      <div class="font-weight-bold">
                        <a class="text-body" href="produto.php?nome=<?php echo $nome ?>">
                        <?php echo $nome ?>
                        </a>
                      </div>
                      <!-- Price -->
                      <div class="font-weight-bold">
                        <span class="font-size-xs text-gray-350 text-decoration-line-through">$300,00</span>
                        <span class="text-primary">$230,00</span>
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
          <h4 class="mb-5 pl-8">Ofertas especiais</h4>
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <div class="col-lg-3 col-md-6" style="min-width: 220px;">
              <div class="card mb-7">

                <!-- Badge -->
                <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                  -10%
                </div>

                <!-- Image -->
                <div class="card-img">

                  <!-- Image -->
                  <a class="card-img-hover" href="product.php">
                    <img class="card-img-top" src="assets/images/produto8.jpeg" alt="...">
                  </a>

                </div>

                <!-- Body -->
                <div class="card-body px-0">

                  <!-- Category -->
                  <div class="font-size-xs">
                    <a class="text-muted" href="search.php">Utilidades Domésticas</a>
                  </div>

                  <!-- Title -->
                  <div class="font-weight-bold">
                    <a class="text-body" href="product.php">
                      Conjunto chá completo azul
                    </a>
                  </div>

                  <!-- Price -->
                  <div class="font-weight-bold">
                    <span class="font-size-xs text-gray-350 text-decoration-line-through">$300,00</span>
                    <span class="text-primary">$230,00</span>
                  </div>

                </div>

              </div>

            </div>

            <div class="col-lg-3 col-md-6" style="min-width: 220px;">
              <div class="card mb-7">

                <!-- Badge -->
                <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                  -10%
                </div>

                <!-- Image -->
                <div class="card-img">

                  <!-- Image -->
                  <a class="card-img-hover" href="product.php">
                    <img class="card-img-top" src="assets/images/produto8.jpeg" alt="...">
                  </a>

                </div>

                <!-- Body -->
                <div class="card-body px-0">

                  <!-- Category -->
                  <div class="font-size-xs">
                    <a class="text-muted" href="search.php">Utilidades Domésticas</a>
                  </div>

                  <!-- Title -->
                  <div class="font-weight-bold">
                    <a class="text-body" href="product.php">
                      Conjunto chá completo azul
                    </a>
                  </div>

                  <!-- Price -->
                  <div class="font-weight-bold">
                    <span class="font-size-xs text-gray-350 text-decoration-line-through">$300,00</span>
                    <span class="text-primary">$230,00</span>
                  </div>

                </div>

              </div>

            </div>

            <div class="col-lg-3 col-md-6" style="min-width: 220px;">
              <div class="card mb-7">

                <!-- Badge -->
                <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                  -10%
                </div>

                <!-- Image -->
                <div class="card-img">

                  <!-- Image -->
                  <a class="card-img-hover" href="product.php">
                    <img class="card-img-top" src="assets/images/produto8.jpeg" alt="...">
                  </a>

                </div>

                <!-- Body -->
                <div class="card-body px-0">

                  <!-- Category -->
                  <div class="font-size-xs">
                    <a class="text-muted" href="search.php">Utilidades Domésticas</a>
                  </div>

                  <!-- Title -->
                  <div class="font-weight-bold">
                    <a class="text-body" href="product.php">
                      Conjunto chá completo azul
                    </a>
                  </div>

                  <!-- Price -->
                  <div class="font-weight-bold">
                    <span class="font-size-xs text-gray-350 text-decoration-line-through">$300,00</span>
                    <span class="text-primary">$230,00</span>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-lg-3 col-md-6" style="min-width: 220px;">
              <div class="card mb-7">

                <!-- Badge -->
                <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                  -10%
                </div>

                <!-- Image -->
                <div class="card-img">

                  <!-- Image -->
                  <a class="card-img-hover" href="product.php">
                    <img class="card-img-top" src="assets/images/produto8.jpeg" alt="...">
                  </a>

                </div>

                <!-- Body -->
                <div class="card-body px-0">

                  <!-- Category -->
                  <div class="font-size-xs">
                    <a class="text-muted" href="search.php">Utilidades Domésticas</a>
                  </div>

                  <!-- Title -->
                  <div class="font-weight-bold">
                    <a class="text-body" href="product.php">
                      Conjunto chá completo azul
                    </a>
                  </div>

                  <!-- Price -->
                  <div class="font-weight-bold">
                    <span class="font-size-xs text-gray-350 text-decoration-line-through">$300,00</span>
                    <span class="text-primary">$230,00</span>
                  </div>

                </div>

              </div>

            </div>

            <div class="col-lg-3 col-md-6" style="min-width: 220px;">
              <div class="card mb-7">

                <!-- Badge -->
                <div class="badge badge-danger card-badge card-badge-left text-uppercase">
                  -10%
                </div>

                <!-- Image -->
                <div class="card-img">

                  <!-- Image -->
                  <a class="card-img-hover" href="product.php">
                    <img class="card-img-top" src="assets/images/produto8.jpeg" alt="...">
                  </a>

                </div>

                <!-- Body -->
                <div class="card-body px-0">

                  <!-- Category -->
                  <div class="font-size-xs">
                    <a class="text-muted" href="search.php">Utilidades Domésticas</a>
                  </div>

                  <!-- Title -->
                  <div class="font-weight-bold">
                    <a class="text-body" href="product.php">
                      Conjunto chá completo azul
                    </a>
                  </div>

                  <!-- Price -->
                  <div class="font-weight-bold">
                    <span class="font-size-xs text-gray-350 text-decoration-line-through">$300,00</span>
                    <span class="text-primary">$230,00</span>
                  </div>

                </div>

              </div>

            </div>


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

  <!-- Whatsapp 
  <div class="whatsapp">
    <a href="https://wa.me/5586994459897" target="_blank" class="text-white"><i class="fab fa-whatsapp"></i></a>
  </div>
  -->
  <div class="contact-btn">
    <!-- Button trigger modal -->
    <button type="button" class="whatsapp btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fab fa-whatsapp"></i>
    </button>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dúvidas ou mais informações? Nós entramos em contato com você!</h5>
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fab fa-close"></i></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="row">
              <div class="form-group col-lg-6 col-6">
                <label class="modal-label" for="NomeSobrenome">Nome</label>
                <input type="text" name="nome" class="form-control shadow-none" id="nome" placeholder="Digite seu nome" required>
              </div>
              <div class="form-group col-lg-6 col-6">
                <label class="modal-label" for="Whats">Whats-App</label>
                <input size="20" maxlength="14" type="tel" class="form-control shadow-none" name="whats" placeholder="Whats-App" required>
              </div>
            </div>
            <div class="form-group">
              <label class="modal-label" for="Email">Email</label>
              <input type="text" class="form-control shadow-none" name="email" id="email" placeholder="E-mail" required />
            </div>
            <div class="form-group">
              <label class="modal-label" for="Assunto">Assunto</label>
              <select name="opc" id="opc" class="form-control shadow-none">
                <option value='casas'>Casas</option>
                <option value='financeiro'>Financeiro</option>
                <option value='consultoria'>Consultoria</option>
                <option value='feed'>FeedBack</option>
              </select>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
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
            <h4 class="mb-6 text-white text-center"><img width="200px" src="./assets/images/logo3.png"></h4>
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
              <li>
                <a class="text-gray-300" href="admin/login.php"><i class="fas fa-sign-out-alt"></i> Login</a>
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
  <script src="./assets/js/custom.js"></script>

  <script>
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

</php>