<?php
session_start();
include "../include/function.php";

$newSubscription = $_POST["data"];
$_SESSION["oldSubscription"] = "";
$db = connectDb();
$query = $db->prepare("SELECT COUNT(id_customer) FROM CREDIT_CARD WHERE id_customer=:id_customer");
$query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
$query->execute();
$count = $query->fetch();

if ($count[0] > 0) {
  subscription_update($newSubscription);
  if ($_SESSION["oldSubscription"] == 1) {
    ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      Vous avez déjà un abonnement en cours.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
  } else {
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      Votre abonnement a été mis à jour.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
  }
} else {
  ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color:red;">
    Vous devez renseigner un moyen de paiement sur votre compte afin de prendre un abonnement.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
}
if (isset($_SESSION["oldSubscription"])) {
  unset($_SESSION["oldSubscription"]);
}
?>
