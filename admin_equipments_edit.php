<?php include "assets/include/header.php";

    // PRINT DATAS
    $db = connectDb();

    $query = $db->prepare("SELECT name_equipment, quantity FROM EQUIPMENT WHERE id_equipment=:id_equipment AND id_location=:id_location");

    $query->execute([   "id_equipment" => $_GET["id_equipment"],
                        "id_location" => $_GET["id_location"]
                    ]);

    $result = $query->fetch();



    // UPDATE DATAS
    if( isset($_POST) && !empty($_POST) ){

        $query = $db->prepare("UPDATE EQUIPMENT SET name_equipment=:name_equipment, quantity=:quantity WHERE id_equipment=:id_equipment AND id_location=:id_location");

        $query->execute([   "name_equipment" => $_POST["equipment_name"],
                            "quantity" => $_POST["equipment_quantity"],
                            "id_equipment" => $_GET["id_equipment"],
                            "id_location" => $_GET["id_location"]
                        ]);

        header('Location:admin_equipments.php');

        unset($_POST);
    }
?>

<section>
    <center><h2>Administration - Modification d'équipement</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card">
                        <?php echo '<form method="POST" action="admin_equipments_edit.php?id_equipment='.$_GET["id_equipment"].'&id_location='.$_GET["id_location"].'">'; ?>
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
                                    <center>
                                        <label>Lieu :</label>
                                        <?php echo '<input type="text" class="form-control" name="equipment_name" value="'.$result[0].'">'; ?>
                                    </center>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <label>Quantité :</label>
                                        <?php echo '<input type="text" class="form-control" name="equipment_quantity" value="'.$result[1].'">'; ?>
                                    </center>
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
