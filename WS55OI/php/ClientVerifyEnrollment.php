<?php
$soapclient = new SoapClient('http://ehusw.es/rosa/webZerbitzuak/egiaztatuMatrikula.php?wsdl');
$emaitza = $soapclient->egiaztatuE($_POST['source1']);
if($emaitza == 'BAI')
    echo 'true';
else
    echo 'false';
?>