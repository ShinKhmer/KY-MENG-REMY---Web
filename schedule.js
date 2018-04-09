
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

function display_schedules(){
    var xhr = getXMLHttpRequest();
	var url = "admin_schedules_display.php";
console.log("plop");
	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0) ){
			document.body.getElementsByTagName("section")[0].innerHTML = xhr.responseText;
		}
	}

	xhr.open("GET", url, true);
	xhr.send();
}

function update_date(){
    var xhr = getXMLHttpRequest();
    var url = "admin_schedules_display.php";
    var place = document.getElementById("place_select").value;
   var day = document.getElementById("day_select").value;
   var hour_start = document.getElementById("debut_heure").value;
   var hour_end = document.getElementById("fin_heure").value;
   var min_start = document.getElementById("debut_minute").value;
   var min_end = document.getElementById("fin_minute").value;

   var params= [];
   params.push("place="+ place);
   params.push("day="+ day);
   params.push("1="+ hour_start);
   params.push("2="+ min_start);
   params.push("3="+ hour_end);
   params.push("4="+ min_end);

   var query = params.join('&')
   console.log(xhr.responseText);
  xhr.open("GET","admin_schedules_edit.php?"+ query)
  xhr.send();
}
