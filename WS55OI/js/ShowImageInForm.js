function kargatu(event){
	var i = document.getElementById("irudia");
	if(i!=null){
		if(i.src!=null)
			URL.revokeObjectURL(i.src);
		i.src = URL.createObjectURL(event.target.files[0]);
	}
}

function ezabatu(){
	document.getElementById("irudia").src="";
	document.getElementById("irudi").value=null;
}