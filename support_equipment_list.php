<?php
    require "assets/include/function.php";

    if(isset($_GET["name"])){
        $equipments = support_search_equipment($_GET["name"]);
    }

?>

<label>Référence :</label>
<select name="equipment_id">
    <?php
        foreach ($equipments as $equipment){
            echo '<option value="'.$equipment["id_equipment"].'">'.$equipment["reference"].'</option>';                                                                    # code...
        }
    ?>
</select>
