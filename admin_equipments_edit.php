<?php
    $pageDescription = "Page administrateur de Work'n Share - Modifier un équipement.";
    $pageTitle = "Work'n Share - Administration - Modification d'équipement";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }

    // PRINT DATAS
    $db = connectDb();

    $query = $db->prepare("SELECT name_equipment, quantity FROM EQUIPMENT WHERE id_equipment=:id_equipment AND id_location=:id_location");

    $query->execute([   "id_equipment" => $_GET["id_equipment"],
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

        $query = $db->prepare("UPDATE EQUIPMENT SET name_equipment=:name_equipment, quantity=:quantity WHERE id_equipment=:id_equipment AND id_location=:id_location");

        $query->execute([   "name_equipment" => $_POST["equipment_name"],
                            "quantity" => $_POST["equipment_quantity"],
                            "id_equipment" => $_GET["id_equipment"],
                            "id_location" => $_GET["id_location"]
                        ]);

        header('Location:admin_equipments.php');

        unset($_POST);
    }
    if(isset($_GET["id_equipment"])   && isset($_GET["del"]) && $_GET["del"] == "true" ){

        $query = $db->prepare("DELETE FROM EQUIPMENT WHERE id_equipment=:id_equipment");

        $query->execute([
                            "id_equipment" => $_GET["id_equipment"]
                            ]);

        header('Location:admin_equipments.php');

        unset($_POST);
    }
?>

    <body>
        <?php include 'assets/include/header.php'; ?>

        <section>
            <center><h2>Administration - Modification d'équipement</h2></center>

            <div class="container main-content">
                <div class="row" style="margin-top:50px; margin-bottom:50px;">
                    <div class="col-md-12">
                        <div class="card-deck">
                            <div class="card" style="padding-left:30%; padding-right:30%;">
                                <?php echo '<form method="POST" action="admin_equipments_edit.php?id_equipment='.$_GET["id_equipment"].'&id_location='.$_GET["id_location"].'">'; ?>
                                    <center>
                                        <div class="form-group">
                                            <?php
                                                $db = connectDb();
                                                $name = name_town($_GET["id_location"],$db);
                                                echo "<label>".$name."</label>";
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <center>
                                                <label>Objet :</label>
                                                <?php echo '<input type="text" class="form-control" name="equipment_name" value="'.$result[0].'" required="required">'; ?>
                                            </center>
                                        </div>
                                        <div class="form-group">
                                            <center>
                                                <label>Quantité :</label>
                                                <?php echo '<input type="text" class="form-control" name="equipment_quantity" value="'.$result[1].'" required="required">'; ?>
                                            </center>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Valider</button>

                                        <?php echo '<a class="btn btn-danger" href="admin_equipments_edit.php?id_equipment='.$_GET["id_equipment"].'&id_location='.$_GET["id_location"].'&del=true">Supprimer</a>'; ?>

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
