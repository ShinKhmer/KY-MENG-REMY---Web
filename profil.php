<?php
$pageDescription = "Page profil de Work'n Share.";
$pageTitle = "Work'n Share - Profil utilisateur";
include 'assets/include/head.php';
if(!isset($_SESSION["account"]["token"])){
  header('Location: index.php');
  exit();
}
if (isset($_POST['edit-account'])) {
  editCustomer();
}
if(isset($_GET["subscription"])){
    subscription_update($_SESSION["account"]["pseudo"], $_GET["subscription"]);
    header("Location: profil.php");
}
?>
  <body>
    <?php include 'assets/include/header.php'; ?>
    <section style="margin-top:50px;">
      <div class="container container-main-content">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center border-bottom border-bottom-header">Bienvenue sur votre espace personnel</h1>
          </div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-lg-12">
            <div class="card-deck">
              <div class="card card-profile text-center border border-info border-profile">
                <h5 class="card-header card-header-profile">Aperçu de votre compte</h5>
                <div class="card-body card-body-profile">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <td>Prénom</td>
                        <td><?php echo $_SESSION["account"]["name"];?></td>
                      </tr>
                      <tr>
                        <td>Nom</td>
                        <td><?php echo $_SESSION["account"]["last_name"];?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $_SESSION["account"]["email"];?></td>
                      </tr>
                      <tr>
                        <td>Téléphone</td>
                        <td><?php echo $_SESSION["account"]["tel"];?></td>
                      </tr>
                      <tr>
                        <td>Pseudo</td>
                        <td><?php echo $_SESSION["account"]["pseudo"];?></td>
                      </tr>
                      <tr>
                        <td>Abonnement</td>
                        <td>A définir</td>
                      </tr>
                    </tbody>
                  </table>
                  <a class="btn btn-primary" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                  </a>
                </div>
              </div>
              <div class="card card-profile border border-info border-profile">
                <h5 class="card-header card-header-profile text-center">Edition de votre compte</h5>
                <div class="card-body card-body-profile">
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                      <label for="edit-email">Email</label>
                      <input class="form-control" id="edit-email" type="email" name="email" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                      <label for="edit-tel">Téléphone</label>
                      <input class="form-control" id="edit-tel" type="tel" name="tel" placeholder="Téléphone">
                    </div>
                    <div class="form-group">
                      <label for="edit-password">Mot de passe</label>
                      <input class="form-control" id="edit-password" type="password" name="password" aria-describedby="passwordHelpBlock" placeholder="Mot de passe">
                    </div>
                    <small class="form-text text-muted" id="passwordHelpBlock">
                      Votre mot de passe doit comporter entre 8 et 20 caractères, contenir des lettres et des chiffres et ne doit pas contenir d'espaces, de caractères spéciaux ou d'emoji.
                    </small>
                    <div class="text-center mt-2">
                      <button class="btn btn-secondary" id="btn-edit" type="submit" name="edit-account"><i class="far fa-edit"></i> Mettre à jour</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-6 offset-md-3">
            <div class="card card-profile text-center border border-info border-profile">
              <h5 class="card-header card-header-profile">Gestion de votre abonnement</h5>
              <div class="card-body card-body-profile">
                <p>
                    <!-- UPDATE SUBSCRIPTION -->
                    <?php
                        $subscription = subscription_view($_SESSION["account"]["pseudo"]);
                        $begin = strtotime($subscription["begin_subscription"]);
                        $begin = date("d-m-Y", $begin);
                        $end = strtotime($subscription["end_subscription"]);
                        $end = date("d-m-Y", $end);

                        if($subscription["id_subscription"] == 1){
                            echo 'Vous avez l\'abonnement Gratuit.<br>';
                        }
                        else{
                            echo '<a href="profil.php?subscription=1">Choisir l\'abonnement Gratuit.</a><br>';
                        }

                        if($subscription["id_subscription"] == 2){
                            echo '  Vous avez l\'abonnement Simple.<br>
                                    Votre abonnement a commencé le '.$begin.'<br>
                                    Votre abonnement se termine le '.$end.'<br>
                            ';
                        }
                        else{
                            echo '<a href="profil.php?subscription=2">Choisir l\'abonnement Simple.</a><br>';
                        }

                        if($subscription["id_subscription"] == 3){
                            echo '  Vous avez l\'abonnement Résident.<br>
                                    Votre abonnement a commencé le '.$begin.'<br>
                                    Votre abonnement se termine le '.$end.'<br>
                            ';
                        }
                        else{
                            echo '<a href="profil.php?subscription=3">Choisir l\'abonnement Résident.</a><br>';
                        }

                    ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include 'assets/include/footer.php'; ?>
  </body>
</html>
