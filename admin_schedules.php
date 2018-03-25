<?php include "assets/include/header.php";
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM SCHEDULE ORDER BY id_location ASC");

    $query->execute();

    $result = $query->fetchAll();
?>

<section>
    <center><h2>Administration - Inventaire</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:20%; padding-right:20%;">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Lieu</th>
                                <th>Jour</th>
                                <th>Heure d'ouverture</th>
                                <th>Heure de fermeture</th>
                            </tr>
                            <?php
                                foreach($result as $res){
                                    switch($res[4]){
                                        case 1: $place = "Bastille";
                                                break;
                                        case 2: $place = "Beaubourg";
                                                break;
                                        case 3: $place = "Odéon";
                                                break;
                                        case 4: $place = "Place d'Italie";
                                                break;
                                        case 5: $place = "République";
                                                break;
                                        case 6: $place = "Ternes";
                                                break;
                                        default:
                                                break;
                                    }
                                    echo '  <tr>
                                                <td><center>'.$place.'</center></td>
                                                <td><center>'.$res[1].'</center></td>
                                                <td><center>'.$res[2].'</center></td>
                                                <td><center>'.$res[3].'</center></td>
                                                <td><a class="btn btn-primary" href="admin_schedules_edit.php?id_location='.$res[4].'&day='.$res[1].'" role="button">Modifier</a></td>
                                            </tr>';
                                }
                             ?>
                        </table>
                        <a class="btn btn-primary" href="admin_schedules_add.php">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
