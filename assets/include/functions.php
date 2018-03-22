<?php
	require_once "conf.inc.php";


	function connectDb(){
		try{
			$db = new PDO(
				"mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER , DB_PWD );
		}catch(Exception $e){
			die("Erreur SQL : ". $e->getMessage() );
		}

		return $db;
	}



	function isConnected(){

		if( !empty( $_SESSION["token"] ) && !empty( $_SESSION["user_connected"] ) ){

			$db = connectDb();

			$query = $db->prepare("SELECT id_user FROM USERS WHERE id_user = :id_user AND token = :token");

			$query->execute( [
								"id_user" => $_SESSION["user_connected"],
								"token" => $_SESSION["token"]
							] );


			if( $query->rowCount() ){
				$_SESSION["token"] = regenerateAccessToken( $_SESSION["user_connected"] );
				return true;
			}

			else{

				logout($_SESSION["user_connected"]);
				return false;
			}
		}
		else{
			return false;
		}

	}



	function regenerateAccessToken($id_user){
		$token = md5(uniqid()."dapokd .dakFpok");

		$db = connectDb();

		$query = $db->prepare("UPDATE USERS SET token = :token WHERE id_user = :id_user");

        $query->execute( [
	                        "token" => $token,
	                        "id_user" => $id_user
	                    ] );

		return $token;
	}




	function logout($id_user, $redirect=false){

		$db = connectDb();

		$query = $db->prepare("UPDATE users SET token=null WHERE id_user = :id_user");

		$query->execute( [
							"id_user" => $id_user
						]);

		unset($_SESSION["user_connected"]);
		unset($_SESSION["token"]);
		unset($_SESSION["first_name"]);
		unset($_SESSION["level"]);

		if($redirect){
			header('Location: index.php');
		}
	}


	function displayErrors($list, $error){

		if( isset($error) ){
			foreach ($error as $e) {
				echo '<span class="glyphicon glyphicon-warning-sign"></span>'.$list[$e].'<br>';
			}
		}
	}
