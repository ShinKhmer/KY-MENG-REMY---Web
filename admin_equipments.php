<?php
include "assets/include/header.php";
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
?>

<section>
    <center><h2>Administration - Inventaire</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Lieu</th>
                                <th>Equipement</th>
                                <th>Quantité</th>
                            </tr>
                            <?php
                                foreach($result as $res){
                                        $db = connectDb();
                                        $name =name_town($res[3],$db);
                                    echo '  <tr>
                                                <td><center>'.$name.'</center></td>
                                                <td><center>'.$res[1].'</center></td>
                                                <td><center>'.$res[2].'</center></td>
                                                <td><a class="btn btn-primary" href="admin_equipments_edit.php?id_equipment='.$res[0].'&id_location='.$res[3].'" role="button">Modifier</a></td>
                                            </tr>';
                                }
                             ?>
                        </table>

                        <a class="btn btn-secondary" href="admin_equipments_add.php" role="button" style="margin-left:30%; margin-right:30%">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
