var xhro = new XMLHttpRequest();

function ezabatu(eposta){
    xhro.open("GET", '../php/RemoveUser.php?e='+eposta, true);
    xhro.onreadystatechange=function(){
        if((xhro.readyState)==4){
            var obj=document.getElementById('taula');
            obj.innerHTML=xhro.responseText;
        }
    }
    xhro.send();
}

function permutatu(eposta){
    xhro.open("GET", '../php/ChangeUserState.php?e='+eposta, true);
    xhro.onreadystatechange=function(){
        if((xhro.readyState)==4){
            var obj=document.getElementById(eposta);
            obj.innerHTML=xhro.responseText;
        }
    }
    xhro.send();
}