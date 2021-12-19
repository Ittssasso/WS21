<?php
	include "DbConfig.php";
	$sqlkonexioa = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if($sqlkonexioa->connect_errno) {
		die( "Huts egin du konexioak MySQL-ra: (".$sqlkonexioa-> connect_errno . ") " .$sqlkonexioa-> connect_error );
	}
	if($_POST['action'] == "liked"){
		if($_POST['plus'] == "true") //Galdera gustoko badu, datu-basean balioa eguneratu, 'gogoko' aldagaian +1 eginez.
			$sql = "UPDATE questions SET gogoko = gogoko + 1 WHERE galderaID = '".$_POST['id']."'";
		else
			$sql = "UPDATE questions SET gogoko = gogoko - 1 WHERE galderaID = ".$_POST['id']."";
	}else{
		if($_POST['plus'] == "true") //Galdera gustoko ez badu, datu-basean balioa eguneratu, 'ezGogoko' aldagaian +1 eginez.
			$sql = "UPDATE questions SET ezGogoko = ezGogoko + 1 WHERE galderaID = ".$_POST['id']."";
		else
			$sql = "UPDATE questions SET ezGogoko = ezGogoko + 1 WHERE galderaID = ".$_POST['id']."";
	}
	if (!$sqlkonexioa->query($sql)) {
		echo "<p>Errore bat gertatu da. " .$sqlkonexioa->error. "</p>";
	}
?>