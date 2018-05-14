<?php
session_start();
include "../include/function.php";

$bookToDelete = $_POST["data"];
$db = connectDb();
$query = $db->prepare("DELETE FROM BOOKING WHERE id_customer=:id_customer AND id_booking=:id_booking");
$query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
$query->bindParam(':id_booking', $bookToDelete);
$query->execute();
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  Votre réservation a été supprimé.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
