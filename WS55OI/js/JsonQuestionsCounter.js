function zenbatGalderaGuztira(){
    var eposta = $("#egilea").val();
    $.ajax({
        type: "GET",
        url: '../json/Questions.json',
        cache: false,
        success: function(data) {
            var i = 0;
            var zenbatNire = 0;
            var zenbatDBJson =0;
            while (i < data.assessmentItems.length){
                if(eposta == data.assessmentItems[i].author){
                    zenbatNire++;
                }
            i++;
            zenbatDBJson++;
            }
            $("#zenbatNireak").html(zenbatNire);
            $("#zenbatDBJson").html(zenbatDBJson);
        }
    });
}

$(document).ready(function(){
        zenbatGalderaGuztira();
        setInterval(zenbatGalderaGuztira, 10000);
});




