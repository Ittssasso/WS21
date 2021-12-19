$(document).ready(function(){
  $("#submit").click(function(){
      var egilea = $("#egilea").val();
      var galdera = $("#galdera").val();
      var erantzunZ = $("#erantzunZ").val();
      var erantzunO1 = $("#erantzunO1").val();
      var erantzunO2 = $("#erantzunO2").val();
      var erantzunO3 = $("#erantzunO3").val();
      var gaia = $("#gaia").val();
      var email = /^[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/;
      var email2 = /^[a-zA-Z]+(\.[a-zA-Z]+)?@ehu\.(eus|es)$/;
      var rb = $("input[type ='radio']:checked");
      if(egilea.length != 0 && galdera.length != 0 && erantzunZ.length != 0 && erantzunO1.length != 0 && erantzunO2.length != 0 && erantzunO3.length !=0 && gaia.length != 0 && rb.length != 0){
        //if (email.test(egilea) || email2.test(egilea)){
          if(galdera.length>=10){
              return true;
           }else {alert("Galdera laburregia da."); return false;}
        //}else {alert("Korreoa ez da zuzenaaaaa."); return false;}
      }else { alert("Derrigorrezko eremuak bete behar dira."); return false;}   
    });
});