function hidestuff(x) {
	x.value="";
}
function checkMe(x, y) {
	if(!y.value) {
		switch(x) {
			case 1: y.value="Teljes név";
					break;
			case 2: y.value="(xx) xxx-xxxx";
					break;
			case 3: y.value="Irányítószám, város";
					break;
			case 4: y.value="Utca, házszám/emelet/ajtó";
					break;
			default:
					break;
		}
	}
}
function showMap() {
	dest = "";
	link = "https://maps.google.com?q=";
	dest += document.getElementById("city").value + " " + document.getElementById("address").value;
	dest = dest.replace(/ /g, "+");
	link += dest;
	window.open(link);
}
function isNumber(evt, x) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	lngth = x.value.length;
	if(lngth==0) {
		x.value += "(";
	}
	else if(lngth==3) {
		x.value += ") ";
	}
	else if(lngth==8) {
		x.value += "-";
	}
	
	return true;
}
function MyRequest(reqID, dataID) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			switch(reqID) {
				case 1: document.getElementById("tbl").innerHTML = xmlhttp.responseText;
						break;
				case 2: var neededData = xmlhttp.responseText.split("||");
						document.getElementById("name").setAttribute("value", neededData[1]);
						document.getElementById("number").setAttribute("value", neededData[2]);
						document.getElementById("bdate").setAttribute("value", neededData[3]);
						document.getElementById("city").setAttribute("value", neededData[4]);
						document.getElementById("address").setAttribute("value", neededData[5]);
						break;
				case 3: document.getElementById("tbl").innerHTML = xmlhttp.responseText;
						document.getElementById("name").value="Teljes név";
						document.getElementById("number").value="(xx) xxx-xxxx";
						document.getElementById("bdate").value="éééé/hh/nn";
						document.getElementById("city").value="Irányítószám, város";
						document.getElementById("address").value="Utca, házszám/emelet/ajtó";
						break;
				case 4: document.getElementById("tbl").innerHTML = xmlhttp.responseText;
						break;
				case 5: document.getElementById("tbl").innerHTML = xmlhttp.responseText;
						break;
				default:
						break;
			}
		}
	}
	switch(reqID) {
		case 1: name = document.getElementById("name").value;
				number = document.getElementById("number").value;
				bdate = document.getElementById("bdate").value;
				bdate = bdate.replace(/\//g, "");
				city = document.getElementById("city").value;
				address = document.getElementById("address").value;
				xmlhttp.open("GET","php/fnctns.php?reqID="+reqID+"&name="+name+"&number="+number+"&bdate="+bdate+"&city="+city+"&address="+address,true);
				xmlhttp.send();
				break;
		case 2: xmlhttp.open("GET","php/getData.php?dataID="+dataID,true);
				xmlhttp.send();
				document.getElementById("btn").innerHTML="Módosít";
				document.getElementById("btn").setAttribute("onclick", "MyRequest(3, "+dataID+");");
				break;
		case 3: name = document.getElementById("name").value;
				number = document.getElementById("number").value;
				bdate = document.getElementById("bdate").value;
				bdate = bdate.replace(/\//g, "");
				city = document.getElementById("city").value;
				address = document.getElementById("address").value;xmlhttp.open("GET","php/fnctns.php?reqID="+reqID+"&dataID="+dataID+"&name="+name+"&number="+number+"&bdate="+bdate+"&city="+city+"&address="+address,true);
				xmlhttp.send();
				document.getElementById("btn").innerHTML="Mentés";
				document.getElementById("btn").setAttribute("onclick", "MyRequest(1, 0);");
				break;
		case 4: xmlhttp.open("GET","php/fnctns.php?reqID="+reqID+"&dataID="+dataID,true);
				xmlhttp.send();
				break;
		case 5: xmlhttp.open("GET","php/fnctns.php?reqID="+reqID,true);
				xmlhttp.send();
				break;
		default:
				break;
	}
}