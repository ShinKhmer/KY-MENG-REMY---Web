<?php

require "conf.inc.php";

function connectDb() {
  try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo '<script>console.log("Connection ok");</script>';
  } catch(PDOException $e) {
    die("Erreur de connection: " . $e->getMessage() );
  }
  return $db;
}

function verifyInput($data) {
	echo " verifyInput ";
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function generateRandomCustomerCode($length = 10) {
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomCustomerCode = '';
	for ($i = 0; $i < $length; $i++) {
		$randomCustomerCode .= $characters[rand(0, $charactersLength - 1)];
	}
	// Vérifiez si le code existe déjà dans la BDD
	$db = connectDb();
	$query = $db->prepare("SELECT * FROM customers WHERE code_customer = :code_customer");
	$query->execute([
		"code_customer" => $randomCustomerCode
	]);
	// Le code existe on doit en faire un autre
	if(empty($query->fetch())) {
		return $randomCustomerCode;
	}
	generateRandomCustomerCode($length);
}

function registerCustomer(){

  $db = connectDb();
	$randomCustomerCode = generateRandomCustomerCode();
  $error = false;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $name_customer_Error = "Un prénom est requis";
      $error = true;
    } else {
      $name_customer = verifyInput($_POST["name"]);
      if(!ctype_alpha($name_customer)) {
        $name_customer_Error = "Seules les lettres sont autorisés";
        $error = true;
      }
    }

    if (empty($_POST["last-name"])) {
      $last_name_customer_Error = "Un nom est requis";
      $error = true;
    } else {
      $last_name_customer = verifyInput($_POST["last-name"]);
      if(!ctype_alpha($last_name_customer)) {
        $last_name_customer_Error = "Seules les lettres sont autorisés";
        $error = true;
      }
    }

    if (empty($_POST["email"])) {
      $email_customer_Error = "Un email est requis";
      $error = true;
    } else {
      $email_customer = verifyInput($_POST["email"]);
      if (!filter_var($email_customer, FILTER_VALIDATE_EMAIL)) {
        $email_customer_Error = "Format d'email invalide";
        $error = true;
      }
    }

    if (empty($_POST["tel"])) {
      $phone_number_customer_Error = "Un téléphone est requis";
      $error = true;
    } else {
      $phone_number_customer = verifyInput($_POST["tel"]);
      if (!preg_match("^(0[1-68])(?:[ _.-]?(\d{2})){4}$",$_POST["tel"])) {
        $phone_number_customer_Error = "Format de téléphone invalide";
        $error = true;
      }
    }

    if (empty($_POST["pseudo"])) {
      $pseudo_customer_Error = "Un pseudo est requis";
      $error = true;
    } else {
      $pseudo_customer = verifyInput($_POST["pseudo"]);
      if(!ctype_alnum($pseudo_customer)) {
        $pseudo_customer_Error = "Seules les lettres et les chiffres sont autorisés";
        $error = true;
      }
    }

    if (empty($_POST["password"])) {
      $password_customer_Error = "Un mot de passe est requis";
    } else {
      $password_customer = verifyInput($_POST["password"]);
      if(!ctype_alnum($password_customer)) {
        $password_customer_Error = "Seules les lettres et les chiffres sont autorisés";
        $error = true;
      }
      if (strlen($_POST["password"])<8 || strlen($_POST["password"])>20) {
        $password_customer_Error = "Min: 8 - Max: 20";
        $error = true;
      }
    }
  }

	echo " En dehors de la condition error ";

  if(!$error) {
		echo "Dans la condition error ";
    // Préparation SQL et paramètres bind
    $query = $db->prepare("INSERT INTO customers (name_customer, last_name_customer, email_customer, phone_number_customer, pseudo_customer, password_customer, code_customer, inside)
    VALUES (:name_customer, :last_name_customer, :email_customer, :phone_number_customer, :pseudo_customer, :password_customer, :code_customer, :inside)");
    $query->bindParam(':name_customer', $name_customer);
    $query->bindParam(':last_name_customer', $last_name_customer);
    $query->bindParam(':email_customer', $email_customer);
    $query->bindParam(':phone_number_customer', $phone_number_customer);
    $query->bindParam(':pseudo_customer', $pseudo_customer);
    $query->bindParam(':password_customer', $password_customer);
    $query->bindParam(':code_customer', $code_customer);
    $query->bindParam(':inside', $inside);

    // Protection du mot de passe
    $password_customer = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Insertion du client
    $name_customer = $name_customer;
    $last_name_customer = $last_name_customer;
    $email_customer = $email_customer;
    $phone_number_customer = $phone_number_customer;
    $pseudo_customer = $pseudo_customer;
    $password_customer = $password_customer;
    $code_customer = $randomCustomerCode;
    $inside = "0";
    $query->execute();
  }
}

?>
