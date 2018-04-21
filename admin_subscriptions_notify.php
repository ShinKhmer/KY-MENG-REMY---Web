<?php
$pageDescription = "Page administrateur de Work'n Share.";
$pageTitle = "Work'n Share - Administration";
include 'assets/include/head.php';
if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
    header('Location: index.php');
    exit();
}

/* SEND MAIL */
$customers = customers_list();

if(isset($_POST["mail"])){
    $subscription = customers_data_by_email($_POST["mail"]);
    $end_subscription = strtotime($subscription["end_subscription"]);
    $end_subscription = date("d-m-Y", $end_subscription);
    $text = "
    Bonjour M. ".$subscription["name_customer"].",

    Votre abonnement prend fin le ".$end_subscription.".
    Le renouvellement automatique est toujours actif !

    Cordialement,

    Work'n Share";
    mail($_POST["mail"], "Notification", $text);
    echo $subscription["end_subscription"];
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
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Pseudo</th>
                                            <th>Email</th>
                                            <th>Début abonnement</th>
                                            <th>Fin abonnement</th>
                                        </tr>
                                        <?php
                                        foreach($customers as $customer){
                                            echo '  <tr>
                                                        <td>'.$customer["pseudo_customer"].'</td>
                                                        <td>'.$customer["email_customer"].'</td>
                                                        <td>'.$customer["begin_subscription"].'</td>
                                                        <td>'.$customer["end_subscription"].'</td>
                                                        <td><button class="btn btn-primary" onclick="send_mail(\''.$customer["email_customer"].'\')">Notifier</button></td>
                                                    </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="function.js"></script>

        </section>

        <?php
        include "assets/include/footer.php";
        ?>
    </body>
</html>
