<?php
    $pageDescription = "Page administrateur de Work'n Share - Abonnements.";
    $pageTitle = "Work'n Share - Abonnements";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM SUBSCRIPTION");

    $query->execute();

    $result = $query->fetchAll();
?>

    <body>
        <?php include 'assets/include/header.php'; ?>

        <section>
            <center><h2>Administration - Abonnements</h2></center>

            <div class="container main-content">
                <div class="row" style="margin-top:50px; margin-bottom:50px;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="offset-md-2 col-md-8">
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

                                <a class="btn btn-secondary" href="admin_subscriptions_add.php" role="button" style="margin-left:45%;">Ajouter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
