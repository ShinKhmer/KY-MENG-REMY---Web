<?php include "assets/include/header.php";



    // UPDATE DATAS
    if( isset($_POST) && !empty($_POST) ){
        $db = connectDb();
        if ($_POST["debut_heure"]<$_POST["fin_heure"]) {
            $query = $db->prepare("UPDATE SCHEDULE SET begin_schedule=:begin_schedule, end_schedule=:end_schedule WHERE day=:day AND id_location=:id_location");
            $start = $_POST["debut_heure"].":".$_POST["debut_minute"].":00";
            $end = $_POST["fin_heure"].":".$_POST["fin_minute"].":00";
            $query->execute([
                                "begin_schedule" => $start,
                                "end_schedule" => $end,
                                "day" => $_POST["day_select"],
                                "id_location" => $_POST["place_select"]
                            ]);

            header('Location:admin_schedules.php');

            unset($_POST);

        }
    }
?>

<section>
    <center><h2>Administration - Modification d'horaire</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <?php echo '<form method="POST" action="admin_schedules_edit.php">'; ?>
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
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
