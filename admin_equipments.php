<?php include "assets/include/header.php";
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM EQUIPMENT");

    $query->execute();

    $result = $query->fetchAll();
?>

<section>
    <center><h2>Administration - Inventaire</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Lieu</th>
                                <th>Equipement</th>
                                <th>Quantité</th>
                            </tr>
                            <?php
                                foreach($result as $res){
                                    echo '  <tr>
                                                <td>'.$res[3].'</td>
                                                <td>'.$res[1].'</td>
                                                <td>'.$res[2].'</td>
                                                <td><a class="btn btn-primary" href="admin_equipements_edit.php?id_equipment='.$res[0].'&id_location='.$res[3].'" role="button">Modifier</a></td>
                                            </tr>';
                                }
                             ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
