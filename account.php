<?php
$pageDescription = "Page compte de Work'n Share.";
$pageTitle = "Work'n Share - Compte";
include 'assets/include/head.php';
if (isset($_POST['sign-up'])) {
  registerCustomer();
}
if (isset($_POST['sign-in'])) {
  loginCustomer();
}
if(isset($_SESSION["account"]["token"])){
  header('Location: profil.php');
  exit();
}
?>
  <body>
    <?php include 'assets/include/header.php'; ?>
    <section>
      <div class="container container-main-content">
  			<div class="row">
          <div class="col-md-12">
            <h1 class="text-center border-bottom border-bottom-header">Votre compte Work'n Share</h1>
          </div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-6">
            <h2 class="text-center">Se connecter</h2>
            <form class="border border-sign border-info rounded" id="sign-in" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group">
                <label for="sign-in-pseudo">Pseudo</label>
                <input class="form-control" id="sign-in-pseudo" type="text" name="pseudo" placeholder="Pseudo" required="required">
              </div>
              <div class="form-group">
                <label for="sign-in-password">Mot de passe</label>
                <input class="form-control" id="sign-in-password" type="password" name="password" maxlength="20" placeholder="Mot de passe" required="required">
              </div>
              <div class="form-check text-center">
                <input class="form-check-input" id="sign-in-remember" type="checkbox" name="remember">
                <label class="form-check-label" for="sign-in-remember">Se souvenir</label>
              </div>
  						<div class="text-center">
  							<button class="btn btn-success" id="btn-sign-in" type="submit" name="sign-in"><i class="fas fa-check-circle"></i> Connexion</button>
  						</div>
              <span class="text-danger"><?php echo (isset($_SESSION["errors"]["login_error"]))?$_SESSION["errors"]["login_error"]:"";?></span>
  					</form>
          </div>

          <div class="col-md-6">
            <h2 class="text-center" id="header-spacing">S'inscrire</h2>
            <form class="border border-sign border-info rounded" id="sign-up" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  						<div class="form-row">
  					    <div class="form-group col-md-6">
  					      <label for="sign-up-name">Prénom<span class="text-warning"> *</span></label>
  					      <input class="form-control" id="sign-up-name" type="text" name="name" value="<?php echo (isset($_POST["name"]))?$_POST["name"]:"";?>" placeholder="Prénom" required="required">
                  <span class="text-danger"><?php echo (isset($_SESSION["errors"]["name_customer_error"]))?$_SESSION["errors"]["name_customer_error"]:"";?></span>
  					    </div>
  					    <div class="form-group col-md-6">
  					      <label for="sign-up-last-name">Nom<span class="text-warning"> *</label>
  					      <input class="form-control" id="sign-up-last-name" type="text" name="last-name" value="<?php echo (isset($_POST["last-name"]))?$_POST["last-name"]:"";?>" placeholder="Nom" required="required">
                  <span class="text-danger"><?php echo (isset($_SESSION["errors"]["last_name_customer_error"]))?$_SESSION["errors"]["last_name_customer_error"]:"";?></span>
  					    </div>
  					  </div>
  						<div class="form-row">
  					    <div class="form-group col-md-6">
  								<label for="sign-up-email">Email<span class="text-warning"> *</label>
  		            <input class="form-control" id="sign-up-email" type="email" name="email" value="<?php echo (isset($_POST["email"]))?$_POST["email"]:"";?>" placeholder="name@example.com" required="required">
                  <span class="text-danger"><?php echo (isset($_SESSION["errors"]["email_customer_error"]))?$_SESSION["errors"]["email_customer_error"]:"";?></span>
  					    </div>
  					    <div class="form-group col-md-6">
  					      <label for="sign-up-tel">Téléphone<span class="text-warning"> *</label>
  					      <input class="form-control" id="sign-up-tel" type="tel" name="tel" value="<?php echo (isset($_POST["tel"]))?$_POST["tel"]:"";?>" placeholder="Téléphone" required="required">
                  <span class="text-danger"><?php echo (isset($_SESSION["errors"]["phone_number_customer_error"]))?$_SESSION["errors"]["phone_number_customer_error"]:"";?></span>
  					    </div>
  					  </div>
  						<div class="form-row">
  					    <div class="form-group col-md-6">
  								<label for="sign-up-pseudo">Pseudo<span class="text-warning"> *</span></label>
  		            <input class="form-control" id="sign-up-pseudo" type="text" name="pseudo" value="<?php echo (isset($_POST["pseudo"]))?$_POST["pseudo"]:"";?>" placeholder="Pseudo" required="required">
                  <span class="text-danger"><?php echo (isset($_SESSION["errors"]["pseudo_customer_error"]))?$_SESSION["errors"]["pseudo_customer_error"]:"";?></span>
  					    </div>
  					    <div class="form-group col-md-6">
  								<label for="sign-up-password">Mot de passe<span class="text-warning"> *</span></label>
  		            <input class="form-control" id="sign-up-password" type="password" name="password" value="<?php echo (isset($_POST["password"]))?$_POST["password"]:"";?>" aria-describedby="passwordHelpBlock" maxlength="20" placeholder="Mot de passe" required="required">
                  <span class="text-danger"><?php echo (isset($_SESSION["errors"]["password_customer_error"]))?$_SESSION["errors"]["password_customer_error"]:"";?></span>
  					    </div>
              </div>
              <small class="form-text text-muted" id="passwordHelpBlock">
                Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
              </small>
  						<div class="text-center">
  							<button class="btn btn-secondary" id="btn-sign-up" type="submit" name="sign-up"><i class="fas fa-sign-in-alt"></i> Inscription</button>
  						</div>
  					</form>
  	       </div>
  			 </div>

  			 <div class="row" style="margin-top:50px;">
  				<div class="col-md-12">
  					<h3 class="text-center border-top border-bottom border-top-bottom-header">Pourquoi nous rejoindre ?</h3>
  				</div>
  			</div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-12">
            <div class="card-deck">
              <div class="card card-sign border border-join-us border-secondary">
                <h5 class="card-header card-header-sign text-center">Support technique de qualité 24/7</h5>
                <div class="card-body card-body-sign">
                  <p class="card-text">
                    Au cours des années, Work'n Share a su bâtir une excellente réputation en matière de service à la clientèle. En cas de problème, vous êtes assuré d’avoir une assistance personnalisée selon vos besoins.
                  </p>
                </div>
              </div>
              <div class="card card-sign border border-join-us border-secondary">
                <h5 class="card-header card-header-sign text-center">Infrastructure et architecture écoresponsable</h5>
                <div class="card-body card-body-sign">
                  <p class="card-text">
                    À savoir, nos centres de données et nos serveurs utilisent une énergie renouvelable consommant une faible quantité d'énergie électrique.
                    De plus, nous avons une politique de recyclage et de réduction de l'empreinte écologique dans nos bureaux.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12" id="why-join-us">
            <div class="card-deck">
              <div class="card card-sign border border-join-us border-secondary">
                <h5 class="card-header card-header-sign text-center">7 jours garantie ou argent remis</h5>
                <div class="card-body card-body-sign">
                  <p class="card-text">
                    Politique de satisfaction et de remboursement transparente. 7 jours satisfait ou remboursé.
                  </p>
                </div>
              </div>
              <div class="card card-sign border border-join-us border-secondary">
                <h5 class="card-header card-header-sign text-center">Protection Anti-Malware</h5>
                <div class="card-body card-body-sign">
                  <p class="card-text">
                    Détectez du code malicieux dans vos fichiers ou dans vos emails en quelques minutes seulement.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
  	   </div>
    </section>
  	<?php
    if (isset($_SESSION["errors"])) {
      unset($_SESSION["errors"]);
    }
    include 'assets/include/footer.php';
    ?>
  </body>
</html>
