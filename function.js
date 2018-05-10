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

function admin_equipment_add(){
	var location = document.getElementsByName("equipment_location_add")[0].value;
	var name = document.getElementsByName("equipment_name_add")[0].value;
	var reference = document.getElementsByName("equipment_reference_add")[0].value;

	var xhr = getXMLHttpRequest();
	var url = "admin_equipments_print.php?add=true&location=" + location + "&name=" + name + "&reference=" + reference ;
	console.log(url);


	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			admin_equipments_print();
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function admin_equipment_edit(id_equipment, id_location, index){
	var name = document.getElementsByName("equipment_name")[index].value;
	var reference = document.getElementsByName("equipment_reference")[index].value;
	var xhr = getXMLHttpRequest();
	var url = "admin_equipments_print.php?edit=true&id=" + id_equipment + "&location=" + id_location + "&name=" + name + "&reference=" + reference ;
	console.log(url);


	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			admin_equipments_print();
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function admin_equipment_delete(id_equipment){
	var xhr = getXMLHttpRequest();
	var url = "admin_equipments_print.php?delete=true&id=" + id_equipment;
	console.log(url);

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
			$("#add_message").modal("hide");
			support_messages_print(id_ticket);
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(values);
}

function support_view_equipment_list(){
	var xhr = getXMLHttpRequest();

	var value = document.getElementsByName("select_equipment")[0].value;

	var url = "support_equipment_list.php?name=" + value;

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			console.log("Equipement : " + value);
			if(value == "default_equipment"){
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

	//if(document.getElementsByName("select_equipment")[0].value != "")
		var select_reference = document.getElementsByName("select_reference")[0].value;
	var title = document.getElementsByName("title")[0].value;
	var description = document.getElementsByName("message")[0].value;
	console.log("select_reference:" + select_reference);

	var url = "support.php";
	var params = "id=" + select_reference + "&title=" + title + "&description=" + description;
	console.log(url + params);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			if(select_reference != "" && title.length > 0 && description.length > 0) {
                $("#add_ticket").modal('hide');
                document.location.replace("support.php");
            }
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}


function support_ticket_lock(ticket){
	var xhr = getXMLHttpRequest();

	var url = "support_messages.php?ticket=" + ticket + "&lock=true";

	console.log(url, ticket);

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			support_messages_print(ticket);
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}


/* BOOKING */
function book_print_room(date_now){
	var xhr = getXMLHttpRequest();

	var id_location = document.getElementsByName("place_select")[0].value;
	console.log(id_location);

	var url = "book_print_room.php";
	var param = "location=" + id_location;

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			document.getElementById("print_room").innerHTML = xhr.responseText;
			book_print_date(date_now);
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(param);
}

/*function book_check_display(date_now){
	var select = document.getElementsByName("room_select")[0].value;
	if(select == "room_default"){
		document.getElementById("print_date").setAttribute("style", "display:none");
		document.getElementsByName("date_select")[0].value = date_now;
		document.getElementById("print_day").setAttribute("style", "display:none");
		document.getElementById("print_day_next").setAttribute("style", "display:none");
	}
	else{
        document.getElementById("print_date").setAttribute("style", "display:block");
	}
}*/

function book_print_date(date_now){
	var location_select = document.getElementsByName("place_select")[0].value;
	var room_select = document.getElementsByName("room_select")[0].value;

	console.log("location selected : " + location_select);
	console.log("room selected : " + room_select);

	/* SET DEFAULT DATE IF NULL*/
	if(document.getElementsByName("date_select")[0].value.length == 0) {
        document.getElementsByName("date_select")[0].value = date_now;
    }


	if(room_select == 'room_default'){
		document.getElementById("print_date").setAttribute("style", "display:none");;
		document.getElementById("print_day").setAttribute("style", "display:none");
		document.getElementById("print_day_next").setAttribute("style", "display:none");
	}
	else{
		document.getElementById("print_date").setAttribute("style", "display:block");
		book_print_day();
	}
}

/* PRINT THE SELECT DIV FOR THE BEGIN BOOK */
function book_print_day(){

	var xhr = getXMLHttpRequest();

	var id_location = document.getElementsByName("place_select")[0].value;
	var id_room = document.getElementsByName("room_select")[0].value;
	var date = document.getElementsByName("date_select")[0].value;

    /* CHECK IF PRINT REMINDER THAT THERE IS ALREADY A BOOK IN THE CURRENT DAY*/
    book_reminder(id_location, date);

	var url = "book_print_day.php";
	var param = "location=" + id_location + "&room=" + id_room + "&date=" + date;

	/* PRINT DIV WITH ID print_day AND SET TO DEFAULT THE SELECT VALUE */
	document.getElementById("print_day").setAttribute("style", "display:block");
	document.getElementsByName("begin_select").value = "begin_default";
	/* HIDE DIV WITH ID print_day_next */
	document.getElementById("print_day_next").setAttribute("style", "display:none");

	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			document.getElementById("print_day").innerHTML = xhr.responseText;
		}
	}

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(param);
}

/* PRINT THE SELECT DIV FOR THE END BOOK */
function book_print_day_next(location, room, date){

    var begin = document.getElementsByName("begin_select")[0].value;

	console.log(begin);

    var xhr = getXMLHttpRequest();
    var url = "book_print_day_next.php";
    var param = "begin=" + begin + "&location=" + location + "&room=" + room + "&date=" + date;

	/* PRINT DIV WITH ID print_day_next */
	document.getElementById("print_day_next").setAttribute("style", "display:block");

	console.log(url, param);
    xhr.onreadystatechange = function(){
        if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){

            document.getElementById("print_day_next").innerHTML = xhr.responseText;
        }
    }

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

function book_reminder(location, date_chosen){
    var xhr = getXMLHttpRequest();

    var url = "book_print_reminder.php";
    var param = "location=" + location + "&date=" + date_chosen;

    xhr.onreadystatechange = function(){
        if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
        	document.getElementById("print_reminder").setAttribute("style", "display:block");
            document.getElementById("print_reminder").innerHTML = xhr.responseText;
        }
    }

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

function send_booking(){

    /* CHECK DATE SELECTED */
    var date_selected = document.getElementsByName("date_select")[0].value;
    console.log("date sélectionnée : " + date_selected);

    var day_selected = new Date(date_selected);
    var day_s = day_selected.getDate();
    var month_s = day_selected.getMonth();
    var year_s = day_selected.getFullYear();

    var now = new Date(Date.now());
    var day_n = now.getDate();
    var month_n = now.getMonth();
    var year_n = now.getFullYear();

    console.log(day_selected, now);
    console.log("day : " + day_s + " month : " + month_s + " year : " + year_s);

    if(day_s < day_n && month_s <= month_n && year_s <= year_n){
        alert("Attention, veuillez sélectionner une date valide !");
        return;
    }


	var xhr = getXMLHttpRequest();

	var id_room = document.getElementsByName("room_select")[0].value;
	var date = document.getElementsByName("date_select")[0].value;
	var begin = document.getElementsByName("begin_select")[0].value;
	var end = document.getElementsByName("end_select")[0].value;
	console.log(id_room, date, begin, end);

	var url="book.php"
	var param = "room=" + id_room + "&date=" + date + "&begin=" + begin + "&end=" + end;
	console.log(id_room, date, begin, end);
	xhr.onreadystatechange = function(){
        if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			alert("Réservation envoyée");
        }
    }

	xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(param);
}

function stat(){
	var interval = setInterval(function(){
		var xhr = getXMLHttpRequest();
		var url = "stat.php"
		xhr.onreadystatechange = function(){
			if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
				document.getElementById('current_in').innerHTML=xhr.responseText;
			}
		}

		xhr.open("GET", url, true);
		xhr.send();

	},5000);
}
