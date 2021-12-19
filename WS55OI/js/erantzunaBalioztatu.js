var xhr = new XMLHttpRequest();

function erantzunaBalioztatu(zuzena, erantzunda){
	document.getElementById(zuzena).style.backgroundColor = "green";
	gaia = document.getElementById('gaia').innerHTML;
	var emaitza_mezua = document.getElementById("emaitza");
	if(zuzena != erantzunda){
		document.getElementById(erantzunda).style.backgroundColor = "red";
		emaitza_mezua.style.color = "red";
		zuzena = "false";
	} else{
		emaitza_mezua.style.color = "green";
		zuzena = "true";
	}
	$('.erantzunBotoia').prop('disabled', true);
	document.getElementById("next").disabled = false;
	
	xhr.open("POST", "../php/jokoaSessionKudeatu.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
			emaitza_mezua.innerHTML = xhr.responseText;
		}
	}
	xhr.send("zuzen=" + zuzena + "&gaia=" + gaia);
}