<?php
session_start();
include "../include/function.php";

$toDayDate = date('Y-m-d');
$db = connectDb();
$query = $db->prepare("SELECT * FROM BOOKING INNER JOIN ROOM ON BOOKING.id_room=ROOM.id_room INNER JOIN LOCATION ON ROOM.id_location=LOCATION.id_location WHERE id_customer=:id_customer AND DATEDIFF(date_booking, '$toDayDate')>=0 ORDER BY date_booking ASC");
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
