<?php
session_start();
$id=session_id();
if(!isset($_SESSION['eposta'])){
    header("location: LogIn.php");
}else if($_SESSION["id"]!=$id){
    header("location: Layout.php");
}else if($_SESSION['erabiltzaile']!='irakasle' && $_SESSION['erabiltzaile']!='ikasle'){
    header("location: Layout.php");
}
include '../html/Head.html';
include '../php/Menus.php';
$xml = simplexml_load_file("../xml/Questions.xml");

echo '<body><section><div>';
echo '<h3 style="color:black"><center> XML galderak </center></h3><br>';
echo '<p><center><table border=2><tr><th>Egilea</th><th>Galdera</th><th>Erantzun zuzena</th><tr>';

foreach ($xml-> assessmentItem as $item){
	$egilea=(string) $item['author'];
	$galdera=$item->itemBody->p;
	$zuzena=$item->correctResponse->response;
	echo "<tr><td> $egilea </td><td> $galdera </td><td>$zuzena </td></tr>";
}

echo '</table></center>';
echo '</div></section></body>';

include '../html/Footer.html' ;
?>