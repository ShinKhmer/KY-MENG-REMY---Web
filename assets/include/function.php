<?php

require "conf.inc.php";

function connectDb() {
  try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("Erreur de connection: " . $e->getMessage() );
  }
  return $db;
}

function verifyInput($data) {
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
      $_SESSION["errors"]["name_customer_error"] = "Un prénom est requis";
      $error = true;
    } else {
      $name_customer = verifyInput($_POST["name"]);
      if(!ctype_alpha($name_customer)) {
        $_SESSION["errors"]["name_customer_error"] = "Seules les lettres sont autorisés";
        $error = true;
      }
    }

    if (empty($_POST["last-name"])) {
      $_SESSION["errors"]["last_name_customer_error"] = "Un prénom est requis";
      $error = true;
    } else {
      $last_name_customer = verifyInput($_POST["last-name"]);
      if(!ctype_alpha($last_name_customer)) {
        $_SESSION["errors"]["last_name_customer_error"] = "Seules les lettres sont autorisés";
        $error = true;
      }
    }

    if (empty($_POST["email"])) {
      $_SESSION["errors"]["email_customer_error"] = "Un email est requis";
      $error = true;
    } else {
      $email_customer = verifyInput($_POST["email"]);
      if (!filter_var($email_customer, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["errors"]["email_customer_error"] = "Format d'email invalide";
        $error = true;
      }
    }

    if (empty($_POST["tel"])) {
      $_SESSION["errors"]["phone_number_customer_error"] = "Un téléphone est requis";
      $error = true;
    } else {
      $phone_number_customer = verifyInput($_POST["tel"]);
      if (!(strlen($_POST["tel"])==0 or (strlen($_POST["tel"])==10 and is_numeric($_POST["tel"])))) {
        $_SESSION["errors"]["phone_number_customer_error"] = "Format de téléphone invalide";
        $error = true;
      }
    }

    if (empty($_POST["pseudo"])) {
      $_SESSION["errors"]["pseudo_customer_error"] = "Un pseudo est requis";
      $error = true;
    } else {
      $pseudo_customer = verifyInput($_POST["pseudo"]);
      if(!ctype_alnum($pseudo_customer)) {
        $_SESSION["errors"]["pseudo_customer_error"] = "Seules les lettres et les chiffres sont autorisés";
        $error = true;
      }
    }

    if (empty($_POST["password"])) {
      $_SESSION["errors"]["password_customer_error"] = "Un mot de passe est requis";
      $error = true;
    } else {
      $password_customer = verifyInput($_POST["password"]);
      if(!ctype_alnum($password_customer)) {
        $_SESSION["errors"]["password_customer_error"] = "Seules les lettres et les chiffres sont autorisés";
        $error = true;
      }
      if (strlen($_POST["password"])<8 or strlen($_POST["password"])>20) {
        $_SESSION["errors"]["password_customer_error"] = "Min: 8 - Max: 20";
        $error = true;
      }
    }
  }

	echo " En dehors de la condition error ";

  if(!$error) {
		echo "Dans la condition error ";
    // Préparation SQL et paramètres bind
    $query = $db->prepare("INSERT INTO customers (name_customer, last_name_customer, email_customer, phone_number_customer, pseudo_customer, password_customer, code_customer, inside, id_subscription, begin_subscription)
    VALUES (:name_customer, :last_name_customer, :email_customer, :phone_number_customer, :pseudo_customer, :password_customer, :code_customer, :inside, :id_subscription, :begin_subscription)");
    $query->bindParam(':name_customer', $name_customer);
    $query->bindParam(':last_name_customer', $last_name_customer);
    $query->bindParam(':email_customer', $email_customer);
    $query->bindParam(':phone_number_customer', $phone_number_customer);
    $query->bindParam(':pseudo_customer', $pseudo_customer);
    $query->bindParam(':password_customer', $password_customer);
    $query->bindParam(':code_customer', $code_customer);
    $query->bindParam(':inside', $inside);
    $query->bindParam(':id_subscription', $id_subscription);
    $query->bindParam(':begin_subscription', $begin_subscription);

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
    $id_subscription = "1";
    $begin_subscription = date('Y-m-d');
    $query->execute();

    // Récupération de l'id du client
    $query = $db->prepare("SELECT MAX(id_customer) FROM CUSTOMERS");
    $query->execute();
    $result = $query->fetch();
    var_dump($result);

    // Insertion de is_admin
    $query = $db->prepare("INSERT INTO STAFF VALUES(:is_admin, :id_customer)");
    $query->bindParam(':is_admin', $is_admin);
    $query->bindParam(':id_customer', $id_customer);

    $is_admin = 0;
    $id_customer = $result[0];
    $query->execute();

    // Message de confirmation de la création du compte
    $_SESSION["accountCreated"] = 1;

    header("Location: profil.php");
    exit;
  }
}

function generateAccessToken($pseudo_customer) {
	$token = md5(uniqid()."fdpo5524 .fFds");
	$db = connectDb();
	$query = $db->prepare("UPDATE customers SET token = :token WHERE pseudo_customer= :pseudo_customer");
	$query->execute([
    "token"=>$token,
		"pseudo_customer"=>$pseudo_customer
  ]);
  return $token;
}

function loginCustomer() {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db = connectDb();

		// Récupérer le mot de passe hashé dans la bdd pour le pseudo saisie
		$query = $db->prepare("SELECT * FROM customers, staff WHERE pseudo_customer=:pseudo_customer AND STAFF.id_customer=(SELECT id_customer FROM CUSTOMERS WHERE pseudo_customer=:pseudo_customer)");
		$query->execute([
      "pseudo_customer"=>$_POST["pseudo"]
		]);
		$data = $query->fetch();

		// Vérifier que le mdp hashé correspond au mot de passe saisi
		if(password_verify($_POST["password"],$data["password_customer"])) {

			// Mettre les identifiants en session
      $_SESSION["account"]["id_customer"] = $data['id_customer'];
      $_SESSION["account"]["token"] = generateAccessToken($_POST["pseudo"]);
      $_SESSION["account"]["pseudo"] = $_POST["pseudo"];
      $_SESSION["account"]["name"] = $data['name_customer'];
      $_SESSION["account"]["last_name"] = $data['last_name_customer'];
      $_SESSION["account"]["email"] = $data['email_customer'];
      $_SESSION["account"]["tel"] = $data['phone_number_customer'];
      $_SESSION["account"]["admin"] = $data['is_admin'];

			// Rediriger vers le profil
			header("Location: profil.php");

		} else {
      $_SESSION["errors"]["login_error"] = "Compte introuvable";
    }
  }
}

function isConnected() {
	// Vérifie l'existence des sessions pseudo et token
	if(!empty($_SESSION["account"]["pseudo"]) && !empty($_SESSION["account"]["token"])) {
		// Vérifie l'existence en BDD du pseudo et du token
		$db = connectDb();
		$query = $db->prepare("SELECT id_customer FROM customers WHERE pseudo_customer=:pseudo_customer AND token=:token");

		$query->execute([
      "pseudo_customer"=>$_SESSION["account"]["pseudo"],
			"token"=>$_SESSION["account"]["token"]
		]);

		if($query->rowCount()) {
			$_SESSION["account"]["token"]=generateAccessToken($_SESSION["account"]["pseudo"]);
			return true;
		} else {
			logoutCustomer($_SESSION["account"]["pseudo"]);
			return false;
		}
	}
	return false;
}

function logoutCustomer($pseudo_customer, $redirect=false) {
	// Supprimer le token de l'utilisateur en bdd
	// On remplace par null
	$db = connectDb();
	$query = $db->prepare("UPDATE customers SET token=null WHERE pseudo_customer=:pseudo_customer");

	$query->execute([
		"pseudo_customer"=>$pseudo_customer
	]);

	// Effacer les variables de session
	unset($_SESSION["account"]);

	if($redirect) {
		header("Location: index.php");
	}
}

function editCustomer() {
  $db = connectDb();

   if(isset($_POST['email']) AND !empty($_POST['email'])) {
      $email_customer = verifyInput($_POST["email"]);
      if (filter_var($email_customer, FILTER_VALIDATE_EMAIL)) {
        $insert_email_customer = $db->prepare("UPDATE customers SET email_customer=:email_customer WHERE pseudo_customer=:pseudo_customer");
        $insert_email_customer->execute([
          "email_customer"=>$email_customer,
          "pseudo_customer"=>$_SESSION["account"]["pseudo"]
        ]);
        $_SESSION["account"]["email"] = $email_customer;
      }
   }

   if(isset($_POST['tel']) AND !empty($_POST['tel'])) {
      $phone_number_customer = verifyInput($_POST["tel"]);
      if ((strlen($_POST["tel"])==0 or (strlen($_POST["tel"])==10 and is_numeric($_POST["tel"])))) {
        $insert_phone_number_customer = $db->prepare("UPDATE customers SET phone_number_customer=:phone_number_customer WHERE pseudo_customer=:pseudo_customer");
        $insert_phone_number_customer->execute([
          "phone_number_customer"=>$phone_number_customer,
          "pseudo_customer"=>$_SESSION["account"]["pseudo"]
        ]);
        $_SESSION["account"]["tel"] = $phone_number_customer;
      }
   }

   if(isset($_POST['password']) AND !empty($_POST['password'])) {
      $password_customer = verifyInput($_POST["password"]);
      if(ctype_alnum($password_customer)) {
        if (strlen($_POST["password"])>8 and strlen($_POST["password"])<20) {
          $password_customer = password_hash($_POST["password"], PASSWORD_DEFAULT);
          $insert_password_customer = $db->prepare("UPDATE customers SET password_customer=:password_customer WHERE pseudo_customer=:pseudo_customer");
          $insert_password_customer->execute([
            "password_customer"=>$password_customer,
            "pseudo_customer"=>$_SESSION["account"]["pseudo"]
          ]);
          $_SESSION["account"]["password"] = $password_customer;
        }
      }
   }
}

function deleteBooking($id_customer, $id_room) {
  $db = connectDb();

  $query = $db->prepare("DELETE FROM BOOKING WHERE id_customer=:id_customer AND id_room=:id_room");

  $query->bindParam(':id_customer', $id_customer);
  $query->bindParam(':id_room', $id_room);

  $query->execute();
 }

/* SEARCH DATA */

function customers_list(){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM CUSTOMERS");
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function customers_data($id_customer){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM CUSTOMERS WHERE id_customer=:id_customer");
    $query->bindParam('id_customer', $id_customer);

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function customers_data_by_email($email){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM CUSTOMERS WHERE email_customer=:email_customer");
    $query->bindParam('email_customer', $email);

    $query->execute();
    $result = $query->fetch();

    return $result;
}

function location_data(){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM LOCATION");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function name_town($id){
    $db = connectDb();

    $query = $db->prepare("SELECT town FROM LOCATION WHERE id_location=:id_location");
    $query->bindParam('id_location', $id);

    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result["town"];
}

/* ADMIN - EQUIPMENTS */
function add_equipment($name_equipment, $reference, $id_location){
    $db = connectDb();

    $query = $db->prepare(" INSERT INTO EQUIPMENT(name_equipment, reference, id_location)
                            VALUES(:name_equipment, :reference, :id_location)");
    $query->bindParam('name_equipment', $name_equipment);
    $query->bindParam('reference', $reference);
    $query->bindParam('id_location', $id_location);

    $query->execute();

    echo '<script>alert("Votre équipement a été ajouté.");</script>';
}

function edit_equipment($id_equipment, $name_equipment, $reference, $id_location){
    $db = connectDb();

    $query = $db->prepare(" UPDATE EQUIPMENT SET
                            name_equipment=:name_equipment,
                            reference=:reference,
                            id_location=:id_location
                            WHERE id_equipment=:id_equipment"
                        );
    $query->bindParam('id_equipment', $id_equipment);
    $query->bindParam('name_equipment', $name_equipment);
    $query->bindParam('reference', $reference);
    $query->bindParam('id_location', $id_location);

    $query->execute();
}

function delete_equipment($id_equipment){
    $db = connectDb();

    $query = $db->prepare(" UPDATE EQUIPMENT SET deleted=1
                            WHERE id_equipment=:id_equipment");
    $query->bindParam('id_equipment', $id_equipment);

    $query->execute();

    echo '<script>alert("L\'équipement sélectionné a été supprimé")</script>';
}

/* SUBSCRIPTION */

function subscription_view($pseudo) {
  $db = connectDb();

  $query = $db->prepare("SELECT id_subscription, begin_subscription, end_subscription FROM CUSTOMERS WHERE pseudo_customer=:pseudo_customer");
  $query->bindParam(':pseudo_customer', $pseudo);

  $query->execute();
  $result = $query->fetch();

  return $result;
}

function subscription_update($pseudo, $id_subscription) {
  $db = connectDb();
  $begin = null;
  $end = null;

  if($id_subscription != 1) {
    $begin = date('Y-m-d');
    $end = date('Y-m-d', time() + 30 * 24 * 60 * 60);
  }
  elseif($id_subscription == 1) {
    $begin = date('Y-m-d');
    $end = null;
  }

  $query = $db->prepare(" UPDATE CUSTOMERS
                          SET id_subscription=:id_subscription,
                          begin_subscription=:begin_subscription,
                          end_subscription=:end_subscription
                          WHERE pseudo_customer=:pseudo_customer");
  $query->bindParam(':id_subscription', $id_subscription);
  $query->bindParam(':begin_subscription', $begin);
  $query->bindParam(':end_subscription', $end);
  $query->bindParam(':pseudo_customer', $pseudo);

  $query->execute();
}

/* SUPPORT */
function support_customer_view($id_customer){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM TICKET WHERE id_customer=:id_customer");
    $query->bindParam(':id_customer', $id_customer);

    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function support_ticket_view($id_ticket){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM TICKET WHERE id_ticket=:id_ticket");
    $query->bindParam('id_ticket', $id_ticket);

    $query->execute();
    $result = $query->fetch();

    return $result;
}

function ticket_support_add($id_customer, $id_equipment, $title, $description){
    $db = connectDb();

    $query = $db->prepare(" INSERT INTO TICKET(subject, description, id_customer, id_equipment)
                            VALUES(:subject, :description, :id_customer, :id_equipment)");
    $query->bindParam('subject', $title);
    $query->bindParam('description', $description);
    $query->bindParam('id_customer', $id_customer);
    $query->bindParam('id_equipment', $id_equipment);

    $query->execute();
}

function support_ticket_locker($id_ticket, $state){
    $db = connectDb();

    $query = $db->prepare("UPDATE TICKET SET state=:state WHERE id_ticket=:id_ticket");
    $query->bindParam('state', $state);
    $query->bindParam('id_ticket', $id_ticket);

    $query->execute();
}


function support_messages_view($id_ticket){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM TICKET_MESSAGE WHERE id_ticket=:id_ticket ORDER BY id_ticket ASC");
    $query->bindParam('id_ticket', $id_ticket);

    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function support_message_send($id_customer, $id_ticket, $message){
    $db = connectDb();

    $query = $db->prepare("INSERT INTO TICKET_MESSAGE(message, id_ticket, id_customer) VALUES(:message, :id_ticket, :id_customer)");
    $query->bindParam('message', $message);
    $query->bindParam('id_ticket', $id_ticket);
    $query->bindParam('id_customer', $id_customer);

    $query->execute();
}

function support_search_category(){
    $db = connectDb();

    $query = $db->prepare("SELECT DISTINCT name_equipment FROM EQUIPMENT");
    $query->execute();

    $result = $query->fetchAll();

    return $result;
}

function support_search_equipment($equipment_name){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM EQUIPMENT WHERE name_equipment=:name_equipment");
    $query->bindParam('name_equipment', $equipment_name);

    $query->execute();

    $result = $query->fetchAll();

    return $result;
}

/* NOTIFICATION */
function subscription_check($id_customer, $delay){
    $db = connectDb();

    $customer = customers_data($id_customer);
    $email = $customer["email_customer"];
    $subscription_end = strtotime($customer["end_subscription"]);
    $now = time();
    echo '<script>console.log("'.$subscription_end.'", "'.$now.'")</script>';

    /* MAIL MESSAGE */
    $title = "Notification de fin d'abonnement";
    $text = "
    Bonjour M. ".$customer["name_customer"].",

    Votre abonnement prend fin le ".date('d-m-Y', $subscription_end).".
    Le renouvellement automatique est toujours actif !

    Cordialement,

    Work'n Share";


    /* SEND CONDITION */
    if( ($subscription_end - $delay*24*60*60) < $now ){
        mail($email, $title, $text);
        echo '<script>console.log("mail envoyé")</script>';
    }else{
        echo '<script>console.log("mail non envoyé")</script>';
    }


    /* BOOLEAN MAIL SEND */

    /* BOOLEAN MAIL NOT SEND */
}



/* BOOK */
function room_data($id_location){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM ROOM WHERE id_location=:id_location ORDER BY type_room ASC");
    $query->bindParam('id_location', $id_location);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function schedule_data($id_location, $date){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM SCHEDULE WHERE id_location=:id_location AND day=:day");
    $query->bindParam('id_location', $id_location);

    /* KNOW THE DATE */
    $day = strtotime($date);
    $day = date('l', $day);
    $day = convert_day_to_fr($day);

    $query->bindParam('day', $day);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function customer_booking_data($id_customer, $date){
    $db = connectDb();

    $query = $db->prepare("SELECT * FROM BOOKING WHERE id_customer=:id_customer AND date_booking=:date_booking");
    $query->bindParam('id_customer', $id_customer);
    $query->bindParam('date_booking', $date);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function convert_day_to_fr($day){
    switch($day){
        case 'Monday':      $day = 'lundi';
                            break;
        case 'Tuesday':     $day = 'mardi';
                            break;
        case 'Wednesday':   $day = 'mercredi';
                            break;
        case 'Thursday':    $day = 'jeudi';
                            break;
        case 'Friday':      $day = 'vendredi';
                            break;
        case 'Saturday':    $day = 'samedi';
                            break;
        case 'Sunday':      $day = 'dimanche';
                            break;
        default:            break;
    }

    return $day;
}

function check_booked($id_room, $date){
    $db = connectDb();

    $query = $db->prepare(" SELECT * FROM BOOKING
                            WHERE id_room=:id_room
                            AND date_booking=:date_booking");
    $query->bindParam('id_room', $id_room);
    $query->bindParam('date_booking', $date);

    $query-> execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function check_book_available($hour, $begin, $end, $check){

    /* CHECK BEGIN SELECTION */
    if($check == "begin_check"){
        if( $hour < $begin || $hour >= $end ){
            return true;
        }
        else{
            return false;
        }
    }
    /* CHECK END SELECTION */
    else if($check == "end_check"){
        if( $hour <= $begin || $hour > $end ){
            return true;
        }
        else{
            return false;
        }
    }
}

function correct_string_to_time($date_selected, $time){
    $time = strtotime($time);
    $time_hour = date('H', $time);
    $time_minute = date('i', $time);
    return $date_selected + $time_hour*60*60 + $time_minute*60;
}

function send_booking($id_customer, $id_room, $date, $begin, $end){

    $customer_books = customer_booking_data($id_customer, $date);
    foreach($customer_books as $book){
        if( strtotime($begin) >= strtotime($book["begin_booking"]) &&
            strtotime($end) <= strtotime($book["end_booking"])
        ){
            echo '<script>alert("Attention ! Vous avez une réservation en cours à cette heure-ci !")</script>';
            header('Location: book.php');
        }
    }

    $db = connectDb();

    $query = $db->prepare(" INSERT INTO BOOKING(id_room, id_customer, date_booking, begin_booking, end_booking)
                            VALUES(:id_room, :id_customer, :date_booking, :begin_booking, :end_booking)");
    $query->bindParam('id_room', $id_room);
    $query->bindParam('id_customer',$id_customer);
    $query->bindParam('date_booking', $date);
    $query->bindParam('begin_booking', $begin);
    $query->bindParam('end_booking', $end);

    $query->execute();

    header('Location: profil.php');
}



