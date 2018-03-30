<?php
    $pageDescription = "Page administrateur de Work'n Share - Ajouter un abonnement.";
    $pageTitle = "Work'n Share - Ajout d'abonnement";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) && $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }
    $error = false;

    if( isset($_POST) && !empty($_POST) ){
        $db = connectDb();

        // CHECK
        $query = $db->prepare("SELECT type_subscription FROM SUBSCRIPTION");

        $query->execute();

        $result = $query->fetchAll();

        $cpt = 0;

        foreach($result as $res){
            if(strcmp($_POST["subscription_name"], $res[0]) == 0)
                $cpt++;
        }

        if($cpt == 0){
            // SEND
            $query = $db->prepare("INSERT INTO SUBSCRIPTION(type_subscription, price_with_engagement, price_without_engagement, description) VALUES(:type_subscription, :price_with_engagement, :price_without_engagement, :description)");

            $query->execute([   "type_subscription" => $_POST["subscription_name"],
                                "price_with_engagement" => $_POST["price_with_engagement"],
                                "price_without_engagement" => $_POST["price_without_engagement"],
                                "description" => $_POST["description"]
                            ]);

            header('Location:admin_subscriptions.php');
        }else{
            $error = true;
        }
    }
?>

    <body>
        <?php include 'assets/include/header.php'; ?>

        <section>
            <center><h2>Administration - Ajout d'abonnement</h2></center>

            <div class="container main-content">
                <div class="row" style="margin-top:50px; margin-bottom:50px;">
                    <div class="col-md-12">
                        <div class="card-deck">
                            <div class="card" style="padding-left:30%; padding-right:30%;">
                                <form method="POST" action="admin_subscriptions_add.php">
                                    <center>
                                        <div class="form-group">
                                                <label>Type d'abonnement :</label>
                                                <input type="text" class="form-control" name="subscription_name" required="required">
                                        </div>
                                        <div class="form-group">
                                            <center>
                                                <label>Prix avec engagement(€):</label>
                                                <input type="text" class="form-control" name="price_with_engagement" required="required">

                                                <label>Prix sans engagement(€):</label>
                                                <input type="text" class="form-control" name="price_without_engagement" required="required">
                                            </center>
                                        </div>
                                        <div class="form-group">
                                            <center>
                                                <label>Description</label>
                                                <textarea class="form-control" rows="15" name="description"></textarea></center>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Valider</button>
                                        <?php
                                            if($error == true){
                                                echo '<p class="bg-danger">Cet abonnement est déjà existant !</p>';
                                                unset($error);
                                            }
                                        ?>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
