var xhro = new XMLHttpRequest();
xhro.onreadystatechange=function(){
    if((xhro.readyState)==4){
        var obj=document.getElementById('ShowQuestions');
        obj.innerHTML=xhro.responseText;
    }
}
function ikusiGalderak(){
    xhro.open("GET", 'ShowJsonQuestionsPart.php', true)
    xhro.send();
}


