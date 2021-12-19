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
$data=file_get_contents("../json/Questions.json");
$array=json_decode($data);
echo '<h3 style="color:black"><center> JSON fitxategiko edukia </center></h3><br>';
echo '<p><center><table border=2><tr><th>Egilea</th><th>Galdera</th><th>Erantzun zuzena</th><tr>';
foreach($array->assessmentItems as $galderak){
    $egilea=$galderak->author;
    $galdera = $galderak->itemBody->p;
    $erantzunZ = $galderak->correctResponse->response;
    echo '<tr><td>' . $egilea . '</td><td>' . $galdera . '</td><td>' . $erantzunZ . '</td></tr>';
}
echo '</table></center>';
?>