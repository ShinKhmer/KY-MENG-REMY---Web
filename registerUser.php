<!-- TEST INSCRIPTION EN MODAL  -->

<?php

    require "assets/include/function.php";

    if (isset($_POST['sign-up'])) {
        registerCustomer();
      }

     include "assets/include/header.php";  

?>


  <section>
    <div class="container">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Espace personnel
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="container">
              <div class="row">
                <div class="col-xl-12">
                  <div class="modal-header">
                    <h1 id="exampleModalLabel" style="margin: 0 auto;">Votre compte Work'n Share</h1>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-xl-6">
                    <h2 class="text-center">Se connecter</h2>
                    <form id="sign-in" method="POST" action="">
                      <div class="form-group">
                        <label for="sign-in-pseudo">Pseudo</label>
                        <input type="text" name="pseudo" class="form-control" id="sign-in-pseudo" placeholder="Pseudo" required="required">
                      </div>
                      <div class="form-group">
                        <label for="sign-in-password">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="sign-in-password" placeholder="Mot de passe" required="required">
                      </div>
                      <div class="form-check text-center">
                        <input type="checkbox" name="remember" class="form-check-input" id="sign-in-remember">
                        <label class="form-check-label" for="sign-in-remember">Se souvenir</label>
                      </div>
          						<div class="text-center">
          							<button type="submit" name="sign-in" class="btn btn-primary" id="btn-sign-in">Connexion</button>
          						</div>
          					</form>
                  </div>

                  <div class="col-xl-6">
                    <h2 class="text-center">S'inscrire</h2>
                    <form id="sign-up" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          						<div class="form-row">
          					    <div class="form-group col-xl-6">
          					      <label for="sign-up-name">Prénom<span> * <?php echo $name_customer_Error;?></span></label>
          					      <input type="text" name="name" class="form-control" id="sign-up-name" placeholder="Prénom" required="required" value="<?php echo $name_customer;?>">
          					    </div>
          					    <div class="form-group col-xl-6">
          					      <label for="sign-up-last-name">Nom<span> * <?php echo $last_name_customer_Error;?></span></label>
          					      <input type="text" name="last-name" class="form-control" id="sign-up-last-name" placeholder="Nom" required="required" value="<?php echo $last_name_customer;?>">
          					    </div>
          					  </div>
          						<div class="form-row">
          					    <div class="form-group col-xl-6">
          								<label for="sign-up-email">Adresse email<span> * <?php echo $email_customer_Error;?></span></label>
          		            <input type="email" name="email" class="form-control" id="sign-up-email" placeholder="name@example.com" required="required" value="<?php echo $email_customer;?>">
          					    </div>
          					    <div class="form-group col-xl-6">
          					      <label for="sign-up-tel">Téléphone<span> * <?php echo $phone_number_customer_Error;?></span></label>
          					      <input type="tel" name="tel" class="form-control" id="sign-up-tel" placeholder="Téléphone" required="required" value="<?php echo $phone_number_customer;?>">
          					    </div>
          					  </div>
          						<div class="form-row">
          					    <div class="form-group col-xl-6">
          								<label for="sign-up-pseudo">Pseudo<span> * <?php echo $pseudo_customer_Error;?></span></label>
          		            <input type="text" name="pseudo" class="form-control" id="sign-up-pseudo" placeholder="Pseudo" required="required" value="<?php echo $pseudo_customer;?>">
          					    </div>
          					    <div class="form-group col-xl-6">
          								<label for="sign-up-password">Mot de passe<span> * <?php echo $password_customer_Error;?></span></label>
          		            <input type="password" name="password" class="form-control" id="sign-up-password" placeholder="Mot de passe" required="required" value="<?php echo $password_customer;?>">
          					    </div>
          							<small id="password-help" class="form-text text-muted">
          								Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
          							</small>
          					  </div>
          						<div class="text-center">
          							<button type="submit" name="sign-up" class="btn btn-primary" id="btn-sign-up">Inscription</button>
          						</div>
          					</form>
          	       </div>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="margin: 0 auto;">
              <div class="row">
                <div class="col-xl-12">
                  <div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	   </div>
  </section>
	<?php include 'assets/include/footer.php'; ?>
</body>
</html>
