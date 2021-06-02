<?php
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
require_once './admin/dbconfig.php';
include './admin/lead-insert.php';
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
  <!-- SLIDER -->

  <!-- Categorias -->
  <section class="py-6">
    <?php
    $stmt = $DB_con->prepare('SELECT home,text_intro,texto1,texto2,texto3,texto4,texto5 FROM quem_somos');
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    ?>
        <div class="container">
          <!-- Slider -->
          <h2>Sobre nós</h2>
          <p>
          <?php echo $home ?>
          </p>

          <h5>Quem somos</h5>
          <p>
          <?php echo $text_intro ?>
          </p>

          <p>
          <?php echo $texto1 ?>
          </p>

          <h5>Valores e Princípios</h5>
          <p>
          <?php echo $texto2 ?>
          </p>

          <p>
          <?php echo $texto3 ?>
          </p>

          <p>
          <?php echo $texto4 ?>
          </p>

          <p><strong><?php echo $texto5 ?></strong></p>
        </div>
  </section>
<?php }
    } ?>

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
            <button type="submit" name="submit3" class="btn btn-primary mb-2">Cadastrar</button>
          </form>
        </div>

      </div>
    </div>

  </section>

<?php include "views/footer.php" ?>
<!-- JAVASCRIPT -->
<!-- Libs JS -->
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