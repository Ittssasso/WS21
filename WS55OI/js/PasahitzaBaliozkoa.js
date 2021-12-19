$(document).ready(function() {
$("#pasahitza").keyup(function() {
    var pasahitza = document.getElementById("pasahitza").value;
    //pasahitzak gutxienez 8ko luzeera dauka.
    if ( pasahitza.length < 8 ) {
        $('#luz').removeClass('baliozkoa').addClass('baliozkoaEz');
    } else {
        $('#luz').removeClass('baliozkoaEz').addClass('baliozkoa');
    }

    //pasahitzak letra xehe bat dauka gutxienez.
    if ( pasahitza.match(/[A-z]/) ) {
        $('#lx').removeClass('baliozkoaEz').addClass('baliozkoa');
    } else {
        $('#lx').removeClass('baliozkoa').addClass('baliozkoaEz');
    }

    //pasahitzak letra larri bat dauka gutxienez.
    if ( pasahitza.match(/[A-Z]/) ) {
        $('#ll').removeClass('baliozkoaEz').addClass('baliozkoa');
    } else {
        $('#ll').removeClass('baliozkoa').addClass('baliozkoaEz');
    }

    //pasahitzak zenbaki bat dauka gutxinez.
    if ( pasahitza.match(/\d/) ) {
        $('#zenb').removeClass('baliozkoaEz').addClass('baliozkoa');
    } else {
        $('#zenb').removeClass('baliozkoa').addClass('baliozkoaEz');
    }

}).focus(function() {
    $('#pasahitzaInfo').show();
}).blur(function() {
    $('#pasahitzaInfo').hide();
});

});