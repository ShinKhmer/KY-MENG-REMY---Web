<?php
    $pageDescription = "Page administrateur de Work'n Share - Horaires.";
    $pageTitle = "Work'n Share - Horaires";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }
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

    <body>
        <?php include 'assets/include/header.php'; ?>
        <section>
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
                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href="admin_schedules_edit.php" role="button">Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
