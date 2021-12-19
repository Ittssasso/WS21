$(document).ready(function(){
	$("#osatu").click(function(){
		$("#telefonoa").val("");
		$("#izena").val("");
		$("#abizena").val("");
		sartutakoeposta = $("#ikaslea").val();
		if (sartutakoeposta.length==0){
			alert("Ez duzu epostarik sartu!");
			return false;
		}
		else{
			$.get('../xml/Users.xml', function(datuak){
				var epostenZer = $(datuak).find('eposta');
				var i = 0;
				var aurkitugabe = true;
				while (i < epostenZer.length && aurkitugabe){
					if(epostenZer[i].childNodes[0].nodeValue == $("#ikaslea").val()){
						aurkitugabe=false;
						$("#telefonoa").val(epostenZer[i].parentNode.childNodes[9].childNodes[0].nodeValue);
						$("#izena").val(epostenZer[i].parentNode.childNodes[3].childNodes[0].nodeValue);
						$abizenak = epostenZer[i].parentNode.childNodes[5].childNodes[0].nodeValue + " " + epostenZer[i].parentNode.childNodes[7].childNodes[0].nodeValue;
						$("#abizena").val($abizenak);
					}
					i++;
				}
				if(aurkitugabe){
					alert("Ez da eposta hori duen erabiltzailerik aurkitu. Beste bat sar ezazu.");
					return false;
				}
			
				return true;
			});
		}
	});
});