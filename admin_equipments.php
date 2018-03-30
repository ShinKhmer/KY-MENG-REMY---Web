<?php
    $pageDescription = "Page administrateur de Work'n Share - Equipements.";
    $pageTitle = "Work'n Share - Administration - Equipements";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }

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

<body>
  <?php include 'assets/include/header.php'; ?>
    <section>
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
                                    foreach($result as $res){
                                            $db = connectDb();
                                            $name =name_town($res[3],$db);
                                        echo '  <tr>
                                                    <td><center>'.$name.'</center></td>
                                                    <td><center>'.$res[1].'</center></td>
                                                    <td><center>'.$res[2].'</center></td>
                                                    <td><a class="btn btn-primary" href="admin_equipments_edit.php?id_equipment='.$res[0].'&id_location='.$res[3].'" role="button" style="margin-left: 50px">Modifier</a></td>
                                                </tr>';
                                    }
                                 ?>
                            </table>

                            <a class="btn btn-secondary" href="admin_equipments_add.php" role="button" style="margin-left:45%">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include "assets/include/footer.php"; ?>
