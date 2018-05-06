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
$date_selected = strtotime($_POST["date"]);

$begin_choose = strtotime($_POST["begin"])+30*60;
$begin_choose_h = date('H', $begin_choose);
$begin_choose_m = date('i', $begin_choose);
var_dump($begin_choose);
$begin_choose = $date_selected + $begin_choose_h*60*60 + $begin_choose_m*60;

$end = strtotime($schedule["end_schedule"]);
$end = date('H', $end);
$end = $date_selected + $end*60*60;

?>

<!-- CREATE SELECT IN TERMS OF A DAY -->
<label>Fin</label>
<select name="end_select" class="form-control">
    <?php
    for( $i = $begin_choose; $i <= $end; $i += 30*60 ){    // 30*60 => +30 minutes
        $count = 0;
        /* CHECK IF THE LIST OF HOURS PROPOSED IS CORRECT  */
        if( ($_POST["date"] < date('Y-m-d', $now)) || ($_POST["date"] == date('Y-m-d', $now) && $now > $i) ){
            $count++;
        }
        if(count($booked) > 0){
            foreach($booked as $book){
                if(!check_book_available($i, $book["begin_booking"], $book["end_booking"], "end_check")){
                    $count++;
                }
            }
        }

        /* IF IT IS AVAILABLE => PRINT */
        if($count == 0){
            /* DIFFERENT DATE OR SAME DATE */
            echo '<option value="'.date('H:i', $i).'">'.date('H:i', $i).'</option>';
        }
        else{
            $end = $i;
        }
    }
    ?>

</select>
