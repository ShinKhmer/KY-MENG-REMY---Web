<?php
    include "assets/include/header.php";
    
    if (isset($_POST['sign-up'])) {
        registerCustomer();
    }
?>

  <section>
    <div class="container container-main-content">
			<div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Votre compte Work'n Share</h1>
        </div>
      </div>

      <div class="row" style="margin-top:50px;">
        <div class="col-md-6">
          <h2 class="text-center">Se connecter</h2>
          <form id="sign-in" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <label for="sign-in-pseudo">Pseudo</label>
              <input class="form-control" id="sign-in-pseudo" type="text" name="pseudo" required="required" placeholder="Pseudo">
            </div>
            <div class="form-group">
              <label for="sign-in-password">Mot de passe</label>
              <input class="form-control" id="sign-in-password" type="password" name="password" required="required" placeholder="Mot de passe">
            </div>
            <div class="form-check text-center">
              <input class="form-check-input" id="sign-in-remember" type="checkbox" name="remember">
              <label class="form-check-label" for="sign-in-remember">Se souvenir</label>
            </div>
						<div class="text-center">
							<button class="btn btn-primary" id="btn-sign-in" type="submit" name="sign-in">Connexion</button>
						</div>
					</form>
        </div>

        <div class="col-md-6">
          <h2 class="text-center">S'inscrire</h2>
          <form id="sign-up" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="form-row">
					    <div class="form-group col-md-6">
					      <label for="sign-up-name">Prénom<span> * <?php echo $name_customer_Error;?></span></label>
					      <input class="form-control" id="sign-up-name" type="text" name="name" value="<?php echo $name_customer;?>" placeholder="Prénom" required="required">
					    </div>
					    <div class="form-group col-md-6">
					      <label for="sign-up-last-name">Nom<span> * <?php echo $last_name_customer_Error;?></span></label>
					      <input class="form-control" id="sign-up-last-name" type="text" name="last-name" value="<?php echo $last_name_customer;?>" placeholder="Nom" required="required">
					    </div>
					  </div>
						<div class="form-row">
					    <div class="form-group col-md-6">
								<label for="sign-up-email">Adresse email<span> * <?php echo $email_customer_Error;?></span></label>
		            <input class="form-control" id="sign-up-email" type="email" name="email" value="<?php echo $email_customer;?>" placeholder="name@example.com" required="required">
					    </div>
					    <div class="form-group col-md-6">
					      <label for="sign-up-tel">Téléphone<span> * <?php echo $phone_number_customer_Error;?></span></label>
					      <input class="form-control" id="sign-up-tel" type="tel" name="tel" value="<?php echo $phone_number_customer;?>" placeholder="Téléphone" required="required">
					    </div>
					  </div>
						<div class="form-row">
					    <div class="form-group col-md-6">
								<label for="sign-up-pseudo">Pseudo<span> * <?php echo $pseudo_customer_Error;?></span></label>
		            <input class="form-control" id="sign-up-pseudo" type="text" name="pseudo" value="<?php echo $pseudo_customer;?>" placeholder="Pseudo" required="required">
					    </div>
					    <div class="form-group col-md-6">
								<label for="sign-up-password">Mot de passe<span> * <?php echo $password_customer_Error;?></span></label>
		            <input class="form-control" id="sign-up-password" type="password" name="password" value="<?php echo $password_customer;?>" aria-describedby="passwordHelpBlock" placeholder="Mot de passe" required="required">
					    </div>
            </div>
            <small class="form-text text-muted" id="passwordHelpBlock">
              Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
            </small>
						<div class="text-center">
							<button class="btn btn-primary" id="btn-sign-up" type="submit" name="sign-up">Inscription</button>
						</div>
					</form>
	       </div>
			 </div>

			 <div class="row">
				<div class="col-md-12">
					<h3 class="text-center" style="margin-top:50px;">Pourquoi nous rejoindre ?</h3>
				</div>
			</div>
	   </div>
  </section>
	<?php include 'assets/include/footer.php'; ?>
</body>
</html>
