<?php
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

$begin = strtotime($schedule["begin_schedule"]);
$begin = date('H:i', $begin);

$end = strtotime($schedule["end_schedule"]);
$end = date('H:i', $end);

?>

<!-- CREATE SELECT IN TERMS OF A DAY -->
<label>Début</label>
<select name="begin_select" class="form-control" onchange="book_print_day_next( <?php echo $_POST["location"].','.$_POST["room"].',\''.$_POST["date"].'\''; ?> )">
    <?php
    for( $i = $begin; $i <= $end; $i = date( 'H:i', (strtotime($i)+30*60) ) ){    // 30*60 => +30 minutes
        if(count($booked) > 0){
            $count = 0;
            foreach($booked as $book){
                if(check_book_available($i, $book["begin_booking"], $book["end_booking"]) == false){
                    $count++;
                }
            }
            /* IF IT IS AVAILABLE => PRINT */
            if($count == 0){
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
        }
        else{
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    ?>

</select>

<script src="function.js"></script>
