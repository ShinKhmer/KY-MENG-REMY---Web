<?php
session_start();
include "../include/function.php";

$db = connectDb();
$subscription = subscription_view($_SESSION["account"]["pseudo"]);
$begin = strtotime($subscription["begin_subscription"]);
$begin = date("d/m/Y", $begin);
$end = strtotime($subscription["end_subscription"]);
$end = date("d/m/Y", $end);

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
