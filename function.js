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

function request(callback, url){
	var xhr = getXMLHttpRequest();

	xhr.onreadystatechange = function(){
		if( xhr.onreadystatechange == 4 && (xhr.status == 200 || xhr.status == 0) ){
			callback(xhr.responseText);
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function readData(sData){
	if(sData == "OK"){
		alert("OK");
	}
	else{
		alert("Not OK");
	}
}
