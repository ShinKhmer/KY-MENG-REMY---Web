<header>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #004365;">
    <div class="container">
      <a class="navbar-brand">
        <img src="assets/image/logo/brandLogo.png" alt="Logo Work'n Share" width="100" height="100">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-head" href="./">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-head" href="./#openspaces">Nos openspaces</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-head" href="./#offers">Nos offres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-head" href="./#contact">Nous contacter</a>
          </li>
          <?php if (isConnected()) { ?>
          <li class="nav-item">
            <a class="nav-link nav-link-head" href="book.php">Réserver</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-head" href="support.php">Support</a>
          </li>
          <?php }
          if(isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] == 1){
            echo '<li class="nav-item">
            <a class="nav-link nav-link-head" href="admin.php">Admin</a>
            </li>';
          }
          ?>
        </ul>
        <form class="form-inline">
          <?php if (isConnected()) { ?>
            <a href="profil.php" id="icon-my-account">
              <i class="fas fa-user-circle fa-3x align-middle"></i> Mon profil
            </a>
          <?php } else { ?>
            <a href="account.php" id="icon-my-account">
              <i class="fas fa-user-circle fa-3x align-middle"></i> Mon compte
            </a>
          <?php } ?>
        </form>
      </div>
    </div>
  </nav>
</header>
