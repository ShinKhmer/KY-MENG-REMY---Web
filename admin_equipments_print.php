<?php
require 'assets/include/function.php';
$db = connectDb();

$query = $db->prepare("SELECT * FROM EQUIPMENT");

$query->execute();

$result = $query->fetchAll();

function name_town($id,$db){
    $query = $db->prepare("SELECT * FROM LOCATION WHERE id_location=:plop");
    $query->execute(["plop" => $id]);
    $result2 = $query->fetch(PDO::FETCH_ASSOC);
    return $result2['town'];
}

/** UPDATE DATAS **/
if( isset($_GET) && !empty($_GET) ){

    $query = $db->prepare("UPDATE EQUIPMENT SET name_equipment=:name_equipment, quantity=:quantity WHERE id_equipment=:id_equipment AND id_location=:id_location");

    $query->execute([   "name_equipment" => $_GET["name"],
                        "quantity" => $_GET["quantity"],
                        "id_equipment" => $_GET["id"],
                        "id_location" => $_GET["location"]
                    ]);
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
                            <th>Quantité</th>
                        </tr>
                        <?php
                            $i = 0;
                            foreach($result as $res){
                                    $db = connectDb();
                                    $name =name_town($res[3],$db);
                                echo '  <tr>
                                            <td><center>'.$name.'</center></td>
                                            <td><center>'.$res[1].'</center></td>
                                            <td><center>'.$res[2].'</center></td>';

                                            /* POP UP EN FONCTION DE LA LIGNE RECUPEREE */
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
                                                                    <input type="text" class="form-control" name="equipment_name">
                                                            </div>
                                                            <div class="form-group">
                                                                    <label>Quantité</label>
                                                                    <input type="text" class="form-control" name="equipment_quantity">
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" data-dismiss="modal" onclick="equipment_edit('.$res[0].', '.$res[3].')" class="btn btn-primary">Save changes</button>
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

                    <a class="btn btn-secondary" href="admin_equipments_add.php" role="button" style="margin-left:45%">Ajouter</a>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
