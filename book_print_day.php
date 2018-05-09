<?php
session_start();
include "assets/include/function.php";

/* SEARCH OPEN HOURS */
if(isset($_POST)){
    $schedule = schedule_data($_POST["location"], $_POST["date"]);
    $booked = check_booked($_POST["room"], $_POST["date"]);
}else{
    header('Location: book.php');
}
?>

<!-- CONTENT IN THE DIV ID "print day" -->
<?php

/* KNOW THE BEGIN AND END HOUR OF A SPECIFIED DAY*/
$date_selected = strtotime($_POST["date"]);
$now = time() + 2*60*60;        // Add +2 hours ! GMT+1 +summer hour

$begin = correct_string_to_time($date_selected, $schedule["begin_schedule"]);
$end = correct_string_to_time($date_selected, $schedule["end_schedule"]);

/* CUSTOMER BOOKS */
$customer_books = customer_booking_data($_SESSION["account"]["id_customer"], $_POST["date"]);

?>

<!-- CREATE SELECT IN TERMS OF A DAY -->
<label>Heure de début</label>
<select name="begin_select" class="form-control" onchange="book_print_day_next( <?php echo $_POST["location"].','.$_POST["room"].',\''.$_POST["date"].'\','.count($customer_books); ?> )">
    <option value="begin_default">Sélectionner l'horaire</option>
    <?php
    for( $i = $begin; $i < $end; $i += 30*60 ){    // 30*60 => +30 minutes
        $count = 0;


        /* CHECK IF THE LIST OF HOURS PROPOSED IS CORRECT  */
        if( (strtotime($_POST["date"]) < strtotime(date('Y-m-d', $now))) || ($_POST["date"] == date('Y-m-d', $now) && $now > $i) ){
            $count++;
        }
        /* CHECK IF THERE IS A BOOK IN THE DAY */
        if(count($booked) > 0){
            foreach($booked as $book){
                $begin_booking = correct_string_to_time($date_selected, $book["begin_booking"]);
                $end_booking = correct_string_to_time($date_selected, $book["end_booking"]);

                if( check_book_available($i, $begin_booking, $end_booking, "begin_check") == false ){
                    $count++;
                }
            }
        }
        /* CHECK IF THE CUSTOMER HAS ALREADY A BOOK AT A CERTAIN HOUR */
        if(count($customer_books) > 0){
            foreach($customer_books as $c_book){
                $begin_booking = correct_string_to_time($date_selected, $c_book["begin_booking"]);
                $end_booking = correct_string_to_time($date_selected, $c_book["end_booking"]);

                if( check_book_available($i, $begin_booking, $end_booking, "begin_check") == false ){
                    $count++;
                }
            }
        }


        /* IF IT IS AVAILABLE => PRINT */
        if($count == 0){
            /* DIFFERENT DATE OR SAME DATE */
            echo '<option value="'.date('H:i', $i).'">'.date('H:i', $i).'</option>';
        }
    }
    ?>
</select>

<script src="function.js"></script>
