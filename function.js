function getXMLHttpRequest() {
	var xhr = null;

	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest();
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}

	return xhr;
}


function users_table_print(){
	var xhr = getXMLHttpRequest();
	var url = "admin_users_actions.php";

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			document.body.getElementsByTagName("section")[0].innerHTML = xhr.responseText;
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

/* UPGRADE OR DOWNGRADE CUSTOMERS*/
function promote(id, promote){
	var xhr = getXMLHttpRequest();
	var url = "admin_users_actions.php?user=" + id + "&promote=" + promote;

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			users_table_print();
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

/* BLOCK OR UNBLOCK CUSTOMERS */
function block(id, block){
	var xhr = getXMLHttpRequest();
	var url = "admin_users_actions.php?user=" + id + "&block=" + block;

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			users_table_print();
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

/* ADMIN_EQUIPEMENTS FUNCTIONS */
function admin_equipments_print(){
	var xhr = getXMLHttpRequest();
	var url = "admin_equipments_print.php";

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			document.body.getElementsByTagName("section")[0].innerHTML = xhr.responseText;
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function equipment_edit(id_equipment, id_location){
	var name = document.getElementsByName("equipment_name")[id_equipment-1].value;
	var quantity = document.getElementsByName("equipment_quantity")[id_equipment-1].value;
	var xhr = getXMLHttpRequest();
	var url = "admin_equipments_print.php?id=" + id_equipment + "&location=" + id_location + "&name=" + name + "&quantity=" + quantity ;
	console.log(url);

	var name2 = "equipment_pop_up_" + (id_equipment-1);
	console.log(name2);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			admin_equipments_print();
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

/* SEND MAIL */
function send_mail(mail){
	var xhr = getXMLHttpRequest();
	var url = "admin_subscriptions_notify.php";
	var param = "mail=" + mail;
	console.log(url);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			alert("Mail envoyé à " + mail);
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(param);
}

/* SUPPORT */
function support_messages_print(id_ticket){
	var xhr = getXMLHttpRequest();
	var url = "support_messages.php?ticket=" + id_ticket;
	console.log(url);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			document.getElementById("support-js").innerHTML = xhr.responseText;
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function support_message_add(id_customer, id_ticket){
	var xhr = getXMLHttpRequest();
	var message = document.getElementsByName("message")[0].value;

	var url = "support_messages.php";
	var values = "customer=" + id_customer + "&ticket=" + id_ticket + "&message=" + message;

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			console.log("message send");
			support_messages_print(id_ticket);
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(values);
}

function support_view_equipment_list(){
	var xhr = getXMLHttpRequest();

	var value = document.getElementsByName("category")[0].value;
	console.log("value : " + value);

	var url = "support_equipment_list.php?name=" + value;
	console.log("url : " + url);

	console.log("1");
	console.log(document.getElementById("equipment_reference"));

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			console.log("value2 : " + value);
			if(value == "selection"){
				document.getElementById("equipment_reference").innerHTML = "";
			}
			else{
				document.getElementById("equipment_reference").innerHTML = xhr.responseText;
			}
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function support_ticket_add(){
	var xhr = getXMLHttpRequest();

	var equipment_id = document.getElementsByName("equipment_id")[0].value;
	var title = document.getElementsByName("title")[0].value;
	var description = document.getElementsByName("message")[0].value;
	console.log(equipment_id, title, description);

	var url = "support.php";
	var params = "id=" + equipment_id + "&title=" + title + "&description=" + description;
	console.log(url + params);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			alert("Ticket envoyé");
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}


function support_ticket_lock(ticket, change){
	var xhr = getXMLHttpRequest();
	console.log(change);

	if(change == true){
		var url = "support_messages.php?ticket=" + ticket + "&lock=true";
	}
	else{
		var url = "support_messages.php?ticket=" + ticket + "&lock=false";
	}

	console.log(url);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			support_messages_print(ticket);
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}
