<?php
include "assets/include/function.php";

if( isset($_POST["location"])){
    $rooms = room_data($_POST["location"]);
}
?>
<label>Salle</label>

<select class="form-control" name="room_select" onchange="book_print_date()">
    <?php
    if($rooms[0] == null){
        echo '<option value="room_default" selected="selected">Il n\'y a pas de salle</option>';
    }
    else{
        echo '<option value="room_default" selected="selected">Sélectionnez une salle</option>';
    }

    foreach($rooms as $room){
        echo '<option value='.$room["id_room"].'>'.$room["type_room"].' - Places : '.$room["number_places"].'</option>';
    }
    ?>
</select>
