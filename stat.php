<?php
require 'assets/include/function.php';
$db = connectDb();

$query = $db->prepare("SELECT COUNT(*) FROM customers WHERE inside = 1 ");

$query->execute();

$result = $query->fetchAll();
 ?>


        <div class="plop" id="current_in">
                <?php foreach ($result as $res) {
                    echo "Utilisateurs dans un site : ".$res["COUNT(*)"];
                } ?>
        </div>
        <script src="function.js" onload="stat()"></script>
