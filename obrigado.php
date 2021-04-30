<?php
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
  <div class="thanks text-center">
    <h1>OBRIGADO!</h1>
    <h3>Em instantes nossos especialistas entrarão em contato com você</h3>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="title-wrap">
          <div class="title-box">
            <h4 class="text-center">Enquanto isso conheça nossos produtos em destaque 👇</h4>
          </div>

        </div>
      </div>
    </div>
    <section class="py-4">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- Heading -->
            <h4 class="mb-5 pl-8">Destaques</h4>
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

  </div>
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

</html>