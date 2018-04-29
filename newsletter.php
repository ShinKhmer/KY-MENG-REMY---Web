<?php
$pageDescription = "Newsletter de Work'n Share.";
$pageTitle = "Work'n Share - Newsletter";
include 'assets/include/head.php';
?>
  <body>
    <?php include 'assets/include/header.php'; ?>
    <section>
      <div class="container container-main-content">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center border-bottom border-bottom-header">Newsletter de Work'n Share</h1>
            <p class="text-center" style="margin-top:30px;">
              Work'n Share propose une lettre d'information pour tenir informé ses clients des nouveautés au sein de l'entreprise.
            </p>
          </div>
        </div>
        <div class="row newsletter border w-75 mx-auto rounded" style="margin-top:50px;">
          <div class="col-md-4">
            <form id="sign-newsletter" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Nom / Prénom</label>
                <input class="form-control" id="name" type="text" name="name" placeholder="Entrer votre nom / prénom" required="required">
              </div>
              <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input class="form-control" id="email" type="email" name="email" aria-describedby="emailHelp" placeholder="Entrer votre email" required="required">
              </div>
          </div>
          <div class="col-md-8">
            <h5>Rester informé de l'actualité de Work'n Share</h5>
            <p>
              Vos données ne seront pas transférées à des tiers autres que Work'n Share. Nous détestons le spam et respectons vos données qui ne seront utilisées que pour l'envoi de lettres d'information.
            </p>
            <button class="btn btn-info btn-block" id="btn-newsletter" type="submit" name="sign-newsletter">Je m'inscris à la newsletter</button>
          </div>
            </form>
        </div>
        <div class="row" style="margin-top:50px;">
          <div class="col-md-12">
            <p class="text-muted small text-justify">
              Conformément aux dispositions de la loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, les données collectées via ce formulaire sont uniquement destinées à Work'n Share. Les données ne seront utilisées qu’à des fins d’envois de lettres d’information. Elles ne seront en aucun cas utilisées à d’autres fins et / ou transférées à des tiers. Work'n Share apporte une grande importance en matière de protection des données à caractère personnel. Vous pouvez à tout moment nous contacter afin d’exercer les droits dont vous disposez en vertu de la loi suscitée, à savoir un droit d’accès, de rectification et de suppression de vos données à caractère personnel.
            </p>
          </div>
        </div>
      </div>
    </section>
    <?php
    include 'assets/include/footer.php';
    ?>
  </body>
