<?php
session_start();
include "../include/function.php";

$billCounter = $_POST["counter"];
if ($billCounter == -1) {
  $db = connectDb();
  $query = $db->prepare("SELECT * FROM BILL INNER JOIN CUSTOMERS ON BILL.id_customer=CUSTOMERS.id_customer INNER JOIN SUBSCRIPTION ON BILL.id_subscription=SUBSCRIPTION.id_subscription WHERE CUSTOMERS.id_customer=:id_customer ORDER BY id_bill DESC");
  $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
  $query->execute();
  $result = $query->fetchAll();
}else {
  $db = connectDb();
  $query = $db->prepare("SELECT * FROM BILL INNER JOIN CUSTOMERS ON BILL.id_customer=CUSTOMERS.id_customer INNER JOIN SUBSCRIPTION ON BILL.id_subscription=SUBSCRIPTION.id_subscription WHERE CUSTOMERS.id_customer=:id_customer ORDER BY id_bill DESC LIMIT $billCounter");
  $query->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
  $query->execute();
  $result = $query->fetchAll();
}
$query2 = $db->prepare("SELECT COUNT(*) FROM BILL INNER JOIN CUSTOMERS ON BILL.id_customer=CUSTOMERS.id_customer WHERE CUSTOMERS.id_customer=:id_customer");
$query2->bindParam(':id_customer', $_SESSION["account"]["id_customer"]);
$query2->execute();
$billNumberCounter = $query2->fetch();

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
    if ($billCounter == -1) {
      $billCounter = $billNumberCounter[0];
      if ($billCounter > 1) {
        $bill = "factures";
      }else {
        $bill = "facture";
      }
    }
    ?>
    Affichage de <?php echo $billCounter." ".$bill; ?> sur un total de <?php echo $billNumberCounter[0]." ".$bill; ?>.
  </p>
<?php
}
?>
