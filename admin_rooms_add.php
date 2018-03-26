<?php include "assets/include/header.php";
    $error = false;

    if( isset($_POST) && !empty($_POST) ){
        $db = connectDb();


        // SEND
        $query = $db->prepare("INSERT INTO ROOM(type_room, number_places, id_location) VALUES(:type_room, :number_places, :id_location)");

        $query->execute([   "type_room" => $_POST["room_select"],
                            "number_places" => $_POST["number_of_places"],
                            "id_location" => $_POST["place_select"]
                        ]);

        header('Location:admin_rooms.php');
    }else{
        $error = true;
    }
?>

<section>
    <center><h2>Administration - Inventaire des équipements</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <form method="POST" action="admin_rooms_add.php">
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
                                    <label>Type de salle :</label>
                                    <select class="form-control" name="room_select">
                                        <option value="Salle de réunion">Salle de réunion</option>
                                        <option value="Salle d'appel">Salle d'appel</option>
                                        <option value="Salon cosy">Salon cosy</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <label>Nombre de places :</label>
                                        <input type="text" class="form-control" name="number_of_places" placeholder="Nombre de places" required="required">
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
