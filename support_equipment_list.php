<?php
    require "assets/include/function.php";

    if(isset($_GET["name"])){
        $equipments = support_search_equipment($_GET["name"]);
    }

?>

<label>Référence</label>
<select name="select_reference" required="required">
    <option value="">Sélectionner la référence</option>
    <?php
        foreach ($equipments as $equipment){
            echo '<option value="'.$equipment["id_equipment"].'">'.$equipment["reference"].'</option>';                                                                    # code...
        }
    ?>
</select>
