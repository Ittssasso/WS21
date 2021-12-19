<?php
$curl = curl_init();
$url = "https://sw.ikasten.io/~igarcia393/REST/VipUsers/";
//$url = "http://localhost/REST/VipUsers/";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$str = curl_exec($curl);
$emaitzaorokor =explode(":", $str); //10 Vip-ak eskuratzeko. 
$emaitza= explode ("<br>", $emaitzaorokor[1]); //VIP-ak banaka lortzeko.
//Vip bakoitzeko, posta eta puntuazioa aparte lortzeko:
$emaitza1 = explode (",", $emaitza[1]); 
$emaitza2= explode(",", $emaitza[2]);
$emaitza3 = explode (",", $emaitza[3]);
$emaitza4= explode(",", $emaitza[4]);
$emaitza5 = explode (",", $emaitza[5]);
$emaitza6= explode(",", $emaitza[6]);
$emaitza7 = explode (",", $emaitza[7]);
$emaitza8= explode(",", $emaitza[8]);
$emaitza9 = explode (",", $emaitza[9]);
$emaitza10= explode(",", $emaitza[10]);
//Taulan pantailaratu 10 VIP-ak:
echo "<img src='../images/top10.png' alt='TOP 10' width='90' height='90'><br>";
echo "<table border=2 style='margin-left:auto;margin-right:auto;'>
    <tr><th>POSTUA</th><th>EPOSTA</th><th>PUNTUAZIOA</th></tr>
    <tr align='center'>
        <td>1</td>
        <td>$emaitza1[0]</td>
        <td>$emaitza1[1]</td>
    </tr>
    <tr align='center'>
        <td>2</td>
        <td>$emaitza2[0]</td>
        <td>$emaitza2[1]</td>
    </tr>
    <tr align='center'>
        <td>3</td>
        <td>$emaitza3[0]</td>
        <td>$emaitza3[1]</td>
    </tr>
    <tr align='center'>
        <td>4</td>    
        <td>$emaitza4[0]</td>
        <td>$emaitza4[1]</td>
    </tr>
    <tr align='center'>
        <td>5</td>  
        <td>$emaitza5[0]</td>
        <td>$emaitza5[1]</td>
    </tr>
    <tr align='center'>
        <td>6</td>  
        <td>$emaitza6[0]</td>
        <td>$emaitza6[1]</td>
    </tr>
    <tr align='center'>
        <td>7</td>  
        <td>$emaitza7[0]</td>
        <td>$emaitza7[1]</td>
    </tr>
    <tr align='center'>
        <td>8</td>  
        <td>$emaitza8[0]</td>
        <td>$emaitza8[1]</td>
    </tr>
    <tr align='center'>
        <td>9</td>  
        <td>$emaitza9[0]</td>
        <td>$emaitza9[1]</td>
    </tr>
    <tr align='center'>
        <td>10</td>  
        <td>$emaitza10[0]</td>
        <td>$emaitza10[1]</td>
    </tr>
    </table>";
/*$puntuazioa = $emaitza[1];
echo '<table border=2> <tr> th>EPOSTA</th> <th>PUNTUAZIOA</th></tr>';
echo '<tr> <td>'.$posta.'</td> <td>'.$puntuazioa.'</td></tr>';
echo '</table>';*/


?>
