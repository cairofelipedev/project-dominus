<?php
require "classes/Helper.php";
require "classes/Url.class.php";
$URI = new URI();
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
      <div class="container">
        <!-- Slider -->
        <h2>Sobre nós</h2>
        <p>
          Localizada Teresina, Piauí, a Distribuidora Dominus é uma empresa especializada em equipamentos para agropecuária (kits de irrigação, itens para apicultura), embalagens, utensílios domésticos e decoração de casa.
        </p>
        
        <h5>Quem somos</h5>
        <p>
            Somos muito mais que uma distribuidora, somos a Dominus. Nascemos de um sonho para desenvolver e melhorar os negócios no Piauí e Brasil. Acreditamos que podemos fomentar o desenvolvimento da nossa economia gerando oportunidades de negócios para todos. 
        </p>
            
        <p>
          Com um profundo conhecimento logísticos de comércio internacional e nacional, com mais de 30 anos com atuação no segmento, desenvolvemos uma rede de parceiros e fornecedores localizados no Brasil, Ásia, em todos os continentes, para oferecer serviços e facilitar o acesso a produtos e equipamentos para inovação e geração de valor para nossos clientes.
        </p>

        <h5>Valores e Princípios</h5>
        <p>
          A Dominus é definida pelos seus valores: <br/>
          Integridade. Cooperação. Inovação. Excelência. Simplicidade. Vontade de resolver problemas. O ideal de fazer o bem ao mundo.
        </p>

        <p>
          Desde a nossa concepção, temos por objetivo atuar com empreendedores, donos de organizações e consumidores para facilitar o acesso a produtos e serviços logísticos, para o motor de desenvolvimento econômico e social, nas mãos do maior número possível de pessoas.
          Nossas portas estão e estarão abertas às pessoas com brilho nos olhos, vontade e coração aberto, independente de suas origens, posição social ou decisões pessoais.
        </p>

        <p>
          Nosso comprometimento é com uma cultura de qualidade, foco no cliente, que assume os riscos de melhorias contínuas e incentiva a criatividade, a liderança, e, principalmente, o espírito empreendedor. Encorajamos pessoas a tomarem iniciativa, agirem e fazerem a diferença.
          Não importa onde você esteja, você pode ser um parceiro e cliente da DOMINUS.
        </p>

        <p>  
          Esse é um convite ao empreendedorismo e co-criação.
        </p>

        <p>Com carinho,</p>

        <p><strong>Dominus Distribuidora</strong></p>
      </div>
    </section>

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

    <?php include "views/footer.php" ?>
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