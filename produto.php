<?php
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
require_once './admin/dbconfig.php';
include './admin/lead-insert.php';
$url = explode("/", $_SERVER['REQUEST_URI']);
(is_numeric($url[4])) ? $idProduto = $url[4] : $idProduto = 1;

$stmt = $DB_con->prepare("SELECT nome,category,descricao FROM produtos where id='$idProduto' ORDER BY id DESC");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  extract($row);
  $produto = $nome;
  $category2 = $category;
  $desc = $descricao;
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
  <title><?php echo $produto ?> - Distribuidora Dominus</title>
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
              <a class="text-gray-400" href="<?php echo $URI->base('/home') ?>">Página inicial <i class="fas fa-angle-right"></i></a>
            </li>
            <li class="breadcrumb-item">
              <a class="text-gray-400" href="<?php echo $URI->base('/busca.php?pesquisa=' . $category2 . ''); ?>"><?php echo $category2; ?> <i class="fas fa-angle-right"></i></a>
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

  $stmt = $DB_con->prepare("SELECT id, nome, descricao,category,price, img,img2,img3,img4,img5,img6,status,desconto,valor_desconto,altura,largura,profu,peso,cor1,cor2,cor3,cor4,cor5 FROM produtos where nome='$produto'");
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
                    <?php if ($desconto != '') { ?>
                      <div class="badge badge-danger card-badge text-uppercase">
                        -40%
                      </div>
                    <?php } ?>
                    <!-- Slider -->
                    <div class="mb-4" data-flickity='{"draggable": false, "fade": true, "wrapAround": true}' id="productSlider">
                      <!-- Item -->
                      <?php if ($img != '') { ?>
                        <a class="w-100">
                          <img src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img'] . '') ?>" alt="..." class="img-fluid">
                        </a>
                      <?php } ?>
                      <!-- Item -->
                      <?php if ($img2 != '') { ?>
                        <a class="w-100">
                          <img src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img2'] . '') ?>" alt="..." class="img-fluid">
                        </a>
                      <?php } ?>
                      <!-- Item -->
                      <?php if ($img3 != '') { ?>
                        <a class="w-100">
                          <img src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img3'] . '') ?>" alt="..." class="img-fluid">
                        </a>
                      <?php } ?>
                      <!-- Item -->
                      <?php if ($img4 != '') { ?>
                        <a class="w-100">
                          <img src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img4'] . '') ?>" alt="..." class="img-fluid">
                        </a>
                      <?php } ?>
                      <!-- Item -->
                      <?php if ($img5 != '') { ?>
                        <a class="w-100">
                          <img src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img5'] . '') ?>" alt="..." class="img-fluid">
                        </a>
                      <?php } ?>
                      <!-- Item -->
                      <?php if ($img6 != '') { ?>
                        <a class="w-100">
                          <img src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img6'] . '') ?>" alt="..." class="img-fluid">
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                  <!-- Slider -->
                  <div class="flickity-nav mx-n2 mb-10 mb-md-0" data-flickity='{"asNavFor": "#productSlider", "contain": true, "wrapAround": false}'>
                    <!-- Item -->
                    <?php if ($img != '') { ?>
                      <div class="col-12 px-2" style="max-width: 113px;">
                        <!-- Image -->
                        <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/' . $row['img'] . '') ?>);background-size:contain;background-repeat: no-repeat;"></div>
                      </div>
                    <?php } ?>
                    <!-- Item -->
                    <?php if ($img2 != '') { ?>
                      <div class="col-12 px-2" style="max-width: 113px;">
                        <!-- Image -->
                        <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/' . $row['img2'] . '') ?>);background-size:contain;background-repeat: no-repeat;"></div>
                      </div>
                    <?php } ?>
                    <!-- Item -->
                    <?php if ($img3 != '') { ?>
                      <div class="col-12 px-2" style="max-width: 113px;">
                        <!-- Image -->
                        <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/' . $row['img3'] . '') ?>);background-size:contain;background-repeat: no-repeat;"></div>
                      </div>
                    <?php } ?>
                    <!-- Item -->
                    <?php if ($img4 != '') { ?>
                      <div class="col-12 px-2" style="max-width: 113px;">
                        <!-- Image -->
                        <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/' . $row['img4'] . '') ?>);background-size:contain;background-repeat: no-repeat;"></div>
                      </div>
                    <?php } ?>
                    <!-- Item -->
                    <?php if ($img5 != '') { ?>
                      <div class="col-12 px-2" style="max-width: 113px;">
                        <!-- Image -->
                        <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/' . $row['img5'] . '') ?>);background-size:contain;background-repeat: no-repeat;"></div>
                      </div>
                    <?php } ?>
                    <!-- Item -->
                    <?php if ($img6 != '') { ?>
                      <div class="col-12 px-2" style="max-width: 113px;">
                        <!-- Image -->
                        <div class="embed-responsive embed-responsive-1by1 bg-cover" style="background-image: url(<?php echo $URI->base('/admin/uploads/produtos/' . $row['img6'] . '') ?>);background-size:contain;background-repeat: no-repeat;"></div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-12 col-md-6 pl-lg-10">
                  <!-- Header -->
                  <div class="row mb-1">
                    <div class="col">
                      <!-- Preheading -->
                      <a class="text-muted"><?php echo $category ?></a>
                    </div>
                  </div>

                  <!-- Heading -->
                  <h3 class="mb-2"><?php echo $nome ?></h3>
                  <!-- Price -->
                  <?php if ($status == '2') { ?>
                    <div class="mb-7">
                      <span class="text-gray-350 text-decoration-line-through font-size-lg font-weight-bold">R$ <?php echo "R$ " . $price; ?></span>
                      <span class="text-primary font-size-h5 font-weight-bold"><?php echo "R$ " . $valor_desconto ?></span>
                    </div>
                  <?php } ?>
                  <?php if ($status == '1') { ?>
                    <div class="mb-7">
                      <span class="text-primary font-size-h5 font-weight-bold"><?php echo "R$ " . $price ?></span>
                    </div>
                  <?php } ?>

                  <div class="form-group">
                    <!-- Label -->
                    <h6>Descrição: </h6>
                    <p class="mb-5">
                      <?php echo $descricao ?>
                    </p>
                    <?php if (($cor1 != '') or ($cor2 != '') or ($cor3 != '') or ($cor4 != '')  or ($cor5 != '')) { ?>
                      <h6>Cores disponíveis: </h6>
                    <?php } ?>
                    <div class="d-flex">
                      <?php if ($cor1 != '') { ?>
                        <?php $stmt = $DB_con->prepare("SELECT id, cor,valor_cor FROM colors where cor='$cor1'");
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <div class="item-color" style="background-color: <?php echo $valor_cor; ?>"></div>
                      <?php
                          }
                        }
                      }
                      ?>
                      <?php if ($cor2 != '') { ?>
                        <?php $stmt = $DB_con->prepare("SELECT id, cor,valor_cor FROM colors where cor='$cor2'");
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <div class="item-color" style="background-color: <?php echo $valor_cor; ?>"></div>
                      <?php
                          }
                        }
                      }
                      ?>
                      <?php if ($cor3 != '') { ?>
                        <?php $stmt = $DB_con->prepare("SELECT id, cor,valor_cor FROM colors where cor='$cor3'");
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <div class="item-color" style="background-color: <?php echo $valor_cor; ?>"></div>
                      <?php
                          }
                        }
                      }
                      ?>
                      <?php if ($cor4 != '') { ?>
                        <?php $stmt = $DB_con->prepare("SELECT id, cor,valor_cor FROM colors where cor='$cor4'");
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <div class="item-color" style="background-color: <?php echo $valor_cor; ?>"></div>
                      <?php
                          }
                        }
                      }
                      ?>
                      <?php if ($cor5 != '') { ?>
                        <?php $stmt = $DB_con->prepare("SELECT id, cor,valor_cor FROM colors where cor='$cor5'");
                        $stmt->execute();
                        if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <div class="item-color" style="background-color: <?php echo $valor_cor; ?>"></div>
                      <?php
                          }
                        }
                      }
                      ?>
                    </div>
                    <hr>
                    <?php if (($altura != '') or ($largura != '') or ($profu != '') or ($peso != '')) { ?>
                      <p>Especificações: </p>
                    <?php } ?>
                    <div class="row" style="font-size:14px;">
                      <?php if ($altura != '') { ?>
                        <div class="col-md-6">
                          <p><span style="font-weight: bold;">Altura:</span> <?php echo $altura; ?></p>
                        </div>
                      <?php } ?>
                      <?php if ($largura != '') { ?>
                        <div class="col-md-6">
                          <p><span style="font-weight: bold;">Largura:</span> <?php echo $largura; ?></p>
                        </div>
                      <?php } ?>
                      <?php if ($profu != '') { ?>
                        <div class="col-md-6">
                          <p><span style="font-weight: bold;">Profundidade:</span> <?php echo $profu; ?></p>
                        </div>
                      <?php } ?>
                      <?php if ($peso != '') { ?>
                        <div class="col-md-6">
                          <p><span style="font-weight: bold;">Peso:</span> <?php echo $peso; ?></p>
                        </div>
                      <?php } ?>
                    </div>
                    <!-- Radio -->

                    <div class="form-row mb-7">
                      <div class="col-12 col-lg">
                        <?php

                        $stmt = $DB_con->prepare("SELECT id, texto1 FROM whats where id='1'");
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row);
                        ?>
                            <!-- Submit -->
                            <a class="btn btn-block btn-primary mb-2 text-white" target="_blank" href="https://api.whatsapp.com/send?phone=5586994459897&text=<?php echo $texto1; ?>%20<?php echo $nome ?>">
                              <i class="fab fa-whatsapp ml-2"></i> Solicitar
                            </a>
                        <?php }
                        }
                        ?>
                        <!-- Share -->
                        <p>
                          <a onclick="share()" class="btn btn-circle btn-light text-gray-350" href="#!">
                            Compartilhar <i class="ml-3 fas fa-share"></i>
                          </a>
                        </p>
                      </div>
                    </div>
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

  <!-- Produtos -->
  <section class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Heading -->
          <h4 class="mb-5 pl-8">
            <h4 class="mb-10 text-center">Você pode gostar também</h4>
          </h4>
          <!-- Slider -->
          <div class="flickity-buttons-lg flickity-buttons-offset px-lg-7 carousel" data-flickity='{"prevNextButtons": true}'>

            <!-- Item -->
            <?php
            $stmt = $DB_con->prepare("SELECT id,nome,price,category,img,desconto,valor_desconto FROM produtos ORDER BY id DESC");
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
                        <img class="card-img-top" src="<?php echo $URI->base('/admin/uploads/produtos/' . $row['img'] . '') ?>" alt="...">
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
                          <span class="text-primary"><?php echo "R$ " . $price ?></span>
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
  <script>
    function share() {
      if (navigator.share !== undefined) {
        navigator.share({
            title: 'Distribuidora Dominus - <?php echo $produto; ?>',
            text: '<?php echo $desc; ?>',
            url: '<?php echo $URI->base('produto/' . $id . '/' . slugify($nome)); ?>',
          })
          .then(() => console.log('Successful share'))
          .catch((error) => console.log('Error sharing', error));
      }
    }
  </script>
</body>

</html>