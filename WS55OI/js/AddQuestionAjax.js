$(document).ready(function(){
    $("#submit").click(function(){
        var formularioa = document.getElementById("galderenF");

        //Lortu url-tik parametroak, zehazki "aux" parametroa, eposta lortzeko
        const urlSearchParams = new URLSearchParams(window.location.search);
        const params = Object.fromEntries(urlSearchParams.entries());
        var emaila = params.aux;
        //URL-a prestatu
        var postDataUrl = "AddQuestionWithImage.php" + "?aux=" + emaila;
        var formData = new FormData(formularioa);
        $.ajax({
            type: "POST",
            url: postDataUrl,
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                data=$(data).find('div#emaitza'); //Hartu AddQuestionWithImage.php-tik div-a.
                $("#zuzen_mezua").html(data); //HandlingQuizesAjax.php-ko <p>-n lortutako data jarri.
            },
            error: function(data) {
                $("#zuzen_mezua").html("Errorea");
            },
        });
        $('#galderenF').trigger("reset");
        document.getElementById("irudia").src="";
    });
});


/* BESTE MODU BAT:
$.post(
    $("#galderenF").prop("action"), //HandlingQuizesAjax.php-ko formularioko action-eko balioa lortu URL-rako.
    formData,
    function(data){
    data=$(data).find('div#emaitza'); //Hartu AddQuestionWithImage.php-tik div-a.
    $("#zuzen_mezua").html(data); //HandlingQuizesAjax.php-ko <p>-n lortutako data jarri.
    }
);
*/