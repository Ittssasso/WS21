function egiaztatu(){
	var egilea = document.getElementById("egilea").value;
	var galdera = document.getElementById("galdera").value;
	var erantzunZ = document.getElementById("erantzunZ").value;
	var erantzunO1 = document.getElementById("erantzunO1").value;
	var erantzunO2 = document.getElementById("erantzunO2").value;
	var erantzunO3 = document.getElementById("erantzunO3").value;
	var gaia = document.getElementById("gaia").value;
	if ( (document.getElementById("zailtasun_txikia").checked || document.getElementById("zailtasun_ertaina").checked || document.getElementById("zailtasun_handia").checked) && egilea!=null && galdera!=null && erantzunZ!=null && erantzunO1!=null && erantzunO2!=null && erantzunO3!=null && gaia!=null){
		//let email = /^[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/;
		//let email2 = /^[a-zA-Z]+(\.[a-zA-Z]+)?@ehu\.(eus|es)$/;
		//if	( email.test(egilea) || email2.test(egilea)){
			if (galdera.length>=10){
				return true;
			} else {alert("Galdera laburregia da."); return false;}
		//} else {alert("Korreoa ez da zuzena."); return false;}
	} else { alert("Derrigorrezko eremuak bete behar dira."); return false;}
}