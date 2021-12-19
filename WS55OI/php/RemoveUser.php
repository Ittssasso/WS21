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

$sql="DELETE FROM signed WHERE eposta='".$_GET['e']."'";
if (!$niresqli->query($sql))
	echo "Ezin izan da ezabatu";

$sql2="SELECT eposta, pasahitza, argazkia, egoera FROM signed";
if (!$niresqli->query($sql2))
	echo "Ez dago inor erregistraturik!";
else{
	echo "<tr><th>EPOSTA</th><th>GAKOA</th><th>EGOERA</th><th>IRUDIA</th><th>Permutatu</th><th>Ezabatu</th></tr>";
	$results = mysqli_query($niresqli,$sql2);
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

