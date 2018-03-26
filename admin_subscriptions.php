<?php
    include "assets/include/header.php";
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM SUBSCRIPTION");

    $query->execute();

    $result = $query->fetchAll();
?>

<section>
    <center><h2>Administration - Abonnements</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:20%; padding-right:20%;">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Type d'abonnement</th>
                                <th>Prix avec abonnement</th>
                                <th>Prix sans abonnement</th>
                            </tr>
                            <?php
                                foreach($result as $res){
                                    echo '  <tr>
                                                <td><center>'.$res[1].'</center></td>
                                                <td><center>'.$res[2].' €</center></td>
                                                <td><center>'.$res[3].' €</center></td>
                                                <td><a class="btn btn-primary" href="admin_subscriptions_edit.php?id_subscription='.$res[0].'" role="button">Modifier</a></td>
                                            </tr>';
                                }
                             ?>
                        </table>

                        <a class="btn btn-secondary" href="admin_subscriptions_add.php" role="button" style="margin-left:30%; margin-right:30%">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
