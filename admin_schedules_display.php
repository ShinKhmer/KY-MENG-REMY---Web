<?php

include 'assets/include/function.php';
$db = connectDb();

if(isset($_GET["place"])){
        if ($_GET["1"]<$_GET["3"]) {
            $query = $db->prepare("UPDATE SCHEDULE SET begin_schedule=:begin_schedule, end_schedule=:end_schedule WHERE day=:day AND id_location=:id_location");
            $start = $_GET["1"].":".$_GET["2"].":00";
            $end = $_GET["3"].":".$_GET["4"].":00";
            $query->execute([
                                "begin_schedule" => $start,
                                "end_schedule" => $end,
                                "day" => $_GET["day"],
                                "id_location" =>$_GET["place"]
                            ]);
        }
        echo "plfpzelfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff";
}
$query = $db->prepare("SELECT day, TIME_FORMAT(begin_schedule, '%H:%i'), TIME_FORMAT(end_schedule, '%H:%i'), id_location FROM SCHEDULE ORDER BY id_location ASC");
$query->execute();
$result = $query->fetchAll();


 ?>
<center><h2>Administration - Horaires</h2></center>

<div class="container main-content">
    <div class="row" style="margin-top:50px; margin-bottom:50px;">
        <div class="col-md-12">
            <div class="card-deck">
                <div class="card" >
                    <table class="col-md6 table table-responsive table-hover">
                        <tbody>
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
                                    $name = name_town($result[$i*7][3]);
                                    echo '  <tr>
                                                <td><center>'.$name.'</center></td>';
                                    for($j = 0; $j < 7; $j++){
                                        echo '  <td><center>'.$result[$i*7+$j][1].'<br>'.$result[$i*7+$j][2].'</center></td>';
                                    }
                                    //echo ' <td><a class="btn btn-primary" href="admin_schedules_edit.php?id_location='.$result[$i*$6].'&day='.$result[0].'" role="button">Modifier</a></td></tr>';
                                    echo '</tr>';
                                }

                             ?>
                        </tbody>
                    </table>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#myBtn">Modifier</button>
                </div>
                <div class="modal fade" id="myBtn" tabindex="-1" role="dialog" aria-labelledby="Changement d\'équipement" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Changer équipement</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

    <!-- Modal content -->
                                <form method="GET" onsubmit="return false;">
                                    <center>
                                    <div class="form-group">
                                        <label>Lieu</label>
                                        <select class="form-control" name="place_select" id="place_select">
                                            <option value="1">Bastille</option>
                                            <option value="2">Beaubourg</option>
                                            <option value="3">Odéon</option>
                                            <option value="4">Place d'Italie</option>
                                            <option value="5">République</option>
                                            <option value="6">Ternes</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jour :</label>
                                        <select class="form-control" name="day_select" id="day_select">
                                            <option value="Lundi">Lundi</option>
                                            <option value="Mardi">Mardi</option>
                                            <option value="Mercredi">Mercredi</option>
                                            <option value="Jeudi">Jeudi</option>
                                            <option value="Vendredi">Vendredi</option>
                                            <option value="Samedi">Samedi</option>
                                            <option value="Dimanche">Dimanche</option>
                                        </select>
                                    </div>
                                        <div class="form-group">
                                            <label>Début :</label>
                                            <select name="debut_heure" id="debut_heure"  size="1">
                                            <?php
                                                for ($i=0; $i <24 ; $i++) {
                                                    echo "<option>$i</option>";
                                                }
                                             ?>
                                             </select>
                                             <select name="debut_minute" id="debut_minute"  size="1">
                                                <?php
                                                    for ($i=0; $i <60 ; $i++) {
                                                        echo "<option>$i</option>";
                                                    }
                                                 ?>
                                             </select>

                                            <label>Fin :</label>
                                            <select name="fin_heure" id="fin_heure"  size="1">
                                           <?php
                                               for ($i=0; $i <24 ; $i++) {
                                                   echo "<option>$i</option>";
                                               }
                                            ?>
                                            </select>
                                            <select name="fin_minute" id="fin_minute"  size="1">
                                               <?php
                                                   for ($i=0; $i <60 ; $i++) {
                                                       echo "<option>$i</option>";
                                                   }
                                                ?>
                                            </select>
                                        </div>
                                    <button onclick="update_date()" class="btn btn-primary">Valider</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="schedule.js"></script>
