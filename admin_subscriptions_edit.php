<?php include "assets/include/header.php";

    // PRINT DATAS
    $db = connectDb();

    $query = $db->prepare(" SELECT type_subscription,
                            price_with_engagement,
                            price_without_engagement,
                            description
                            FROM SUBSCRIPTION
                            WHERE id_subscription=:id_subscription
                        ");

    $query->execute([ "id_subscription" => $_GET["id_subscription"] ]);

    $result = $query->fetch();

    // UPDATE DATAS
    if( isset($_POST) && !empty($_POST) ){

        $query = $db->prepare(" UPDATE SUBSCRIPTION
                                SET type_subscription=:type_subscription,
                                price_with_engagement=:price_with_engagement,
                                price_without_engagement=:price_without_engagement,
                                description=:description
                                WHERE id_subscription=:id_subscription
                            ");

        $query->execute([   "type_subscription" => $_POST["subscription_name"],
                            "price_with_engagement" => $_POST["price_with_engagement"],
                            "price_without_engagement" => $_POST["price_without_engagement"],
                            "description" => $_POST["description"],
                            "id_subscription" => $_GET["id_subscription"]
                        ]);

        header('Location:admin_subscriptions.php');

        unset($_POST);
    }
    if(isset($_GET["id_subscription"]) && isset($_GET["del"]) && $_GET["del"] == "true" ){

        $query = $db->prepare("DELETE FROM SUBSCRIPTION WHERE id_subscription=:id_subscription");

        $query->execute([
                            "id_subscription" => $_GET["id_subscription"]
                            ]);

        header('Location:admin_subscriptions.php');

        unset($_POST);
    }
?>

<section>
    <center><h2>Administration - Modification d'abonnement</h2></center>

    <div class="container main-content">
        <div class="row" style="margin-top:50px; margin-bottom:50px;">
            <div class="col-md-12">
                <div class="card-deck">
                    <div class="card" style="padding-left:30%; padding-right:30%;">
                        <?php echo '<form method="POST" action="admin_subscriptions_edit.php?id_subscription='.$_GET["id_subscription"].'">'; ?>
                            <center>
                                <div class="form-group">
                                    <label>Type d'abonnement :</label>
                                    <?php echo '<input type="text" class="form-control" name="subscription_name" value="'.$result[0].'" required="required">'; ?>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <label>Prix avec engagement par mois :</label>
                                        <?php echo '<input type="text" class="form-control" name="price_with_engagement" value="'.$result[1].'" required="required">'; ?>
                                    </center>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <label>Prix sans engagement par mois :</label>
                                        <?php echo '<input type="text" class="form-control" name="price_without_engagement" value="'.$result[2].'" required="required">'; ?>
                                    </center>
                                </div>
                                <div class="form-group">
                                    <center>
                                        <label>Description :</label>
                                        <?php echo '<input type="text" class="form-control" name="description" value="'.$result[3].'">'; ?>
                                    </center>
                                </div>
                                <button type="submit" class="btn btn-primary">Valider</button>

                                <?php echo '<a class="btn btn-danger" href="admin_subscriptions_edit.php?id_subscription='.$_GET["id_subscription"].'&del=true">Supprimer</a>'; ?>

                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include "assets/include/footer.php"; ?>
