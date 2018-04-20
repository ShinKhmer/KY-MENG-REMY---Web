<?php
$pageDescription = "Ticket #".$_GET["ticket"]." de Work'n Share";
$pageTitle = "Work'n Share - Support - Ticket #".$_GET["ticket"];
include "assets/include/head.php";


/* IF USER */
if(!isset($_SESSION["account"]["token"])){
    header('Location: index.php');
}

/* VIEW TICKET DATA */
$ticket_base = support_ticket_view($_GET["ticket"]);

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
                            <div id="support-js" class="card card-profile text-center border border-info border-profile">
                                    <!-- AJAX -->
                                    <script src="function.js" onload="support_messages_print(<?php echo $_GET["ticket"]; ?>)"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "assets/include/footer.php"; ?>
    </body>
</html>
