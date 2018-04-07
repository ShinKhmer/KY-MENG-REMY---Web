<?php
	include 'assets/include/function.php';

	$db = connectDb();

	$query = $db->prepare("SELECT CUSTOMERS.id_customer, pseudo_customer, last_name_customer, name_customer, email_customer, is_admin, blocked FROM CUSTOMERS, STAFF WHERE STAFF.id_customer=CUSTOMERS.id_customer");

	$query->execute();

	$result = $query->fetchAll();


	if(isset($_GET["promote"])){

		// CONDITIONS POUR UPGRADE
		/* Afin d'obtenir le bon indice de tableau, il faudra appliquer ce calcul : id_user - 1*/
		if( $_GET["promote"] == "up" && $result[$_GET["user"]-1][5] == 0 ){

			$query = $db->prepare("UPDATE STAFF SET is_admin=:is_admin WHERE id_customer=:id_customer");

			$query->execute([
						"is_admin"=>1,
						"id_customer"=>$_GET["user"]
					]);
		}

		// CONDITIONS POUR DOWNGRADE
		if( $_GET["promote"] == "down" && $result[$_GET["user"]-1][5] == 1 ){

			$query = $db->prepare("UPDATE STAFF SET is_admin=:is_admin WHERE id_customer=:id_customer");

			$query->execute([
						"is_admin"=>0,
						"id_customer"=>$_GET["user"]
					]);
		}
	}



	if( isset($_GET["block"]) ){
		// BLOQUER UN MEMBRE

		if( isset($_GET["user"]) && isset($_GET["block"]) && $_GET["block"] == "true" ){

			$query = $db->prepare("UPDATE CUSTOMERS SET blocked=:blocked WHERE id_customer=:id_customer");

			$query->execute([
						"blocked"=>1,
						"id_customer"=>$_GET["user"]
					]);

			header("Location:admin_users.php?statut=ok");
		}

		// DEBLOQUER UN MEMBRE

		if( isset($_GET["user"]) && isset($_GET["block"]) && $_GET["block"] == "false" ){

			$query = $db->prepare("UPDATE CUSTOMERS SET blocked=:blocked WHERE id_customer=:id_customer");

			$query->execute([
						"blocked"=>0,
						"id_customer"=>$_GET["user"]
					]);

			header("Location:admin_users.php?statut=ok");
		}
	}
?>

	<center><h2>Administration - Utilisateurs</h2></center>';
	<div class="container main-content">
		<div class="row" style="margin-top:50px; margin-bottom:50px;">
			<div class="col-md-12">
				<div  class="card">
					<table class="table table-responsive table-hover" style="width:100%">
					    <tr>
					        <th>ID USER</th>
					        <th>PSEUDO</th>
					        <th>NOM</th>
					        <th>PRENOM</th>
					        <th>EMAIL</th>
					        <th>Rang</th>
					        <th>Promotion</th>
					        <th>Bloquer</th>
					    </tr>
					    <?php
					        foreach($result as $res){
					            echo '	<tr>
					                        <td>'.$res[0].'</td>
					                        <td>'.$res[1].'</td>
					                        <td>'.$res[2].'</td>
					                        <td>'.$res[3].'</td>
					                        <td>'.$res[4].'</td>
					                        <td>';
					                            if($res[5] == 0)
					                                echo "Utilisateur";
					                            else if($res[5] == 1)
					                                echo "Administrateur";
					            echo '     </td>
					                        <td>';
					                            if($res[5] == 0)
					                                echo '<button class="btn btn-primary" onclick="promote('.$res[0].', \'up\')">Promouvoir</button>';
					                                //echo '<a class="btn btn-primary" href="admin_users_actions.php?user='.$res[0].'&promote=up" role="button">Promouvoir</a>';
					                            else if($res[5] == 1)
					                                echo '<button class="btn btn-primary" onclick="promote('.$res[0].', \'down\')">Destituer</button>';
					                                //echo '<a class="btn btn-primary" href="admin_users_actions.php?user='.$res[0].'&promote=down" role="button">Destituer</a>';
					            echo '      </td>
					                        <td>';
					                            if($res[6] == 0){
					                                echo '<button class="btn btn-danger" onclick="block('.$res[0].', \'true\')">Bloquer</button>';
					                            }
					                            else if($res[6] == 1){
													echo '<button class="btn btn-danger" onclick="block('.$res[0].', \'false\')">Débloquer</button>';
					                            }
					            echo '		</td>
					                    </tr>';
					        }
					    ?>

					</table>
				</div>
			</div>
		</div>
	</div>
</section>


<?php include "assets/include/footer.php"; ?>
</body>
</html>
