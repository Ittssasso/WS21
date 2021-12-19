function zenbatErabiltzaileGuztira(){
    $.ajax({
        type: "GET",
        url: '../xml/UserCounter.xml',
        cache: false,
        success: function(data) {
            var zenbat = $(data).find("zenbat");
            var zenbatValue = zenbat[0].childNodes[0].nodeValue;
            $("#user").html(zenbatValue);
        }
    });
}

$(document).ready(function(){
        zenbatErabiltzaileGuztira();
        setInterval(zenbatErabiltzaileGuztira, 10000);
});