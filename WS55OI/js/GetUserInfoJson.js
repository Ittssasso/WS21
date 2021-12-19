$(document).ready(function(){
	$("#osatu").click(function(){
		$("#telefonoa").val("");
		$("#izena").val("");
		$("#abizena").val("");
        var eposta = $("#eposta").val();
		if (eposta.length==0){
			alert("Ez duzu epostarik sartu!");
			return false;
		}
		else{
			$.get('../json/Users.json', function(data){
            var i = 0;
			var aurkitugabe = true;
			while (i < data.erabiltzaileak.length && aurkitugabe){
                if(eposta == data.erabiltzaileak[i].eposta){
                    aurkitugabe=false;
                    var tfn=data.erabiltzaileak[i].telefonoa;
                    var izena=data.erabiltzaileak[i].izena;
                    var ab1=data.erabiltzaileak[i].abizena1;
                    var ab2=data.erabiltzaileak[i].abizena2;
                    var abizenak= ab1 + " " + ab2;
                    $("#telefonoa").val(tfn);
                    $("#izena").val(izena);
                    $("#abizena").val(abizenak); 
                }
				i++;
			}
			if(aurkitugabe){
				alert("Ez da eposta hori duen erabiltzailerik aurkitu.");
				return false;
		    }
		    return true;
			});
		}
	});
});

