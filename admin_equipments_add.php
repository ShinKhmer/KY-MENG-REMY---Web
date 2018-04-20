<?php

    $pageDescription = "Page administrateur de Work'n Share - Ajouter un équipement.";
    $pageTitle = "Work'n Share - Administration - Ajout d'équipement";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }

    $error = false;

    if( isset($_POST) && !empty($_POST) ){
        $db = connectDb();

        // CHECK
        $query = $db->prepare("SELECT name_equipment FROM EQUIPMENT WHERE id_location=:id_location");

        $query->execute([ "id_location" => $_POST["place_select"] ]);

        $result = $query->fetchAll();

        $cpt = 0;

        foreach($result as $res){
            if(strcmp($_POST["equipment_name"], $res[0]) == 0)
                $cpt++;
        }

        if($cpt == 0){
            // SEND
            $query = $db->prepare("INSERT INTO EQUIPMENT(name_equipment, quantity, id_location) VALUES(:name_equipment, :quantity, :id_location)");

            $query->execute([   "name_equipment" => $_POST["equipment_name"],
                                "reference" => $_POST["reference"],
                                "id_location" => $_POST["place_select"]
                            ]);

            header('Location:admin_equipments.php');
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
                                <form method="POST" action="admin_equipments_add.php">
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
                                                <label>Nom de l'équipement :</label>
                                                <input type="text" class="form-control" name="equipment_name" placeholder="Nom de l'équipement" required="required">
                                        </div>
                                        <div class="form-group">
                                            <center>
                                                <label>Référence :</label>
                                                <input type="text" class="form-control" name="reference" placeholder="Référence" required="required">
                                            </center>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Valider</button>
                                        <?php
                                            if($error == true){
                                                echo '<p class="bg-danger">Cet équipement est déjà existant sur ce site !</p>';
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
