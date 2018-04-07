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
