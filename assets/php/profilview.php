<?php
session_start();
include "../include/function.php";

$subscription = subscription_view($_SESSION["account"]["pseudo"]);

if($subscription["id_subscription"] == 1) {
  echo "Gratuit";
} elseif($subscription["id_subscription"] == 2) {
  echo "Simple";
} elseif($subscription["id_subscription"] == 3) {
  echo "Résident";
}
?>
