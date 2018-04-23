<?php
require 'assets/include/function.php';
$db = connectDb();

$query = $db->prepare("SELECT * FROM EQUIPMENT WHERE deleted=0 ORDER BY id_location, name_equipment ASC ");

$query->execute();

$result = $query->fetchAll();

if( isset($_GET) && !empty($_GET) ){

    /* ADD DATA */
    if($_GET["add"] == true){
        add_equipment($_GET["name"], $_GET["reference"], $_GET["location"]);
    }

    /* UPDATE DATA */
    if($_GET["edit"] == true){
        edit_equipment($_GET["id"], $_GET["name"], $_GET["reference"], $_GET["location"]);
    }

    /* DELETE DATA */
    if($_GET["delete"] == true){
        delete_equipment($_GET["id"]);
    }
}

?>



<center><h2>Administration - Inventaire</h2></center>

<div class="container main-content">
    <div class="row" style="margin-top:50px; margin-bottom:50px;">
        <div class="col-md-12">
            <div class="card">
                <div class="offset-md-2 col-md-8">
                    <table class="table table-responsive table-hover">
                        <tr>
                            <th>Lieu</th>
                            <th>Equipement</th>
                            <th>Référence</th>
                        </tr>
                        <?php
                            $i = 0;
                            foreach($result as $res){
                                    $name = name_town($res["id_location"]);
                                echo '  <tr>
                                            <td><center>'.$name.'</center></td>
                                            <td><center>'.$res["name_equipment"].'</center></td>
                                            <td><center>'.$res["reference"].'</center></td>';

                                            /* EDIT A LINE */
                                echo '      <td><button class="btn btn-primary" data-toggle="modal" data-target="#equipment_pop_up_'.$i.'" style="margin-left: 50px;">Modifier</button></td>
                                        </tr>

                                        <div class="modal fade" id="equipment_pop_up_'.$i.'" tabindex="-1" role="dialog" aria-labelledby="Changement d\'équipement" aria-hidden="true">
                                            <script>console.log("ok");</script>
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Changer équipement</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="equipments_form" method="post" onsubmit="return false">
                                                            <div class="form-group">
                                                                    <label>Equipement</label>
                                                                    <input type="text" class="form-control" name="equipment_name" value="'.$res["name_equipment"].'">
                                                            </div>
                                                            <div class="form-group">
                                                                    <label>Référence</label>
                                                                    <input type="text" class="form-control" name="equipment_reference" value="'.$res["reference"].'">
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" data-dismiss="modal" onclick="admin_equipment_edit('.$res["id_equipment"].', '.$res["id_location"].', '.$i.')" class="btn btn-primary">Save changes</button>
                                                                <button class="btn btn-danger" data-dismiss="modal" onclick="admin_equipment_delete('.$res["id_equipment"].')">Supprimer</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    ';
                                    $i++;
                            }
                         ?>
                    </table>

                    <!-- ADD EQUIPMENT -->
                    <td><button class="btn btn-info" data-toggle="modal" data-target="#modal_add_equipment" style="margin-left: 50px;">Ajouter</button></td>

                    <div class="modal fade" id="modal_add_equipment" tabindex="-1" role="dialog" aria-labelledby="Ajouter un équipement" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Ajouter un équipement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="equipments_form_add" method="post" onsubmit="return false">
                                        <div class="form-group">
                                            <label>Lieu</label>
                                            <select class="form-control" name="equipment_location_add">
                                                <?php
                                                $locations = location_data();
                                                foreach($locations as $loc){
                                                    echo '<option value="'.$loc["id_location"].'">'.name_town($loc["id_location"]).'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Equipement</label>
                                            <input type="text" class="form-control" name="equipment_name_add">
                                        </div>
                                        <div class="form-group">
                                            <label>Référence</label>
                                            <input type="text" class="form-control" name="equipment_reference_add">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" data-dismiss="modal" onclick="admin_equipment_add()" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
