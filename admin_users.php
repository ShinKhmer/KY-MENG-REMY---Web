<?php
    $pageDescription = "Page administrateur de Work'n Share.";
    $pageTitle = "Work'n Share - Administration";
    include 'assets/include/head.php';
    if(!isset($_SESSION["account"]["token"]) && !isset($_SESSION["account"]["admin"]) || $_SESSION["account"]["admin"] != 1){
      //header('Location: index.php');
      exit();
    }

/* SEARCH CUSTOMERS DATA */

?>

    <body>
    <?php   include 'assets/include/header.php'; ?>
    <section>
    <script src="function.js" onload="users_table_print()"></script>
