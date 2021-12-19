<!DOCTYPE html>
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
?>
<html>
<head>
  <?php include '../html/Head.html'?>
  
</head>
<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
	<div>
	<?php
		if (isset($_POST["zailtasuna"])){
			if(!empty( $_POST["egilea"]) && !empty($_POST["galdera"]) && !empty($_POST["erantzunZ"]) && !empty($_POST["erantzunO1"]) && !empty($_POST["erantzunO2"]) && !empty($_POST["erantzunO3"]) && !empty($_POST["gaia"])){
				if(!ctype_space( $_POST["egilea"]) && !ctype_space($_POST["galdera"]) && !ctype_space($_POST["erantzunZ"]) && !ctype_space($_POST["erantzunO1"]) && !ctype_space($_POST["erantzunO2"]) && !ctype_space($_POST["erantzunO3"]) && !ctype_space($_POST["gaia"])){
					if(strlen($_POST["galdera"])>10){
						include 'DbConfig.php';
						$niresqli = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
						
						if($niresqli->connect_errno) {
							die( "Huts egin du konexioak MySQL-ra: (".$niresqli-> connect_errno . ") " .$niresqli-> connect_error );
						}
						
						if ($_FILES["irudi"]["tmp_name"]!=null)
							$irud = mysqli_real_escape_string($niresqli, file_get_contents($_FILES["irudi"]["tmp_name"]));
						else
						$irud=null;
						$agindua="INSERT INTO questions(eposta, galdera, erZ, erO1, erO2, erO3, zailtasuna, gaia, argazkia) VALUES('$_POST[egilea]', '$_POST[galdera]', '$_POST[erantzunZ]', '$_POST[erantzunO1]', '$_POST[erantzunO2]', '$_POST[erantzunO3]', '$_POST[zailtasuna]', '$_POST[gaia]', '$irud')";
						
						echo "<div class='emaitza' id='emaitza'> ";
						if (!$niresqli->query($agindua)) {
							echo "Errorea galdera txertatzerakoan! Saiatu berriro. " .$niresqli->error;
							echo mysqli_error($niresqli->query($agindua));
						}
						else{
							echo "Galdera ondo gehitu da! \r\n";
							echo "<a href='ShowQuestionsWithImage.php?'>Galderak ikusi</a><br>";
							
						}
						
						//XML
						try{
							if (file_exists('../xml/Questions.xml'))
								$xml=simplexml_load_file('../xml/Questions.xml');
							else
								throw new Exception("Ezin da galdera gorde");

							$assessmentItem=$xml->addChild('assessmentItem');
							$assessmentItem->addAttribute('author', $_POST['egilea']); 
							$assessmentItem->addAttribute('subject', $_POST['gaia']);

							$itemBody=$assessmentItem->addChild('itemBody');
							$itemBody->addChild('p', $_POST['galdera']);

							$correctResponse=$assessmentItem->addChild('correctResponse');
							$correctResponse->addChild('response', $_POST['erantzunZ']);

							$incorrectResponses=$assessmentItem->addChild('incorrectResponses');
							$incorrectResponses->addChild('response', $_POST['erantzunO1']);
							$incorrectResponses->addChild('response', $_POST['erantzunO2']);
							$incorrectResponses->addChild('response', $_POST['erantzunO3']);
							echo '<br>Galdera bat XML fitxategian gehitu da.<br>';
							
							$domxml = new DOMDocument('1.0');
							$domxml->preserveWhiteSpace = false;
							$domxml->formatOutput = true;
							$domxml->loadXML($xml->asXML());
							$domxml->save('../xml/Questions.xml'); 
						} catch(Exception $e){
							echo '<br>Errore bat gertatu da galdera XML-n txertatzean<br>';
						}
						
						//JSON
						
						try{
							if (file_exists("../json/Questions.json"))
								$data=file_get_contents("../json/Questions.json");
							else
								throw new Exception("Ezin da galdera gorde");	
							$array=json_decode($data);
							$galderaN=new stdClass();
							$galderaN->subject=$_POST['gaia'];
							$galderaN->author=$_POST['egilea'];
							$galdera=new stdClass();
							$galdera->p=$_POST['galdera'];
							$erantzunZ=new stdClass();
							$erantzunZ->response=$_POST['erantzunZ'];
							$erantzunO=new stdClass();
							$lista=[$_POST['erantzunO1'], $_POST['erantzunO2'], $_POST['erantzunO3']];
							$erantzunO->response=$lista;
							$galderaN->itemBody=$galdera;
							$galderaN->correctResponse=$erantzunZ;
							$galderaN->incorrectResponse=$erantzunO;
							$galderaarray[0]=$galderaN;
							array_push($array->assessmentItems, $galderaarray[0]);
							$jsonData = json_encode($array, JSON_PRETTY_PRINT);
							/*$jsonData = str_replace('{', '{'.PHP_EOL, $jsonData);
							$jsonData = str_replace(',', ','.PHP_EOL, $jsonData);
							$jsonData = str_replace('}', PHP_EOL.'}', $jsonData);*/
							file_put_contents("../json/Questions.json",$jsonData);
							echo '<br>Galdera bat JSON fitxategian gehitu da.<br>';
						}catch(Exception $e){
							echo '<br>Errore bat gertatu da galdera JSON-n txertatzean<br>';
						}
						echo "</div>";
						
						$niresqli->close();
					}else echo "Galdera laburregia da.";
				} else echo "Ezin dira hutsuneak ipini.";
			} else echo "Derrigorrezko eremuak bete behar dira";
		} else echo "Zailtasuna klikatu behar duzu.";
	?>
    </div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>
</html>