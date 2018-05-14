<?php
$pageDescription = "Support de Work'n Share";
$pageTitle = "Work'n Share - Support";
include "assets/include/head.php";

/* IF USER */
if(!isset($_SESSION["account"]["token"])){
    header('Location: index.php');
}


/* ADD TICKET */
if(isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["description"])){
    ticket_support_add($_SESSION["account"]["id_customer"], $_POST["id"], $_POST["title"], $_POST["description"]);
}

/* EQUIPMENTS DATAS AND SUBTITLE*/
$categories = support_search_category();

if($_SESSION["account"]["admin"] == 1){
    $tickets = support_admin_view();
    $subtitle = "Liste des tickets";
}
else{
    $tickets = support_customer_view($_SESSION["account"]["id_customer"]);
    $subtitle = "Aperçu de vos tickets";
}

?>

<body>
<?php include "assets/include/header.php"; ?>
<section style="margin-top: 50px">
    <div class="container container-main-content">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center border-bottom border-bottom-header">Bienvenue sur la page de support de Work'n Share</h1>
            </div>
        </div>

        <div class="row" style="margin-top:50px;">
            <div class="col-lg-12">
                <div class="card-deck">
                    <div class="card card-profile text-center border border-info border-profile">
                        <h5 class="card-header card-header-profile"><?php echo $subtitle; ?></h5>
                        <div id="support-js" class="card-body card-body-profile">

                            <table class="table table-borderless">
                                <tbody>
                                <?php
                                if($tickets == null){
                                    echo "Aucun ticket trouvé";
                                }else{
                                    ?>
                                    <tr>
                                        <th>Référence du ticket</th>
                                        <th>Intitulé du ticket</th>
                                        <th>Date de création</th>
                                        <th>Etat</th>
                                    </tr>
                                    <?php
                                    foreach ($tickets as $ticket) {
                                        if($ticket["state"] == 0){
                                            $state_print = "Non résolu";
                                        }
                                        else{
                                            $state_print = "Résolu";
                                        }
                                        echo '  <tr>
                                                    <td>'.$ticket["id_ticket"].'</td>
                                                    <td>'.$ticket["subject"].'</td>
                                                    <td>'.date('d/m/Y - H:i', strtotime($ticket["date_creation"])).'</td>
                                                    <td>'.$state_print.'</td>
                                                    <td>
                                                        <a class="btn btn-primary btn-purple" href="support_ticket_view.php?ticket='.$ticket["id_ticket"].'">Visualiser</a>
                                                        </button>
                                                    </td>
                                                </tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>

                            <!-- ADD TICKET POP UP -->
                            <?php
                            if($_SESSION["account"]["admin"] != 1){
                                echo '<button class="btn btn-primary btn-orange" data-toggle="modal" data-target="#add_ticket">Soumettre un ticket</button></td>';
                            }
                            ?>



                            <div class="modal fade" id="add_ticket" tabindex="-1" role="dialog" aria-labelledby="Ajouter un message" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouveau ticket</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form name="ticket_add" method="post" onsubmit="return false">
                                                <div class="form-group">
                                                    <label style="color:black;">Equipement :</label>
                                                    <select name="select_equipment" required="required" onchange="support_view_equipment_list()">
                                                        <option value="">Sélectionner</option>
                                                        <?php
                                                        foreach($categories as $category){
                                                            echo '<option value ="'.$category["name_equipment"].'">'.$category["name_equipment"].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div id="equipment_reference" class="form-group">
                                                    <!-- AJAX -->
                                                </div>
                                                <div class="form-group">
                                                    <label style="color:black;">Intitulé :</label>
                                                    <textarea class="form-control" name="title" required="required"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label style="color:black;">Description :</label>
                                                    <textarea class="form-control" name="message" rows="10" required="required"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-secondary btn-purple" data-dismiss="modal">Annuler</button>
                                                    <button id="btn_send_ticket" onclick="support_ticket_add()" class="btn btn-primary btn-orange">Envoyer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="function.js"></script>
<?php include "assets/include/footer.php"; ?>
</body>
</html>
