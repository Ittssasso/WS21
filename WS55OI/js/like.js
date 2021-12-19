var gogo = false;
var ezGogo = false;
function gogoko(id){ //Galdera gogoko badu.
	var l = document.getElementById("gogoko");
	if(gogo == true){ //Galdera gogoko zuen, baina orain ez du gogoko. Beraz, bihotza gorria kendu egiten da.
		l.style.color = "";
		gogo = false;
		$("#ezGogoko").css("pointer-events", "auto");
		//Like kopuruen testua dektrementatu
		var kop = document.getElementById("gogokoKop").innerText;
		var kopBerria = parseInt(kop, 10) - 1;
		document.getElementById("gogokoKop").innerHTML = " " + kopBerria + " ";
	}else{ //Galdera gogoko duela adierazteko. Ondorioz, bihotz gorria ipini.
		l.style.color = "red";
		gogo = true;
		$("#ezGogoko").css("pointer-events", "none");
		//Gogoko kopuruen testua inkrementatu
		var kop = document.getElementById("gogokoKop").innerText;
		var kopBerria = parseInt(kop, 10) + 1;
		document.getElementById("gogokoKop").innerHTML = " " + kopBerria + " ";
	}
	
	xhr.open("POST", "../php/manageLikes.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("action=liked&plus=" + gogo + "&id=" + id);
	
}
function ezGogoko(id){//Galdera ez du gogoko.
	var l = document.getElementById("gogoko");
	var dl = document.getElementById("ezGogoko");
	if(ezGogo == true){ //Galdera ez zuela gogoko adierazita zuen. Baina orain ez duela gogoko kendu nahi du. Bihotz hautsita gorria kendu.
		dl.style.color = "";
		ezGogo = false;
		$("#gogoko").css("pointer-events", "auto");
		//Disike kopuruen testua dekrementatu
		var kop = document.getElementById("ezGogokoKop").innerText;
		var kopBerria = parseInt(kop, 10) - 1;
		document.getElementById("ezGogokoKop").innerHTML = " " + kopBerria + " ";
	}else{ //Galdera ez duela gogoko adierazteko. Ondorioz, bihotz hautsita gorria ipini. 
		dl.style.color = "red";
		ezGogo = true;
		$("#gogoko").css("pointer-events", "none");
		//Ez gogoko kopuruen testua inkrementatu
		var kop = document.getElementById("ezGogokoKop").innerText;
		var kopBerria = parseInt(kop, 10) + 1;
		document.getElementById("ezGogokoKop").innerHTML = " " + kopBerria + " ";
	}
	
	//Datu-basean gogoko eta ez-gogokoren kopurua gordetzeko.
	xhr.open("POST", "../php/manageLikes.php", true); 
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("action=disliked&plus=" + ezGogo + "&id=" + id);
}