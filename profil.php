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
if (isset($_POST['account-credit-card'])) {
  editCreditCard();
}
if (isset($_POST['account-delete-credit-card'])) {
  deleteCreditCard();
}
if (isset($_POST['delete-account'])) {
  deleteCustomer();
}

/* CHECK SUBSCRIPTION - NOTIFICATION */
$delay_notification = 3;    // days before ending subscription
subscription_check($_SESSION["account"]["id_customer"], $delay_notification);

$subscription = subscription_view($_SESSION["account"]["pseudo"]);
$begin = strtotime($subscription["begin_subscription"]);
$begin = date("d/m/Y", $begin);
$end = strtotime($subscription["end_subscription"]);
$end = date("d/m/Y", $end);
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
            </ul>
            <div class="tab-content" id="profilTabContent" style="background-color:white; padding: 40px 30px;">
              <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                <div class="row">
                  <div class="col-md-12">
                    <?php
                    if (isset($_SESSION["updated"])) {?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php
                        if (isset($_SESSION["updated"]["email"])) {
                          echo "Votre email a été modifié.<br>";
                        }
                        if (isset($_SESSION["updated"]["tel"])) {
                          echo "Votre numéro de téléphone a été modifié.<br>";
                        }
                        if (isset($_SESSION["updated"]["password"])) {
                          echo "Votre mot de passe a été modifié.";
                        }
                        if (isset($_SESSION["updated"]["noUpdate"])) {
                          echo "Vous n'avez rien modifié.";
                        }
                        ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    if (isset($_SESSION["wrongPassword"])) {?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Le mot de passe ne correspond pas.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    if (isset($_SESSION["creditCard"]["creditCardAdded"])) {?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Votre carte bancaire a été enregistré.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    if (isset($_SESSION["creditCard"]["creditCardDeleted"])) {?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Votre carte bancaire a été supprimé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    if (isset($_SESSION["creditCard"]["creditCardWrongNumberInput"])) {?>
                      <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Vous devez saisir entre 13 et 22 chiffre.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    if (isset($_SESSION["creditCard"]["creditCardWrongInput"])) {?>
                      <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Vous devez saisir des chiffres.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    if (isset($_SESSION["creditCard"]["creditCardNoInput"])) {?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Vous n'avez rien saisie.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    ?>
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
                                <td id="show-profil">
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
                              <span class="text-danger"><?php echo (isset($_SESSION["errors"]["email_customer_error"]))?$_SESSION["errors"]["email_customer_error"]:"";?></span>
                            </div>
                            <div class="form-group">
                              <label for="edit-tel">Téléphone</label>
                              <input class="form-control" id="edit-tel" type="tel" name="tel" placeholder="Téléphone">
                              <span class="text-danger"><?php echo (isset($_SESSION["errors"]["phone_number_customer_error"]))?$_SESSION["errors"]["phone_number_customer_error"]:"";?></span>
                            </div>
                            <div class="form-group">
                              <label for="edit-password">Mot de passe</label>
                              <input class="form-control" id="edit-password" type="password" name="password" aria-describedby="passwordHelpBlock" minlength="8" maxlength="20" placeholder="Mot de passe">
                              <span class="text-danger"><?php echo (isset($_SESSION["errors"]["password_customer_error"]))?$_SESSION["errors"]["password_customer_error"]:"";?></span>
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
                        <?php
                        $db = connectDb();
                        $query = $db->prepare("SELECT card_number FROM CREDIT_CARD WHERE id_customer=:id_customer");
                        $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
                        $query->execute();
                        $cardNumber = $query->fetch();

                        $cardNumberLastNumber = substr($cardNumber[0], -4);
                        $cardNumberSize = strlen($cardNumber[0]) - 4;
                        $cardNumberHideNumber = "";
                        for ($i=0; $i < $cardNumberSize; $i++) {
                          $cardNumberHideNumber = $cardNumberHideNumber."*";
                        }
                        $secretCardNumber = $cardNumberHideNumber.$cardNumberLastNumber;

                        $query = $db->prepare("SELECT card_security_code FROM CREDIT_CARD WHERE id_customer=:id_customer");
                        $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
                        $query->execute();
                        $cardNumberSecurityCode = $query->fetch();

                        $cardNumberSecurityCodeSize = strlen($cardNumberSecurityCode[0]);
                        $cardNumberSecurityCodeHideNumber = "";
                        for ($i=0; $i < $cardNumberSecurityCodeSize; $i++) {
                          $cardNumberSecurityCodeHideNumber = $cardNumberSecurityCodeHideNumber."*";
                        }
                        $secretCardNumberSecurityCode = $cardNumberSecurityCodeHideNumber;
                        ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <div class="form-group">
                            <label for="card-number">Numéro de la carte</label>
                            <input class="form-control" id="card-number" type="text" name="card-number" value="<?php echo $secretCardNumber; ?>" minlength="13" maxlength="22" placeholder="Saisir le numéro de la carte">
                          </div>
                          <div class="form-group">
                            <label for="card-security-code">Cryptogramme visuel</label>
                            <input class="form-control" id="card-security-code" type="text" name="card-security-code" value="<?php echo $secretCardNumberSecurityCode; ?>" minlength="3" maxlength="4" placeholder="Saisir votre cryptogramme visuel">
                          </div>
                          <div class="text-center">
                            <button class="btn btn-warning btn-block btn-orange" id="btn-account-credit-card" type="submit" name="account-credit-card" style="color:white;"><i class="fas fa-save"></i> Sauvegarder</button>
                          </div>
                          <?php
                          if ($cardNumber[0] > 0) {?>
                            <div class="text-center" style="margin-top:10px;">
                              <button class="btn btn-danger btn-block" id="btn-account-delete-credit-card" type="submit" name="account-delete-credit-card"><i class="far fa-trash-alt"></i> Supprimer votre carte</button>
                            </div>
                          <?php
                          }
                          ?>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top:50px;">
                  <div class="col-md-12 text-right">
                    <a class="text-danger btn" data-toggle="modal" data-target="#deleteAccount">
                      <i class="far fa-trash-alt"></i> Supprimer le compte
                    </a>
                    <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="deleteAccountTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountTitle">Supprimer le compte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p class="text-justify">
                              Êtes-vous certain de vouloir supprimer votre compte ? Ceci entrainera la perte de toutes vos données sur le site. Pour supprimer votre compte entrez votre mot de passe ci-dessous.
                            </p>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                              <div class="form-group">
                                <input class="form-control" id="your-password" type="password" name="password" maxlength="20" placeholder="Mot de passe" required="required">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-purple" data-dismiss="modal">Annuler</button>
                            <button type="submit" name="delete-account" class="btn btn-danger btn-orange"><i class="fas fa-heartbeat"></i> Confirmer</button>
                          </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="subscription" role="tabpanel" aria-labelledby="subscription-tab">
                <div class="row" id="your-subscription">
                  <div id="new-subscription-confirmed" class="col-md-12">
                    <!-- AJAX -->
                  </div>
                  <div class="col-md-6 offset-md-3">
                    <div class="card card-profile text-center border border-info border-profile">
                      <h5 class="card-header card-header-profile">Gestion de votre abonnement</h5>
                      <div class="card-body card-body-profile">
                        <?php
                        if($subscription["id_subscription"] == 1) {
                          $typeAbonnement = "Gratuit";
                          $finAbonnement = "Durée illimité";
                          $changerAbonnement = "<p>Choix d'évolution de l'abonnement avec engagement</p>
                          <p><a class='btn btn-dark btn-cyan' onclick='paySubscription(2)'>Abonnement Simple</a>
                          <a class='btn btn-dark btn-teal' onclick='paySubscription(3)'>Abonnement Résident</a></p>
                          <p>Choix d'évolution de l'abonnement sans engagement</p>
                          <p><a class='btn btn-dark btn-cyan' onclick='paySubscription(4)'>Abonnement Simple</a>
                          <a class='btn btn-dark btn-teal' onclick='paySubscription(5)'>Abonnement Résident</a></p>";
                        } elseif($subscription["id_subscription"] == 2) {
                          $typeAbonnement = "Simple";
                          $changerAbonnement = "<p>Choix d'évolution de l'abonnement avec engagement</p>
                          <p><a class='btn btn-dark btn-teal' onclick='paySubscription(3)'>Abonnement Résident</a></p>
                          <p>Choix d'évolution de l'abonnement sans engagement</p>
                          <p><a class='btn btn-dark btn-cyan' onclick='paySubscription(1)'>Abonnement Gratuit</a>
                          <a class='btn btn-dark btn-teal' onclick='paySubscription(5)'>Abonnement Résident</a></p>";
                        } elseif($subscription["id_subscription"] == 3) {
                          $typeAbonnement = "Résident";
                          $changerAbonnement = "<p>Choix d'évolution de l'abonnement avec engagement</p>
                          <p><a class='btn btn-dark btn-teal' onclick='paySubscription(2)'>Abonnement Simple</a></p>
                          <p>Choix d'évolution de l'abonnement sans engagement</p>
                          <p><a class='btn btn-dark btn-cyan' onclick='paySubscription(1)'>Abonnement Gratuit</a>
                          <a class='btn btn-dark btn-teal' onclick='paySubscription(4)'>Abonnement Simple</a></p>";
                        }
                        ?>
                        <div id="show-subscription">
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
                                <td><?php echo $typeAbonnement; ?></td>
                                <td><?php echo $begin; ?></td>
                                <td><?php
                                if($subscription["id_subscription"] == 1) {
                                  echo $finAbonnement;
                                }
                                else {
                                  echo $end; ?></td>
                                  <?php
                                }
                                ?>
                              </tr>
                            </tbody>
                          </table>
                          <?php echo $changerAbonnement; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                <ul class="nav nav-tabs" id="bookingTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link profil-book-link active" id="coming-booking-tab" data-toggle="tab" href="#coming-booking" role="tab" aria-controls="coming-booking" aria-selected="true">À venir</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link profil-book-link" id="past-booking-tab" data-toggle="tab" href="#past-booking" role="tab" aria-controls="past-booking" aria-selected="false">Antérieure</a>
                  </li>
                </ul>

                <div class="tab-content" id="bookingTabContent" style="padding: 40px 30px;">
                  <div class="tab-pane fade show active" id="coming-booking" role="tabpanel" aria-labelledby="coming-booking-tab">
                    <div class="row" style="margin-top:20px;">
                      <?php
                      $toDayDate = date('Y-m-d');
                      ?>
                      <div class="col-md-10 offset-md-1">
                        <div id="delete-booking-confirmed">
                          <!-- AJAX -->
                        </div>
                        <div class="card card-profile text-center border border-info border-profile">
                          <h5 class="card-header card-header-profile">Mes réservations à venir</h5>
                          <div class="card-body card-body-profile">
                          <?php
                          $query = $db->prepare("SELECT * FROM BOOKING INNER JOIN ROOM ON BOOKING.id_room=ROOM.id_room INNER JOIN LOCATION ON ROOM.id_location=LOCATION.id_location WHERE id_customer=:id_customer AND DATEDIFF(date_booking, '$toDayDate')>0 ORDER BY date_booking ASC");
                          $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
                          $query->execute();
                          $result = $query->fetchAll();
                          ?>
                          <div id="show-booking">
                            <?php
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
                                  Vous avez <?php echo $i; ?> réservations.
                                </p>
                              <?php }
                              else { ?>
                                <p>
                                  Vous avez <?php echo $i; ?> réservation.
                                </p>
                              <?php } ?>

                              <table class="table table-borderless">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Site</th>
                                    <th>Type</th>
                                    <th>Salle</th>
                                    <th>Début</th>
                                    <th>Fin</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($result as $row => $booking) {
                                  $booking['date_booking'] = strtotime($booking['date_booking']);
                                  $booking['date_booking'] = date("d/m/Y", $booking['date_booking']);
                                  ?>
                                  <tr>
                                    <td><?php echo $booking['date_booking']; ?></td>
                                    <td><?php echo $booking['town']; ?></td>
                                    <td><?php echo $booking['type_room']; ?></td>
                                    <td><?php echo $booking['id_room']; ?></td>
                                    <td><?php echo $booking['begin_booking']; ?></td>
                                    <td><?php echo $booking['end_booking']; ?></td>
                                    <td>
                                      <a class="btn btn-danger btn-sm" onclick="deleteBooking(<?php echo $booking['id_booking']; ?>)">
                                        <i class="far fa-trash-alt"></i>
                                      </a>
                                    </td>
                                  </tr>
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
                  </div>

                  <div class="tab-pane fade" id="past-booking" role="tabpanel" aria-labelledby="past-booking-tab">
                    <div class="row" style="margin-top:20px;">
                      <div class="col-md-10 offset-md-1">
                        <div class="card card-profile text-center border border-info border-profile">
                          <h5 class="card-header card-header-profile">Mes réservations antérieures</h5>
                          <div class="card-body card-body-profile">
                          <?php
                          $query = $db->prepare("SELECT * FROM BOOKING INNER JOIN ROOM ON BOOKING.id_room=ROOM.id_room INNER JOIN LOCATION ON ROOM.id_location=LOCATION.id_location WHERE id_customer=:id_customer AND DATEDIFF(date_booking, '$toDayDate')<=0 ORDER BY date_booking DESC");
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
                                Vous avez <?php echo $i; ?> réservations.
                              </p>
                            <?php }
                            else { ?>
                              <p>
                                Vous avez <?php echo $i; ?> réservation.
                              </p>
                            <?php } ?>

                            <table class="table table-borderless">
                              <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>Site</th>
                                  <th>Type</th>
                                  <th>Salle</th>
                                  <th>Début</th>
                                  <th>Fin</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php
                              foreach ($result as $row => $booking) {
                                $booking['date_booking'] = strtotime($booking['date_booking']);
                                $booking['date_booking'] = date("d/m/Y", $booking['date_booking']);
                                ?>
                                <tr>
                                  <td><?php echo $booking['date_booking']; ?></td>
                                  <td><?php echo $booking['town']; ?></td>
                                  <td><?php echo $booking['type_room']; ?></td>
                                  <td><?php echo $booking['id_room']; ?></td>
                                  <td><?php echo $booking['begin_booking']; ?></td>
                                  <td><?php echo $booking['end_booking']; ?></td>
                                </tr>
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

                </div>
              </div>



              <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab">
                <div class="row">
                  <div class="col-md-12">
                    <div id="payout-confirmed">
                      <!-- AJAX -->
                    </div>
                    <h5 class="text-center" style="background-color:#84b749; color:white; padding:7px 0px; border-radius:5px; margin-bottom:30px;">Historique de mes factures</h5>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                      <div class="form-group">
                        <label for="historical-count">Afficher</label>
                        <select id="historical-count" name="bill-number" onchange="showBill(this.value)">
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="40">40</option>
                          <option value="-1">Tous</option>
                        </select> factures
                      </div>
                    </form>
                    <?php
                    $billCounter = 10;
                    $query = $db->prepare("SELECT * FROM BILL INNER JOIN CUSTOMERS ON BILL.id_customer=CUSTOMERS.id_customer INNER JOIN SUBSCRIPTION ON BILL.id_subscription=SUBSCRIPTION.id_subscription WHERE CUSTOMERS.id_customer=:id_customer ORDER BY id_bill DESC LIMIT $billCounter");
                    $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
                    $query->execute();
                    $result = $query->fetchAll();

                    $query2 = $db->prepare("SELECT COUNT(*) FROM BILL INNER JOIN CUSTOMERS ON BILL.id_customer=CUSTOMERS.id_customer WHERE CUSTOMERS.id_customer=:id_customer");
                    $query2->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
                    $query2->execute();
                    $billNumberCounter = $query2->fetch();
                    ?>

                    <div id="show-bill">
                      <?php
                      if (empty($result)) {
                        ?>
                        <p class="text-center">
                          Vous n'avez aucune factures.
                        </p>
                        <?php
                      }
                      elseif (!empty($result)) {
                        ?>
                        <table class="table table-striped table-borderless table-bill text-center">
                          <thead>
                            <tr>
                              <th style="color:#84b749;">Facture #</th>
                              <th style="color:#84b749;">Date de facturation</th>
                              <th style="color:#84b749;">Date d'échéance</th>
                              <th style="color:#84b749;">Forfait</th>
                              <th style="color:#84b749;">Total</th>
                              <th style="color:#84b749;">État</th>
                              <th style="color:#84b749;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          foreach ($result as $row => $bill) {
                            if ($bill['state'] == 0) {
                              $payout = "<span style='color:#f6bd22;'> Non payée </span>";
                              $payBill = '<a style="color:white;" class="btn btn-info btn-sm" onclick="payBill('.$bill["id_bill"].')">
                                            <i class="fas fa-shopping-cart" style="color:#84b749;"></i> Payer
                                          </a>';
                            }
                            else {
                              $payout = "<span style='color:#84b749;'> Payée </span>";
                              $payBill = "<i class='fas fa-check'></i>";
                            }
                            $bill['billing_date'] = strtotime($bill['billing_date']);
                            $bill['billing_date'] = date("d/m/Y", $bill['billing_date']);
                            $bill['due_date'] = strtotime($bill['due_date']);
                            $bill['due_date'] = date("d/m/Y", $bill['due_date']);
                            ?>
                            <tr>
                              <td><?php echo $bill['id_bill']; ?></td>
                              <td><?php echo $bill['billing_date']; ?></td>
                              <td><?php echo $bill['due_date']; ?></td>
                              <td><?php echo $bill['type_subscription']; ?></td>
                              <td><?php echo $bill['price']." €"; ?></td>
                              <td><?php echo $payout; ?></td>
                              <td><?php echo $payBill; ?></td>
                            </tr>
                            <?php
                          }
                          ?>
                          </tbody>
                        </table>
                        <p>
                          <?php
                          if ($billCounter > $billNumberCounter[0]) {
                            $billCounter = $billNumberCounter[0];
                          }
                          if ($billCounter > 1) {
                            $bill = "factures";
                          }else {
                            $bill = "facture";
                          }
                          ?>
                          Affichage de <?php echo $billCounter." ".$bill; ?> sur un total de <?php echo $billNumberCounter[0]." ".$bill; ?>.
                        </p>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="assets/include/javascript.js"></script>
    <?php
    if (isset($_SESSION["errors"])) {
      unset($_SESSION["errors"]);
    }
    if (isset($_SESSION["updated"])) {
      unset($_SESSION["updated"]);
    }
    if (isset($_SESSION["wrongPassword"])) {
      unset($_SESSION["wrongPassword"]);
    }
    if (isset($_SESSION["creditCard"])) {
      unset($_SESSION["creditCard"]);
    }
    include 'assets/include/footer.php';
    ?>
  </body>
</html>
