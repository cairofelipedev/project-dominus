    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-xl navbar-dark sticky-top">
      <div class="container">
        <div class="row w-100 no-gutters">
          <div class="col d-lg-flex justify-content-between align-items-center">
            <a class="navbar-brand d-xl-none" href="<?php echo $URI->base('/home')?>">
              <img class="img-fluid" src="<?php echo $URI->base('/assets/images/logo3.png')?>" width="150" alt="logo">
            </a>
    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarClassicCollapse" aria-controls="navbarClassicCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
    
            <a class="navbar-brand d-none d-xl-block" href="<?php echo $URI->base('/home')?>">
              <img class="img-fluid" src="<?php echo $URI->base('/assets/images/logo3.png')?>" width="150" alt="logo">
            </a>

            <form class="search mt-3 mt-lg-0" action="busca.php">
              <input type="search"  name="pesquisa" id="pesquisa" placeholder="Pesquisar pelo seu produto" />
              <button class="btn" ><i class="fas fa-search"></i></button>
            </form>

            <ul class="navbar-nav d-none d-xl-flex">
              <li class="nav-item">
                <a href="<?php echo $URI->base('/produtos')?>" class="nav-link">Produtos</a>
              </li>
              <li class="nav-item">
                <li class="nav-item">
                  <a href="<?php echo $URI->base('/blog')?>" class="nav-link">Blog</a>
                </li>
              </li>
              <li class="nav-item">
                <li class="nav-item">
                  <a href="<?php echo $URI->base('/sobre')?>" class="nav-link">Sobre</a>
                </li>
              </li>
            </ul>

            
          </div>
        </div>

        <div class="row w-100 no-gutters py-2" id="category-bar">
          <div class="col">
            <div class="collapse navbar-collapse" id="navbarClassicCollapse">
              <ul class="navbar-nav w-100 justify-content-center">
                <!-- <li class="nav-item dropdown hidden-">
                  <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Todos</a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="search.html">Embalagens</a>
                    <a class="dropdown-item" href="search.html">Máquinas e Equipamentos</a>
                    <a class="dropdown-item" href="search.html">Saúde</a>
                    <a class="dropdown-item" href="search.html">Utilidades Domésticas</a>
                    <a class="dropdown-item" href="search.html">Jardinagem</a>
                </li> -->
                <li class="nav-item">
                  <a href="<?php echo $URI->base('/busca.php?pesquisa=embalagens')?>" class="nav-link">Embalagens</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $URI->base('/busca.php?pesquisa=maquinas-equipamentos')?>" class="nav-link">Máquinas e Equipamentos</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $URI->base('/busca.php?pesquisa=saude')?>" class="nav-link">Saúde</a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $URI->base('/busca.php?pesquisa=embalagens')?>" class="nav-link">Utilidades Domésticas</a>
                </li>
                <li class="nav-item ">
                  <a href="<?php echo $URI->base('/busca.php?pesquisa=jardinagem')?>" class="nav-link">Jardinagem</a>
                </li>
                <li class="d-xl-none">
                  <div class="dropdown-divider"></div>
                  <ul class="navbar-nav">  
                    <li class="nav-item">
                      <a href="<?php echo $URI->base('/produtos')?>" class="nav-link">Produtos</a>
                    </li>
                    <li class="nav-item">
                      <li class="nav-item">
                        <a href="<?php echo $URI->base('/blog')?>" class="nav-link">Blog</a>
                      </li>
                    </li>

                  </ul>
                  
                </li>
              </ul>
            </div>
          </div>
          
        </div>
        <!-- Collapse -->
      </div>
    </nav>
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
          <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="row">
              <div class="form-group col-lg-6 col-6">
                <label class="modal-label" for="NomeSobrenome">Nome</label>
                <input type="text" name="nome" class="form-control shadow-none" id="nome" placeholder="Digite seu nome" required>
              </div>
              <div class="form-group col-lg-6 col-6">
                <label class="modal-label" for="Whats">Whatsapp</label>
                <input size="20" maxlength="14" type="tel" class="form-control shadow-none phone" name="whats" placeholder="Número" required>
              </div>
            </div>
            <div class="form-group">
              <label class="modal-label" for="Email">Email</label>
              <input type="text" class="form-control shadow-none" name="email" id="email" placeholder="E-mail" required />
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