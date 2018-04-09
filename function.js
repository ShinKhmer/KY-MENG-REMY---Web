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
