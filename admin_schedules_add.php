<?php
    include "assets/include/header.php";
    $error = false;

    if( isset($_POST) && !empty($_POST) ){
        $db = connectDb();

        // CHECK
        $query = $db->prepare("SELECT day FROM SCHEDULE WHERE id_location=:id_location");

        $query->execute([ "id_location" => $_POST["place_select"] ]);

        $result = $query->fetchAll();

        $cpt = 0;

        foreach($result as $res){
            if(strcmp($_POST["day_select"], $res[0]) == 0)
                $cpt++;
        }

        if($cpt == 0){
            // SEND
            $query = $db->prepare("INSERT INTO SCHEDULE(day, begin_schedule, end_schedule, id_location) VALUES(:day, :begin_schedule, :end_schedule, :id_location)");

            $query->execute([   "day" => $_POST["day_select"],
                                "begin_schedule" => $_POST["begin"],
                                "end_schedule" => $_POST["end"],
                                "id_location" => $_POST["place_select"]
                            ]);

            header('Location:admin_schedules.php');
        }else{
            $error = true;
        }
    }

?>

<script>$('#datetimepicker').datetimepicker();</script>

<section>
    <center><h2>Administration - Inventaire des équipements</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <form method="POST" action="admin_schedules_add.php">
                            <center>
                                <div class="form-group">
                                    <label>Lieu</label>
                                    <select class="form-control" name="place_select">
                                        <option value="1">Bastille</option>
                                        <option value="2">Beaubourg</option>
                                        <option value="3">Odéon</option>
                                        <option value="4">Place d'Italie</option>
                                        <option value="5">République</option>
                                        <option value="6">Ternes</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label>Jour :</label>
                                        <select class="form-control" name="day_select">
                                            <option value="Lundi">Lundi</option>
                                            <option value="Mardi">Mardi</option>
                                            <option value="Mercredi">Mercredi</option>
                                            <option value="Jeudi">Jeudi</option>
                                            <option value="Vendredi">Vendredi</option>
                                            <option value="Samedi">Samedi</option>
                                            <option value="Dimanche">Dimanche</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                        <label>Début :</label>
                                        <input type="time" class="form-control" name="begin" required="required">

                                        <label>Fin :</label>
                                        <input type="time" class="form-control" name="end" required="required">
                                </div>
                                <button type="submit" class="btn btn-primary">Valider</button>
                                <?php
                                    if($error == true){
                                        echo '<p class="bg-danger">Ce jour est déjà existant sur ce site !</p>';
                                        unset($error);
                                    }
                                ?>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
