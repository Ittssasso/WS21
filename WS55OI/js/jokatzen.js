var xhro = new XMLHttpRequest();

function jolastu(){
	var gaia = document.getElementById("gaiak").value;
    xhro.open("GET", "../php/showQuestionPlay.php?gaia="+gaia, true);
	xhro.onreadystatechange=function(){
        if((xhro.readyState)==4){
            var obj=document.getElementById('playDiv');
            obj.innerHTML=xhro.responseText;
        }
    }
    xhro.send();	
}