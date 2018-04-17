<?php
session_start();
require "assets/include/function.php";

/* VIEW TICKET DATA */
$ticket_base = support_ticket_view($_GET["ticket"]);

/* VIEW TICKET MESSAGES */
$messages = support_messages_view($_GET["ticket"]);

/* SEARCH PSEUDO CUSTOMER */
$customer = customers_data($ticket_base["id_customer"]);

/* SEND NEW MESSAGE */
if(isset($_POST["customer"]) && isset($_POST["ticket"]) && isset($_POST["message"])){
    support_message_send($_POST["customer"], $_POST["ticket"], $_POST["message"]);
}

?>

<table class="table table-striped">
    <tbody>
        <tr>
            <th><?php echo $customer["pseudo_customer"]; ?></th>
        </tr>
        <tr>
            <td><?php echo $ticket_base["description"]; ?></td>
        </tr>
        <?php
        foreach($messages as $message){
            /* SEARCH PSEUDO CUSTOMER */
            $customer = customers_data($message["id_customer"]);
            echo    '<tr>
                        <th>'.$customer["pseudo_customer"].'</th>
                    </tr>
                    <tr>
                        <td>'.$message["message"].'</td>
                    </tr>';
        }
        ?>
    </tbody>
</table>


<button class="btn btn-primary" data-toggle="modal" data-target="#add_message" style="margin-left: 50px;">Ajouter un message</button></td>
        </tr>

        <div class="modal fade" id="add_message" tabindex="-1" role="dialog" aria-labelledby="Ajouter un message" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Votre message :</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="message_add" method="post" onsubmit="return false">
                            <div class="form-group">
                                    <textarea class="form-control" name="message" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" data-dismiss="modal" onclick="support_message_add(<?php echo $_SESSION["account"]["id_customer"].','.$_GET["ticket"]?>)" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
