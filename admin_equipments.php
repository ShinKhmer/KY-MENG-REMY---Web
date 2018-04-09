<?php
    $pageDescription = "Page administrateur de Work'n Share - Equipements.";
    $pageTitle = "Work'n Share - Administration - Equipements";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
      header('Location: index.php');
      exit();
    }


    if( isset($_GET["user"]) ){

    }

?>

<body>
  <?php include 'assets/include/header.php'; ?>
    <section>
        <script src="function.js" onload="admin_equipments_print()"></script>
    </section>


    <script src="function.js"></script>

    <?php include "assets/include/footer.php"; ?>
</body>

</html>
