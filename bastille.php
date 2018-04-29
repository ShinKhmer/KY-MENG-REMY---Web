<?php
$pageDescription = "Openspace la Bastille de Work'n Share.";
$pageTitle = "Work'n Share - Bastille";
include 'assets/include/head.php';
?>
  <body>
    <?php include 'assets/include/header.php'; ?>
    <section>
      <div class="container container-main-content">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center border-bottom border-bottom-header">Présentation de notre openspace de la Bastille</h1>
          </div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-12">
            <h4 class="text-center">Caractéristique de notre site de la Bastille</h4>
          </div>
        </div>

        <div class="row text-center" style="margin-top:50px;">
          <div class="col-md-3">
						<img src="assets/image/illustration/reunion.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              2 salles de réunion réservables
						</p>
					</div>
          <div class="col-md-3">
						<img src="assets/image/illustration/appel.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              3 salles d'appel réservables
						</p>
					</div>
          <div class="col-md-3">
						<img src="assets/image/illustration/cosy.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              1 salon cosy
						</p>
					</div>
          <div class="col-md-3">
						<img src="assets/image/illustration/imprimante.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              1 imprimante
						</p>
					</div>
        </div>

        <div class="row text-center" style="margin-top:50px;">
          <div class="col-md-3">
						<img src="assets/image/illustration/plateau.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              Plateaux membres
						</p>
					</div>
          <div class="col-md-3">
						<img src="assets/image/illustration/boisson.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              Boissons à volonté
						</p>
					</div>
          <div class="col-md-3">
						<img src="assets/image/illustration/wifi.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              Wi-Fi très haut débit
						</p>
					</div>
          <div class="col-md-3">
						<img src="assets/image/illustration/horaire.svg" alt="Support Work'n Share" height="80">
						<p style="padding-top:20px;">
              Horaire d'ouverture<br>
              Lundi à jeudi : 9h-20h<br>
              Vendredi : 9h-20h<br>
              Samedi & Dimanche : 11h-20h
						</p>
					</div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-12">
            <h2 class="text-center border-top border-bottom border-top-bottom-header">Présentation de nos salles</h2>
          </div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-6">
            <p class="text-center my-5">
              Pour vous aider à visualiser nos différentes salles, nous mettons à votre disposition une présentation moderne et dynamique à travers une application WebGL.
            </p>
          </div>
          <div class="col-md-6 text-center">
            <div>
              <a class="btn btn-info btn-block btn-orange" href="meetingroom.php" target="_blank">Salle de réunion</a>
            </div>
            <div style="margin-top:10px;">
              <a class="btn btn-info btn-block btn-purple" href="workroom.php" target="_blank">Salle de travail</a>
            </div>
            <div style="margin-top:10px;">
              <a class="btn btn-info btn-block btn-cyan" href="cosyroom.php" target="_blank">Salon cosy</a>
            </div>
            <div style="margin-top:10px;">
              <a class="btn btn-info btn-block btn-teal" href="callroom.php" target="_blank">Salle d'appel</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
    include 'assets/include/footer.php';
    ?>
  </body>
