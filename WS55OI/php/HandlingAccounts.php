<!DOCTYPE html>
<?php
session_start();
$id=session_id();
if(!isset($_SESSION["eposta"]))
	header("location: LogIn.php");
else if($_SESSION["id"]!=$id)
    header("location: Layout.php");
else if ($_SESSION['erabiltzaile']!="admin")
	header("location: Layout.php");
?>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="../js/UpdateHandlingAccounts.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
    <div id="erabiltzaileakKudeatu" style="text-align: left">
		<form id="galderenF" name="galderenF" action="" method="post"> 
			<table border="2" style="background-color: bisque" id="taula">
			<tr>
			<th>EPOSTA</th><th>GAKOA</th><th>EGOERA</th><th>IRUDIA</th><th>Permutatu</th><th>Ezabatu</th>
			</tr>
			<?php
				$niresqli = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

				if($niresqli->connect_errno) {
					die( "Huts egin du konexioak MySQL-ra: (".$niresqli-> connect_errno . ") " .$niresqli-> connect_error );
				}
	
				$sql="SELECT eposta, pasahitza, argazkia, egoera FROM signed";
				if (!$niresqli->query($sql))
					echo "Ez dago inor erregistraturik!";
				else{
					$results = mysqli_query($niresqli,$sql);
					foreach($results as $result){
						$e = $result['eposta'];
						if ($e!="admin@ehu.es"){
							$p = "Aktibo";
							if($result['egoera']=="OFF"){
								$p = "Blokeatuta";
							}
							echo '<tr id="'.$e.'"><td>'.$e.'</td><td>'.$result['pasahitza'].'</td><td>'.$p.'</td>';
							echo '<td><img width="50px" src="data:image/jpeg;base64,'.base64_encode($result['argazkia']).'"/></td>';
							echo '<td><input type="button" value="'.$result['egoera'].'" onclick="permutatu(\'' . $e . '\')"></td><td><input type="button" value="Ezabatu" onclick="ezabatu(\'' . $e . '\')"></td></tr>';
						}
					}
				}
				
				$niresqli->close();
			?>
			</table>
		</form> <br>
	</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>