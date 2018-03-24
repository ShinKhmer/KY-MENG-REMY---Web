<?php
    include "assets/include/header.php";
?>
    <section>
        <center><h2>Bienvenue dans la page d'administration !</h2></center>

        <div class="container main-content">
			<div class="row" style="margin-top:50px; margin-bottom:50px;">
				<div class="col-md-12">
                    <div class="card-deck">
                        <div class="card">
                        <a class="btn btn-secondary" href="admin_users.php" role="button">Afficher les utilisateurs</a><br>
                        <a class="btn btn-secondary" href="admin_equipments.php" role="button">Modifier l'inventaire des équipements</a><br>
                        <a class="btn btn-secondary" href="admin_schedules.php" role="button">Modifier l'horaire d'un site</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


<?php
    include "assets/include/footer.php";
?>
