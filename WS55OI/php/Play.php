<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../js/jokatzen.js"></script>
  <script src="../js/erantzunaBalioztatu.js"></script>
  <script src="../js/like.js"></script>
  <style type="text/css">
	.erantzunBotoia{
		border: 1px solid;
		background-color: white; color: black;
		height: 50px; width: 200px;
	}
	
	.erantzunBotoia:hover{
		background-color:lightblue;
	}
	
	.checked {
		color: orange;
	}
	
	#gogoko:hover, #ezGogoko:hover{
		color: red;
	}
	
  </style>
  <script src="https://kit.fontawesome.com/3681c0e79b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="play">
    <div id="playDiv">
		<form id="jolastera" name="jolastera" action="" method="post"> 
			<h1>Jolastera!</h1><br/>
			<?php
			include "DbConfig.php";
			$sqlkonexioa = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);

			if($sqlkonexioa->connect_errno) {
				die( "Huts egin du konexioak MySQL-ra: (".$sqlkonexioa-> connect_errno . ") " .$sqlkonexioa-> connect_error );
			}
		
			$sql="SELECT DISTINCT(gaia) FROM questions"; //Galderen gaiak eskuratzeko, gai errepikaturik gabe.
			if (!$sqlkonexioa->query($sql)) {
				echo "<p>Errore bat gertatu da. " .$sqlkonexioa->error. "</p>";
			}else{
				$gai_jokatu_gabe = 0;
				echo "<select id='gaiak' name='gaiak'>"; //Gaiak select batetan gordeko dira.
				$gaiak = mysqli_query($sqlkonexioa, $sql);
                while($gaia = mysqli_fetch_assoc($gaiak)){ //Gaiak banaka aztertu.
					$g = $gaia['gaia'];
					
					if (!isset($_SESSION[$g])){ //Gaiaren izen bera duen SESSION aldagai bat ez badago, sortu eta osatu
						$sql2 = "SELECT galderaID FROM questions WHERE gaia = '".$g."' ORDER BY RAND()"; //Gaiaren galderak ausaz lortzeko.
						if (!$sqlkonexioa->query($sql2)) {
							echo "<p>Errore bat gertatu da. " .$sqlkonexioa->error. "</p>";
						}else{
							$array = array();
							$galderakID = mysqli_query($sqlkonexioa, $sql2);
							while($galderaID = mysqli_fetch_array($galderakID)){//Galderen IDak array batean gordetzeko.
								$array[] = $galderaID[0];
							}
							$_SESSION[$g] = $array; //SESSION[$g] aldagaia sortu, $g gaiaren izena izanik. Bertan, galderen ID-ak dituen array-a gorde.
						}
					}
					if(isset($_SESSION[$g]) && count($_SESSION[$g])!=0){ //Gai horren izenarekin aldagaia badago eta honek galderak baditu gaia SELECT-ean jarri
						echo '<option value="'.$g.'">' .$g. '</option>';
						$gai_jokatu_gabe++;
					}
					$zuzenKopAldagai = $g."ZuzenKop"; 
					$okerKopAldagai = $g."OkerKop";
					if(!isset($_SESSION[$zuzenKopAldagai])){
						$_SESSION[$zuzenKopAldagai] = 0; //SESSION[$zuzenKopAldagai] aldagaian, gai horretan asmatutako erantzunen kopurua hasieratu.
					}
					if (!isset($_SESSION[$okerKopAldagai])){
						$_SESSION[$okerKopAldagai] = 0; //SESSION[$okerKopAldagai] aldagaian, gai horretan asmatu ez dituen erantzunen kopurua hasieratu.
					}
				}
				echo "</select>";
				if(!isset($_SESSION['zuzenKop'])){ //Gai guztiak kontuan hartuirk, asmatutako erantzun kopurua hasieratu.
					$_SESSION['zuzenKop'] = 0;
				}
				if (!isset($_SESSION['gaizkiKop'])){ //Gai guztiak kontuan harturik, asmatu ez dituen erantzun kopurua hasieratu.
					$_SESSION['gaizkiKop'] = 0;
				}
				if($gai_jokatu_gabe==0){
					echo "<h3>ZORIONAK! Gai guztien galderak erantzun dituzu!</h3>";
				}else{
					echo '<input type="button" value="HASI" onclick="jolastu()"><br/><br/>';
					echo '<h5>ARGIBIDEAK: <br/> Nahi duzun gaia aukeratu eta gaio horren inguruan hainbat galdera izango dituzu. Galdera bakoitzean lau erantzun posible izango dituzu, baina soilik bat izango da zuzena. Hortaz, erantzun batean klikatzen duzunean berehala jakingo duzu asmatu duzun ala ez. Galderen kolorea zailtasun mailaren araberakoa izango da eta aukera izango duzu galdera hori gustuko duzun ala ez adierazteko nahi izanez gero.</h5><br>';
					echo "<ul class=hg><h5>Zailtasun maila:</h5>
					<div>Txikia: <img src='../images/green.png'></div>
					<div>Ertaina: <img src='../images/orange.png'></div>
					<div>Handia: <img src='../images/red.png'></div>   	
					</ul>";
				}
			}
			$sqlkonexioa->close();
			?>
		</form>
    </div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>
</html>