<?php
    $pageDescription = "Page administrateur de Work'n Share - Ajouter un horaire.";
    $pageTitle = "Work'n Share - Ajout d'horaire";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }

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
            $query = $db->prepare("INSERT INTO SCHEDULE(id_schedule,day, begin_schedule, end_schedule, id_location) VALUES(null,:day, :begin_schedule, :end_schedule, :id_location)");
            $start = $_POST["debut_heure"].":".$_POST["debut_minute"].":00";
            $end = $_POST["fin_heure"].":".$_POST["fin_minute"].":00";
            $query->execute([   "day" => $_POST["day_select"],
                                "begin_schedule" => $start,
                                "end_schedule" => $end,
                                "id_location" => $_POST["place_select"]
                            ]);

            header('Location:admin_schedules.php');
        }else{
            $error = true;
        }
    }

?>

    <body>
        <?php include 'assets/include/header.php'; ?>
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
                                                <select name="debut_heure"  size="1">
                                                <?php
                                                    for ($i=0; $i <24 ; $i++) {
                                                        echo "<option>$i</option>";
                                                    }
                                                 ?>
                                             </select>
                                             <select name="debut_minute"  size="1">
                                                <?php
                                                    for ($i=0; $i <60 ; $i++) {
                                                        echo "<option>$i</option>";
                                                    }
                                                 ?>
                                             </select>



                                                <label>Fin :</label>
                                                <select name="fin_heure"  size="1">
                                                   <?php
                                                       for ($i=0; $i <24 ; $i++) {
                                                           echo "<option>$i</option>";
                                                       }
                                                    ?>
                                                </select>
                                                <select name="fin_minute"  size="1">
                                                   <?php
                                                       for ($i=0; $i <60 ; $i++) {
                                                           echo "<option>$i</option>";
                                                       }
                                                    ?>
                                                   </select>
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
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
