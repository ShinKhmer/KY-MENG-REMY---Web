<?php include "assets/include/header.php";

    // PRINT DATAS
    $db = connectDb();

    $query = $db->prepare("SELECT begin_schedule, end_schedule FROM SCHEDULE WHERE day=:day AND id_location=:id_location ");

    $query->execute([   "day" => $_GET["day"],
                        "id_location" => $_GET["id_location"]
                    ]);

    $result = $query->fetch();

    function name_town($id,$db){
        $query = $db->prepare("SELECT * FROM LOCATION WHERE id_location=:plop");
        $query->execute(["plop" => $id]);
        $result2 = $query->fetch(PDO::FETCH_ASSOC);
        return $result2['town'];
    }


    // UPDATE DATAS
    if( isset($_POST) && !empty($_POST) ){

        $query = $db->prepare("UPDATE SCHEDULE SET begin_schedule=:begin_schedule, end_schedule=:end_schedule WHERE day=:day AND id_location=:id_location");
        $start = $_POST["debut_heure"].":".$_POST["debut_minute"].":00";
        $end = $_POST["fin_heure"].":".$_POST["fin_minute"].":00";
        $query->execute([   "day" => $_GET["day"],
                            "begin_schedule" => $start,
                            "end_schedule" => $end,
                            "id_location" => $_GET["id_location"]
                        ]);

        header('Location:admin_schedules.php');

        unset($_POST);
    }
?>

<section>
    <center><h2>Administration - Modification d'horaire</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <?php echo '<form method="POST" action="admin_schedules_edit.php?id_location='.$_GET["id_location"].'&day='.$_GET["day"].'">'; ?>
                            <center>
                                <div class="form-group">
                                    <?php
                                    $db = connectDb();
                                    $name =name_town($_GET["id_location"],$db);
                                    echo '<label>'.$name .' : '. $_GET["day"].'</label>';
                                    ?>
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
