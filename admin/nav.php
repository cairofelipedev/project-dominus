<div class="sidebar" data-color="green">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="../index.php" class="simple-text logo-normal">
          <img class="img-fluid" src="../assets/images/logo3.png">
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="painel-controle.php">
              <i class="now-ui-icons design_app"></i>
              <p>Painel de Controle</p>
            </a>
          </li>
          <li>
            <a href="painel-leads.php">
              <i class="now-ui-icons files_single-copy-04"></i>
              <p>Leads</p>
            </a>
          </li>
          <li>
            <a href="painel-produtos.php">
              <i class="now-ui-icons shopping_cart-simple"></i>
              <p>Produtos</p>
            </a>
          </li>
          <li>
            <a href="painel-quemsomos.php?edit_id=1">
              <i class="now-ui-icons files_paper"></i>
              <p>Quem somos</p>
            </a>
          </li>
          <li>
            <a href="painel-blog.php">
              <i class="now-ui-icons media-1_album"></i>
              <p>Blog</p>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="now-ui-icons users_single-02"></i>
              <p>Úsuarios</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="painel-controle.php">Painel de Controle</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../index.php" target="_blank">
                  <i class="now-ui-icons media-1_button-play"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Estatisticas</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class=" d-md-block"><?php echo $_SESSION['name']; ?></span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item text-info" href="#">Editar Perfil</a>
                  <a class="dropdown-item text-danger" href="logout.php">Sair</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->