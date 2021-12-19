function egiaztatuP(){
	var eposta = document.getElementById("eposta").value;
	var pasahitza = document.getElementById("pasahitza").value;
	var pasahitza2 = document.getElementById("pasahitza2").value;
    var postaformatua = /^([a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,3})$/;
	var email = /^[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/;
	var email2 = /^[a-zA-Z]+(\.[a-zA-Z]+)?@ehu\.(eus|es)$/;
	if (eposta!="" && pasahitza!="" && pasahitza2!=""){
		if( postaformatua.test(eposta) || email.test(eposta) || email2.test(eposta) ){
			if(pasahitza.match(/[a-z]/) && pasahitza.match(/[A-Z]/) && pasahitza.match(/\d/) && pasahitza.match(/\d/)){
				if(pasahitza.length >= 8){
					if(pasahitza == pasahitza2){
						return true;
					}else{alert("Pasahitzak ez dira berdinak."); return false;}
				}else{alert("Pasahitzak gutxienez 8 karaktere izan behar ditu."); return false;}
			}else{alert("Pasahitzaren formatua ez da zuzena."); return false;}
		}else {alert("Korreoaren formatua ez da zuzena."); return false;}
	}else { alert("Derrigorrezko eremuak bete behar dira."); return false;}
}