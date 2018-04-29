<?php
    $pageDescription = "Page administrateur de Work'n Share - Salles.";
    $pageTitle = "Work'n Share - Administration - Salles";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }

    $db = connectDb();

    $query = $db->prepare("SELECT * FROM ROOM ORDER BY id_location ASC");

    $query->execute();

    $result = $query->fetchAll();
?>

    <body>
        <?php include 'assets/include/header.php'; ?>

        <section>
            <center><h2>Administration - Salles</h2></center>

            <div class="container main-content">
                <div class="row" style="margin-top:50px; margin-bottom:50px;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="offset-md-2 col-md-8">
                                <table class="table table-responsive table-hover">
                                    <tr>
                                        <th>Lieu</th>
                                        <th>Type de salle</th>
                                        <th>Nombre de places</th>
                                    </tr>
                                    <?php
                                        foreach($result as $res){
                                                $db = connectDb();
                                                $name =name_town($res[4],$db);
                                            echo '  <tr>
                                                        <td><center>'.$name.'</center></td>
                                                        <td><center>'.$res[1].'</center></td>
                                                        <td><center>'.$res[2].'</center></td>
                                                        <td><a class="btn btn-primary" href="admin_rooms_edit.php?id_room='.$res[0].'&id_location='.$res[4].'" role="button">Modifier</a></td>
                                                    </tr>';
                                        }
                                     ?>
                                </table>

                                <a class="btn btn-secondary" href="admin_rooms_add.php" role="button" style="margin-left:45%;">Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
