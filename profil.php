<?php
$pageDescription = "Page profil de Work'n Share.";
$pageTitle = "Work'n Share - Profil utilisateur";
include 'assets/include/head.php';
if (!isset($_SESSION["account"]["token"])) {
  header('Location: account.php');
  exit();
}
if (isset($_POST['edit-account'])) {
  editCustomer();
}
if (isset($_GET["delete_id_room"])) {
  deleteBooking($_SESSION["account"]["id_customer"], $_GET["delete_id_room"]);
  header("Location: profil.php");
}
if (isset($_GET["subscription"])) {
    subscription_update($_SESSION["account"]["pseudo"], $_GET["subscription"]);
    header("Location: profil.php");
}

/* CHECK SUBSCRIPTION - NOTIFICATION */
$delay_notification = 14;
subscription_check($_SESSION["account"]["id_customer"], $delay_notification);

$subscription = subscription_view($_SESSION["account"]["pseudo"]);
$begin = strtotime($subscription["begin_subscription"]);
$begin = date("d-m-Y", $begin);
$end = strtotime($subscription["end_subscription"]);
$end = date("d-m-Y", $end);
?>
  <body>
    <?php include 'assets/include/header.php'; ?>
    <section>
      <div class="container container-main-content">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center border-bottom border-bottom-header">Bienvenue sur votre espace personnel</h1>
          </div>
        </div>

        <div class="row" style="margin-top:50px;">
          <div class="col-md-12">
            <ul class="nav nav-tabs" id="profilTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link profil-tab-link active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true"><i class="fas fa-user"></i> Mon compte</a>
              </li>
              <li class="nav-item">
                <a class="nav-link profil-tab-link" id="subscription-tab" data-toggle="tab" href="#subscription" role="tab" aria-controls="subscription" aria-selected="false"><i class="far fa-credit-card"></i> Mon abonnement</a>
              </li>
              <li class="nav-item">
                <a class="nav-link profil-tab-link" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="false"><i class="fas fa-bookmark"></i> Mes réservations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link profil-tab-link" id="bill-tab" data-toggle="tab" href="#bill" role="tab" aria-controls="bill" aria-selected="false"><i class="fas fa-money-bill-alt"></i> Mes factures</a>
              </li>
              <li class="nav-item">
                <a class="nav-link profil-tab-link" id="support-tab" data-toggle="tab" href="#support" role="tab" aria-controls="support" aria-selected="false"><i class="fas fa-wrench"></i> Mon support</a>
              </li>
            </ul>
            <div class="tab-content" id="profilTabContent" style="background-color:white; padding: 40px 30px;">
              <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card-deck">
                      <div class="card card-profile text-center border border-info border-profile">
                        <h5 class="card-header card-header-profile">Aperçu de votre compte</h5>
                        <div class="card-body card-body-profile">
                          <table class="table table-borderless">
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
                                <td>
                                  <?php
                                  if($subscription["id_subscription"] == 1) {
                                    echo "Gratuit";
                                  } elseif($subscription["id_subscription"] == 2) {
                                    echo "Simple";
                                  } elseif($subscription["id_subscription"] == 3) {
                                    echo "Résident";
                                  }
                                  ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <a class="btn btn-warning btn-block btn-orange" href="logout.php" style="color:white;">
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
                              <button class="btn btn-warning btn-block btn-orange" id="btn-edit" type="submit" name="edit-account" style="color:white;"><i class="far fa-edit"></i> Mettre à jour</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top:50px;">
                  <div class="col-md-6 offset-md-3">
                    <div class="card card-profile border border-info border-profile">
                      <h5 class="card-header card-header-profile text-center">Votre carte bancaire</h5>
                      <div class="card-body card-body-profile">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <div class="form-group">
                            <label for="card-number">Numéro de la carte</label>
                            <input class="form-control" id="card-number" type="text" name="card-number" placeholder="Saisir le numéro de la carte">
                          </div>
                          <div class="form-group">
                            <label for="card-expiration-date">Date d'expiration</label>
                            <input class="form-control" id="card-expiration-date" type="text" name="card-expiration-date" placeholder="Saisir la date d'expiration">
                          </div>
                          <div class="text-center mt-2">
                            <button class="btn btn-warning btn-block btn-orange" id="btn-account-credit-card" type="submit" name="account-credit-card" style="color:white;"><i class="fas fa-save"></i> Sauvegarder</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="subscription-tab">
                <div class="row" id="your-subscription">
                  <div class="col-md-6 offset-md-3">
                    <div class="card card-profile text-center border border-info border-profile">
                      <h5 class="card-header card-header-profile">Gestion de votre abonnement</h5>
                      <div class="card-body card-body-profile">
                        <?php
                        if($subscription["id_subscription"] == 1) {
                          $typeAbonnement = "Gratuit";
                          $finAbonnement = "Durée illimité";
                          $changerAbonnement = "<p>Choix d'évolution de l'abonnement</p>
                          <a class='btn btn-dark btn-cyan' href='profil.php?subscription=2'>Abonnement Simple</a>
                          <a class='btn btn-dark btn-teal' href='profil.php?subscription=3'>Abonnement Résident</a>";
                        } elseif($subscription["id_subscription"] == 2) {
                          $typeAbonnement = "Simple";
                          $changerAbonnement = "<p>Choix d'évolution de l'abonnement</p>
                          <a class='btn btn-dark btn-cyan' href='profil.php?subscription=1'>Abonnement Gratuit</a>
                          <a class='btn btn-dark btn-teal' href='profil.php?subscription=3'>Abonnement Résident</a>";
                        } elseif($subscription["id_subscription"] == 3) {
                          $typeAbonnement = "Résident";
                          $changerAbonnement = "<p>Choix d'évolution de l'abonnement</p>
                          <a class='btn btn-dark btn-cyan' href='profil.php?subscription=1'>Abonnement Gratuit</a>
                          <a class='btn btn-dark btn-teal' href='profil.php?subscription=2'>Abonnement Simple</a>";
                        }
                        ?>
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th>Type</th>
                              <th>Début</th>
                              <th>Fin</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo $typeAbonnement ?></td>
                              <td><?php echo $begin ?></td>
                              <td><?php
                              if($subscription["id_subscription"] == 1) {
                                echo $finAbonnement;
                              }
                              else {
                                echo $end ?></td>
                                <?php
                              }
                              ?>
                            </tr>
                          </tbody>
                        </table>
                        <p>
                          <?php echo $changerAbonnement ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="card card-profile text-center border border-info border-profile">
                      <h5 class="card-header card-header-profile">Gestion de vos réservations</h5>
                      <div class="card-body card-body-profile">
                      <?php
                      $db = connectDb();

                      $query = $db->prepare("SELECT *, ROOM.type_room, ROOM.id_location, LOCATION.id_location, LOCATION.town FROM BOOKING INNER JOIN ROOM ON BOOKING.id_room=ROOM.id_room INNER JOIN LOCATION ON ROOM.id_location=LOCATION.id_location WHERE id_customer=:id_customer");
                      $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
                      $query->execute();
                      $result = $query->fetchAll();

                      if (empty($result)) {
                        ?>
                        <p>
                          Vous n'avez aucune réservation.
                        </p>
                        <?php
                      }
                      elseif (!empty($result)) {
                        $i = 0;
                        foreach ($result as $row => $booking) {
                          $i++;
                        }
                        if ($i > 1) { ?>
                          <p>
                            Vous avez <?php echo $i ?> réservations.
                          </p>
                        <?php }
                        else { ?>
                          <p>
                            Vous avez <?php echo $i ?> réservation.
                          </p>
                        <?php } ?>

                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Site</th>
                              <th>Type</th>
                              <th>Numéro</th>
                              <th>Début</th>
                              <th>Fin</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $i = 0;
                          $s = 0;
                          foreach ($result as $row => $booking) {
                            $salle[] = $booking['type_room'];
                            $site[] = $booking['town'];
                            ?>
                            <tr>
                              <td><?php echo $booking['date_booking']; ?></td>
                              <td><?php echo $site[$s]; $s++; ?></td>
                              <td><?php echo $salle[$i]; $i++; ?></td>
                              <td><?php echo $booking['id_room']; ?></td>
                              <td><?php echo $booking['begin_booking']; ?></td>
                              <td><?php echo $booking['end_booking']; ?></td>
                              <td>
                                <a class="btn btn-danger btn-sm" href='profil.php?delete_id_room=<?php echo $booking['id_room']; ?>'>
                                  <i class="far fa-trash-alt"></i>
                                </a>
                              </td>
                            <tr>
                            <?php
                          }
                      }
                            ?>
                          </tbody>
                        </table>
                        <p>
                          <div>
                            <a class="btn btn-dark btn-block btn-cyan" href="book.php">
                              <i class="fas fa-bookmark"></i> Faire une réservation
                            </a>
                          </div>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab">
                <ul class="nav nav-tabs" id="billTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="historical-tab" data-toggle="tab" href="#historical" role="tab" aria-controls="historical" aria-selected="true">Historique</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="balance-sheet-tab" data-toggle="tab" href="#balance-sheet" role="tab" aria-controls="balance-sheet" aria-selected="false">Bilan financier</a>
                  </li>
                </ul>
                <div class="tab-content" id="billTabContent">
                  <div class="tab-pane fade show active" id="historical" role="tabpanel" aria-labelledby="historical-tab">
                    ...
                  </div>
                  <div class="tab-pane fade" id="balance-sheet" role="tabpanel" aria-labelledby="balance-sheet-tab">
                    ...
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="support" role="tabpanel" aria-labelledby="support-tab">
                <p>Le code doit être mis ici.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include 'assets/include/footer.php'; ?>
  </body>
</html>
