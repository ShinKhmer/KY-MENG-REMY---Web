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

$begin_choose = date( 'H:i', (strtotime($_POST["begin"])+30*60) );

$end = strtotime($schedule["end_schedule"]);
$end = date('H:i', $end);

?>

<!-- CREATE SELECT IN TERMS OF A DAY -->
<label>Fin</label>
<select name="end_select" class="form-control">
    <?php
    for( $i = $begin_choose; $i <= $end; $i = date( 'H:i', (strtotime($i)+30*60) ) ){    // 30*60 => +30 minutes
        if(count($booked) > 0){
            $count = 0;
            foreach($booked as $book){
                if(check_book_available($i, $book["begin_booking"], $book["end_booking"], "end_check") == false){
                    $count++;
                }
            }
            /* IF IT IS AVAILABLE => PRINT */
            if($count == 0){
                echo '<option value="'.$i.'">'.$i.'</option>';
            }else{
                $end = $i;
            }
        }
        else{
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    ?>

</select>
