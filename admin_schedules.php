<?php
    $pageDescription = "Page administrateur de Work'n Share - Horaires.";
    $pageTitle = "Work'n Share - Horaires";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }

?>


    <body>
        <?php include 'assets/include/header.php'; ?>
        <section>
            <script src="schedule.js" onload="display_schedules()"></script>
        </section>
        <?php include "assets/include/footer.php"; ?>
        </body>
        </html>
