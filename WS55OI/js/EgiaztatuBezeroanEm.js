function egiaztatuEm(){
	var eposta = document.getElementById("eposta").value;
    var postaformatua = /^([a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,3})$/;
	var email = /^[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/;
	var email2 = /^[a-zA-Z]+(\.[a-zA-Z]+)?@ehu\.(eus|es)$/;
	if (eposta!=""){
		if( postaformatua.test(eposta) || email.test(eposta) || email2.test(eposta) ){
				return true;
		} else {alert("Korreoaren formatua ez da zuzena."); return false;}
	} else { alert("Derrigorrezko eremuak bete behar dira."); return false;}
}