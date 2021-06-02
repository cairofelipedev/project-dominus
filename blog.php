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
    <meta content="Vestindo sua essência" name="description">
    <!-- Favicons -->
    <link rel="icon" href="./assets/images//favicon.ico">
    <!-- Libs CSS -->
    <link rel="stylesheet" href="./assets/libs/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./assets/libs/flickity.min.css">
    <link rel="stylesheet" href="./assets/libs/vs2015.css">
    <link rel="stylesheet" href="./assets/libs/simplebar.min.css">
    <link rel="stylesheet" href="./assets/libs/flickity-fade.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.css">
    <title>Dominus Distribuidora</title>
  </head>
  <body>

  <?php include "views/nav.php" ?> 
    <section class="pt-7 pb-12">
      <div class="container">
        <div class="row">
          <div class="col-12">
           
          </div>
        </div>
        <div class="row">
        <?php
            $stmt = $DB_con->prepare("SELECT id,titulo,categoria_1,img1,data_criacao FROM posts ORDER BY id DESC");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
            ?>
						<div class="col-12 col-md-4">

							<!-- Card -->
							<div class="card mb-7 mb-md-0">

								<!-- Image -->
								<img src="<?php echo $URI->base('/admin/uploads/blog/' . $row['img1'] . '') ?>" alt="..." class="card-img-top">

								<!-- Badge -->
								<div class="badge badge-white card-badge card-badge-left text-uppercase">
									<time>
									<?php
								$date = new DateTime($data_criacao);
								$date2 = $date->format('m');
								$date3 = $date->format('d');
								$date4 = $date->format('Y');
								echo $date3;
								if ($date2 == 01) {
									echo " Jan. ";
								}
								if ($date2 == 02) {
									echo " Fev. ";
								}
								if ($date2 == "03") {
									echo " Mar. ";
								}
								if ($date2 == 04) {
									echo " Abr. ";
								}
								if ($date2 == 05) {
									echo " Mai. ";
								}
								if ($date2 == 06) {
									echo " Jun. ";
								}
								if ($date2 == 07) {
									echo " Jul. ";
								}
								if ($date2 == "08") {
									echo " Ago. ";
								}
								if ($date2 == "09") {
									echo " Set. ";
								}
								if ($date2 == "10") {
									echo " Out. ";
								}
								if ($date2 == "11") {
									echo " Nov. ";
								}
								if ($date2 == "09") {
									echo " Dez. ";
								}
								echo $date4;
								?>
									</time>
								</div>

								<!-- Body -->
								<div class="card-body px-0 py-7">

									<!-- Heading -->
									<h6 class="mb-3">
									<?php echo $titulo ?>
									</h6>

									<!-- Text -->
									<p class="mb-2">
									<?php echo $sub_titulo ?>
									</p>

									<!-- Link -->
									<a class="btn btn-link px-0 text-body" href="<?php echo $URI->base('/blog-post/' . $id . '/' . slugify($titulo)); ?>">
										Leia Mais <i class="fa fa-arrow-right ml-2"></i>
									</a>

								</div>

							</div>
						</div>
						<?php }
						}
						?>
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