<?php
	session_start();
	require "assets/include/functions.php";

	$db = connectDb();

	//if( isConnected() ){

		if( isset($_GET["user"]) && isset($_GET["promote"]) ){

			$query = $db->prepare("SELECT is_admin FROM CUSTOMERS WHERE id_customer=:id_customer");

			$query->execute([
						"id_customer"=>$_GET["user"]
					]);

			$result = $query->fetch();


			// CONDITIONS POUR UPGRADE

			if( $_GET["promote"] == "up" && $result[0] == 0 ){

				$query = $db->prepare("UPDATE CUSTOMERS SET is_admin=:is_admin WHERE id_customer=:id_customer");

				$query->execute([
							"is_admin"=>1,
							"id_customer"=>$_GET["user"]
						]);

				header("Location:admin_users.php?statut=ok");
			}else if( $_GET["promote"] == "up" && $result[0] != 0 ){
				header("Location:admin_users.php?statut=error");
			}



			// CONDITIONS POUR DOWNGRADE

			if( $_GET["promote"] == "down" && $result[0] == 1 ){

				$query = $db->prepare("UPDATE CUSTOMERS SET is_admin=:is_admin WHERE id_customer=:id_customer");

				$query->execute([
							"is_admin"=>0,
							"id_customer"=>$_GET["user"]
						]);

				header("Location:admin_users.php?statut=ok");
			}else if( $_GET["promote"] == "down" && $result[0] != 1 ){
				header("Location:admin_users.php?statut=error");
			}

		}

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

		if( isset($_GET["user"]) && isset($_GET["unblock"]) && $_GET["unblock"] == "true" ){

			$query = $db->prepare("UPDATE CUSTOMERS SET blocked=:blocked WHERE id_customer=:id_customer");

			$query->execute([
						"blocked"=>0,
						"id_customer"=>$_GET["user"]
					]);

			header("Location:admin_users.php?statut=ok");
		}
