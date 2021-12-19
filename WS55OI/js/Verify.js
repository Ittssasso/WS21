$(document).ready(function(){
       document.getElementById("submit").disabled = true;
              $("#eposta").on("change", function(){
              $.ajax({
                     type: 'post',
                     url: '../php/ClientVerifyEnrollment.php',
                     data: {
                     source1: document.getElementById('eposta').value
                     },
                     success: function( data ) {
                            if(data == 'true'){
                                   document.getElementById("erregistratuta?").innerHTML="WS-n erregistratuta zaude";
                                   document.getElementById("erregistratuta?").style.color = "green";
                                   document.getElementById("submit").disabled = false;
                            } else{
                                   document.getElementById("erregistratuta?").innerHTML="EZ zaude WS-n erregistratuta";
                                   document.getElementById("erregistratuta?").style.color = "red";
                                   document.getElementById("submit").disabled = true;
                            }
                     }
              });       
       });
});