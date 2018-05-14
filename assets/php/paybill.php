<?php
session_start();
include "../include/function.php";

$billToPay = $_POST["data"];
$db = connectDb();
$query = $db->prepare("SELECT COUNT(id_customer) FROM CREDIT_CARD WHERE id_customer=:id_customer");
$query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
$query->execute();
$count = $query->fetch();

if ($count[0] > 0) {
  $query = $db->prepare("UPDATE BILL SET state = 1 WHERE id_customer=:id_customer AND id_bill=:id_bill");
  $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
  $query->bindParam(':id_bill', $billToPay);
  $query->execute();
  ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Votre facture a été payé.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
}else {
  ?>
  <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color:red;">
    Vous devez renseigner un moyen de paiement sur votre compte afin de régler une facture.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php
}
?>
