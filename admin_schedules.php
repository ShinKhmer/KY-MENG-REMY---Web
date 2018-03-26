<?php include "assets/include/header.php";
    $db = connectDb();

    $query = $db->prepare("SELECT day, TIME_FORMAT(begin_schedule, '%H:%i'), TIME_FORMAT(end_schedule, '%H:%i'), id_location FROM SCHEDULE ORDER BY id_location ASC");

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
    <center><h2>Administration - Horaires</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:10%; padding-right:10%;">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Lieu</th>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Dimanche</th>
                            </tr>
                            <?php
                                for($i = 0; $i < 6; $i++){
                                    $name = name_town($result[$i*7][3],$db);
                                    echo '  <tr>
                                                <td><center>'.$name.'</center></td>';
                                    for($j = 0; $j < 7; $j++){
                                        echo '  <td><center>'.$result[$i*7+$j][1].'<br>'.$result[$i*7+$j][2].'</center></td>';
                                    }
                                    //echo ' <td><a class="btn btn-primary" href="admin_schedules_edit.php?id_location='.$result[$i*$6].'&day='.$result[0].'" role="button">Modifier</a></td></tr>';
                                    echo '</tr>';
                                }

                             ?>
                        </table>
                        <a class="btn btn-primary" href="admin_schedules_edit.php">Modifier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
