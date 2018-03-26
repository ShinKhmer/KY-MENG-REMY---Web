<?php include "assets/include/header.php";

    // PRINT DATAS
    $db = connectDb();

    $query = $db->prepare("SELECT type_room, number_places FROM ROOM WHERE id_room=:id_room AND id_location=:id_location");

    $query->execute([   "id_room" => $_GET["id_room"],
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

        $query = $db->prepare("UPDATE ROOM SET type_room=:type_room, number_places=:number_places WHERE id_room=:id_room AND id_location=:id_location");

        $query->execute([   "type_room" => $_POST["room_select"],
                            "number_places" => $_POST["number_of_places"],
                            "id_room" => $_GET["id_room"],
                            "id_location" => $_GET["id_location"]
                        ]);

        header('Location:admin_rooms.php');

        unset($_POST);
    }
    if(isset($_GET["id_room"]) && isset($_GET["del"]) && $_GET["del"] == "true" ){

        $query = $db->prepare("DELETE FROM ROOM WHERE id_room=:id_room");

        $query->execute([
                            "id_room" => $_GET["id_room"]
                            ]);

        header('Location:admin_rooms.php');

        unset($_POST);
    }
?>

<section>
    <center><h2>Administration - Modification de salle</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <?php echo '<form method="POST" action="admin_rooms_edit.php?id_room='.$_GET["id_room"].'&id_location='.$_GET["id_location"].'">'; ?>
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
                                        <label>Type de salle :</label>
                                        <select class="form-control" name="room_select">
                                            <option value="Salle de réunion">Salle de réunion</option>
                                            <option value="Salle d'appel">Salle d'appel</option>
                                            <option value="Salon cosy">Salon cosy</option>
                                        </select>
                                    </center>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <label>Nombre de places :</label>
                                        <?php echo '<input type="text" class="form-control" name="number_of_places" value="'.$result[1].'" required="required">'; ?>
                                    </center>
                                </div>
                                <button type="submit" class="btn btn-primary">Valider</button>

                                <?php echo '<a class="btn btn-danger" href="admin_rooms_edit.php?id_room='.$_GET["id_room"].'&id_location='.$_GET["id_location"].'&del=true">Supprimer</a>'; ?>

                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
