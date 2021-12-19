<?php
session_start();
$id=session_id();
if(!isset($_SESSION["eposta"]))
	header("location: LogIn.php");
else if($_SESSION["id"]!=$id)
    header("location: Layout.php");
else if ($_SESSION['erabiltzaile']!="admin")
	header("location: Layout.php");
include 'DbConfig.php';
$niresqli = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

if($niresqli->connect_errno) {
	die( "Huts egin du konexioak MySQL-ra: (".$niresqli-> connect_errno . ") " .$niresqli-> connect_error );
}

$select = "SELECT egoera, pasahitza, argazkia FROM signed WHERE eposta='".$_GET['e']."'";
if(!$niresqli->query($select))
	echo "Arazo bat egon da";
else{
	$row=mysqli_fetch_assoc($niresqli->query($select));
	if($row['egoera'] == 'ON'){
		$up = "UPDATE signed SET egoera='OFF' WHERE eposta='".$_GET['e']."'";
		$p = "Blokeatuta";
		$egoera_berria = "OFF";
	}else {
		$up = "UPDATE signed SET egoera='ON' WHERE eposta='".$_GET['e']."'";
		$p = "Aktibo";
		$egoera_berria = "ON";
	}
	if(!$niresqli->query($up))
		echo "Ezin izan da erabiltzailea permutatu.";
	else{
		echo '<tr id="'.$_GET['e'].'"><td>'.$_GET['e'].'</td><td>'.$row['pasahitza'].'</td><td>'.$p.'</td>';
		echo '<td><img width="50px" src="data:image/jpeg;base64,'.base64_encode($row['argazkia']).'"/></td>';
		echo '<td><input type="button" value="'.$egoera_berria.'" onclick="permutatu(\'' . $_GET['e'] . '\')"></td><td><input type="button" value="Ezabatu" onclick="ezabatu(\'' . $_GET['e'] . '\')"></td></tr>';
	}
}
$niresqli->close();
?>