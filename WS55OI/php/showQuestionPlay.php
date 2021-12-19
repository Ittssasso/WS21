<?php
	session_start();
	$id=session_id();
	include "DbConfig.php";
	$sqlkonexioa = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

	if($sqlkonexioa->connect_errno) {
		die( "Huts egin du konexioak MySQL-ra: (".$sqlkonexioa-> connect_errno . ") " .$sqlkonexioa-> connect_error );
	}
	
	echo "<h3 id='gaia'>".$_GET['gaia']."</h3>";
	echo "<input type='hidden' id='gaiak' value='".$_GET['gaia']."'/>";
	echo "<hr/><br/><br/>";
	$galderenIDarray = $_SESSION[$_GET['gaia']];
	if(count($galderenIDarray)==0 ){ 
		echo "<h3>ZORIONAK! \"".$_GET['gaia']."\" GAIKO GALDERA GUZTIAK ERANTZUN DITUZU!</h3><br/>";
		$z = $_GET['gaia']."ZuzenKop";
		$o = $_GET['gaia']."OkerKop";
		echo "<h4>".$_SESSION[$z]." galdera zuzen eta ".$_SESSION[$o]." oker erantzun dituzu gaian!</h4><br/>"; //Zenbat erantzun zuzen eta oker gaika.
		echo "<h4>".$_SESSION['zuzenKop']." galdera zuzen eta ".$_SESSION['gaizkiKop']." oker erantzun dituzu guztira.</h4><br/>"; //Zenbat erantzun zuzen eta oker orokorrean (gai guztiak kontuan hartuz).
		echo '<button onclick="window.location.href=\'Play.php\'"> Gai berri bat aukeratu</button><br/><br/>';
		
		echo '<form action="ScoreManagement.php" method="post">';
		echo '<p>Zure puntuazioa gorde nahi duzu?</p>';
		
		if(!isset($_SESSION['eposta'])){//Anonimoa batek jolastu badu, bere puntuazioa gordetzeko VIP-a izan behar du. Horretarako, bere posta sartu beharko du.
			echo '<p>VIPa bazara sartu zure korreoa!</p>';
			echo '<input type="text" id="vip_korreoa" name="vip_korreoa"/>';
		}
		echo '<input type="submit" id="gorde_puntuazioa" name="gorde_puntuazioa" value="Gorde!"/>';
		echo '<input type="hidden" id="puntuazioa" name="puntuazioa" value="'.$_SESSION[$z].'"/>'; //Puntuazioa bidaltzeko.
		echo '</form>';
		
	}else{
		//Galdera erakusteko: galdera (kolore batekin, zailtasunaren arabera), argakia (baldin badauka) eta lau erantzun posibleak.
		$sql_galdera = "SELECT galdera, erZ, erO1, erO2, erO3, argazkia, zailtasuna, gogoko, ezGogoko FROM questions WHERE galderaID=".$galderenIDarray[0]."";
		if (!$sqlkonexioa->query($sql_galdera)) {
			echo "<p>Errore bat gertatu da. " .$sqlkonexioa->error. "</p>";
		}else{
			$galderak = mysqli_query($sqlkonexioa, $sql_galdera);
			$galdera = mysqli_fetch_assoc($galderak);

			$z = $galdera['zailtasuna'];

			//Galderaren zailtasunaren arabera, zein koloretan agertzeko.
			if($z==1){
				echo "<h3 style='color:green;'>".$galdera['galdera']."</h3>";  
			}
			if($z==2){
				echo "<h3 style='color:orange;'>".$galdera['galdera']."</h3>";  
			}
			if($z==3){
				echo "<h3 style='color:red;'>".$galdera['galdera']."</h3>";  
			}
			echo '<br/><br/>';
			if ($galdera['argazkia']){
				echo '<img width="75px" src="data:image/jpeg;base64,'.base64_encode($galdera['argazkia']).'"/><br/>';
			}
			$erantzunak = array($galdera['erZ'], $galdera['erO1'], $galdera['erO2'], $galdera['erO3']);
			shuffle($erantzunak);
			foreach($erantzunak as $er){
				echo '<button class="erantzunBotoia" id="'.$er.'" value="'.$er.'" onclick="erantzunaBalioztatu(\''.$galdera['erZ'].'\',\''.$er.'\')">'.$er.'</button><br/><br/>';
			}
			
?>
			<button value="next" id="next" onclick="jolastu()" disabled="true">Hurrengo galdera</button>
			<button value="leave" onclick="window.location.href='Play.php'">Utzi jolasteari</button><br/><br/>
				
			<h4 id="emaitza"></h4>
<?php		
			//Galdera gogoko duen ala ez adierazteko botoiak. Bihotza, gogoko duela adierazteko eta bihotz hautsia, ez duela gogoko adierazteko.
			$gogokoKop = $galdera['gogoko'];
			$ezGogokoKop = $galdera['ezGogoko'];
			echo '<span class="fa fa-heart" id="gogoko" name="gogoko" onclick="gogoko(\''.$galderenIDarray[0].'\')"></span><label id="gogokoKop" value="'.$gogokoKop.'"> '.$gogokoKop.' </label>';
			echo '<span class="fa fa-heart-broken" id="ezGogoko" name="ezGogoko" onclick="ezGogoko(\''.$galderenIDarray[0].'\')"></span><label id="ezGogokoKop"> '.$ezGogokoKop.' </label>';

		}
			
		$sqlkonexioa->close();
	}
?>