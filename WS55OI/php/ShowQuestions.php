<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <style type="text/css">
	th{
		background-color: #D5C2F5;
	}
  </style>
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
	
		$sql=$niresqli->query("SELECT * FROM questions");
		
	
		if (!$sql) {
			alert('Errorea galderak bidaltzerakoan! Saiatu berriro.');
		}
		else{
			echo '<table border=2> <tr> <th>ID</th> <th>EPOSTA</th> <th>GALDERA</th> <th>ERANTZUNA</th> <th>OKERRA 1</th> <th>OKERRA 2</th> <th>OKERRA 3</th> <th>ZAILTASUNA</th> <th>GAIA</th> </tr>';
			while($row = $sql->fetch_object()){
				echo '<tr> <td>'.$row->galderaID.'</td> <td>'.$row->eposta.'</td> <td>'.$row->galdera.'</td> <td>'.$row->erZ.'</td> <td>'.$row->erO1.'</td> <td>'.$row->erO2.'</td> <td>'.$row->erO3.'</td> <td>'.$row->zailtasuna.'</td> <td>'.$row->gaia.'</td> </tr>';
			}
			echo '</table>';
		}
	
		$sql->close();
		$niresqli->close();
	?>
	  
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
