<?php include "assets/include/header.php";

    // PRINT DATAS
    $db = connectDb();

    $query = $db->prepare("SELECT begin_schedule, end_schedule FROM SCHEDULE WHERE day=:day AND id_location=:id_location ");

    $query->execute([   "day" => $_GET["day"],
                        "id_location" => $_GET["id_location"]
                    ]);

    $result = $query->fetch();



    // UPDATE DATAS
    if( isset($_POST) && !empty($_POST) ){

        $query = $db->prepare("UPDATE SCHEDULE SET begin_schedule=:begin_schedule, end_schedule=:end_schedule WHERE day=:day AND id_location=:id_location");

        $query->execute([   "begin_schedule" => $_POST["begin"],
                            "end_schedule" => $_POST["end"],
                            "day" => $_GET["day"],
                            "id_location" => $_GET["id_location"]
                        ]);

        header('Location:admin_schedules.php');

        unset($_POST);
    }
?>

<section>
    <center><h2>Administration - Modification d'équipement</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <?php echo '<form method="POST" action="admin_schedules_edit.php?id_location='.$_GET["id_location"].'&day='.$_GET["day"].'">'; ?>
                            <center>
                                <div class="form-group">
                                    <?php
                                        switch($_GET["id_location"]){
                                            case 1: echo '<label>Bastille</label>';
                                                    break;
                                            case 2: echo '<label>Beaubourg</label>';
                                                    break;
                                            case 3: echo '<label>Odéon</label>';
                                                    break;
                                            case 4: echo "<label>Place d'Italie</label>";
                                                    break;
                                            case 5: echo '<label>République</label>';
                                                    break;
                                            case 6: echo '<label>Ternes</label>';
                                                    break;
                                            default:
                                                    break;
                                        }
                                    ?>
                                </div>
                                <div class="form-group">
                                        <label>Début :</label>
                                        <?php
                                            echo '<input type="time" class="form-control" name="begin" value="'.$result[0].'" required="required">';
                                        ?>
                                        <label>Fin :</label>
                                        <?php
                                            echo '<input type="time" class="form-control" name="end" value="'.$result[1].'" required="required">';
                                        ?>
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
