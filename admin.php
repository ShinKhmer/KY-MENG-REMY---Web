<?php
    $pageDescription = "Page administrateur de Work'n Share.";
    $pageTitle = "Work'n Share - Administration";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }
?>

    <body>
        <?php include 'assets/include/header.php'; ?>
        <section>
            <center><h2>Bienvenue dans la page d'administration !</h2></center>

            <div class="container main-content">
        		<div class="row" style="margin-top:50px; margin-bottom:50px;">
        			<div class="col-md-12">
                        <div class="card-deck">
                            <div class="card">
                                <a class="btn btn-secondary" href="admin_users.php" role="button" style="padding-left:30%; padding-right:30%">Afficher les utilisateurs</a><br>
                                <a class="btn btn-secondary" href="admin_equipments.php" role="button">Modifier l'inventaire des équipements</a><br>
                                <a class="btn btn-secondary" href="admin_schedules.php" role="button">Modifier l'horaire d'un site</a><br>
                                <a class="btn btn-secondary" href="admin_rooms.php" role="button">Ajouter ou modifier une salle</a><br>
                                <a class="btn btn-secondary" href="admin_subscriptions.php" role="button">Ajouter ou modifier un abonnement</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <?php
            include "assets/include/footer.php";
        ?>
    </body>
</html>
