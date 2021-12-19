<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
	<?php
	
	include 'DbConfig.php';

	$niresqli = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if($niresqli->connect_errno) {
		die( "Huts egin du konexioak MySQL-ra: (".$niresqli-> connect_errno . ") " .$niresqli-> connect_error );
	}
	
	$sql="INSERT INTO questions(eposta, galdera, erZ, erO1, erO2, erO3, zailtasuna, gaia) VALUES('$_POST[egilea]', '$_POST[galdera]', '$_POST[erantzunZ]', '$_POST[erantzunO1]', '$_POST[erantzunO2]', '$_POST[erantzunO3]', $_POST[zailtasuna], '$_POST[gaia]')";
	
	if (!$niresqli->query($sql)) {
		echo "Errorea galdera txertatzerakoan! Saiatu berriro. " .$niresqli->error;
		echo mysqli_error($niresqli->query($sql));
	}
	else{
		echo "Galdera ondo gehitu da! \r\n";
		echo "<a href='ShowQuestions.php'>Galderak ikusi</a>";
	}
	
	$niresqli->close();
	?>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
