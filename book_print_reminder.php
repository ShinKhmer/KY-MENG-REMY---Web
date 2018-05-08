<?php
session_start();
require_once "assets/include/function.php";

if(isset($_POST)) {
    $schedule = schedule_data($_POST["location"], $_POST["date"]);
}

$customer_books = customer_booking_data($_SESSION["account"]["id_customer"], $_POST["date"]);

$now = time() + 2*60*60;        // Add +2 hours ! GMT+1 +summer hour

// NEED TO HAVE CORRECT STRTOTIME $schedule

if( $now < $schedule["end_schedule"] ){
    if (count($customer_books) > 0) {

        /* PRINT SINGULAR OR PLURAL WORD "réservation" */
        if (count($customer_books) > 1) {
            $reservation = "réservations";
        } else {
            $reservation = "réservation";
        }

        /* PRINT REMINDER */
        echo '<p>Attention ! Vous  avez ' . count($customer_books) . ' ' . $reservation . ' ce jour-ci !<br>';
        foreach ($customer_books as $book) {
            echo 'Début : ' . $book["begin_booking"] . ' - Fin : ' . $book["end_booking"].'<br>';
        }
        echo '</p>';
    }
}
