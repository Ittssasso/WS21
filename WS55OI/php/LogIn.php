<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>

<body>
<?php include '../php/Menus.php' ?>
<section class="main" id="s1">
    <div style="text-align: left">
        <form id="logIn" name="logIn" action="LogIn.php" method="post">
           <fieldset>
             <legend>Login:</legend>
                Eposta: <input type="text" id="eposta" name="eposta"> <br>
                Pasahitza: <input type="password" id="pasahitz" name="pasahitz"><br>
				<a href="SendEmail.php">Pasahitza ahaztu duzu?</a><br>
                <input type="submit" value="Saioa hasi" id="logIn" name="logIn"><br>
            </fieldset>
        </form>
    </div>

<?php
require_once '../php/configGoogle.php';
$login= "<a href='".$client->createAuthUrl()."'><img src='../images/btng.png'</a>";
echo '<div align="left">' . $login .'</div>';
?> 
<?php
include 'DbConfig.php';
if(isset($_POST["eposta"])){
	if(!empty($_POST["eposta"]) && !empty($_POST["pasahitz"])){

		//$niresqli = new mysqli($zerbitzaria, $erabiltzailea, $gakoa, $db);
		try{
			$dsn = "mysql:host=$zerbitzaria;dbname=$db";
			$niresqli = new PDO ($dsn, $erabiltzailea, $gakoa);

			//$sql="SELECT eposta, pasahitza, argazkia, erabiltzaile_mota, egoera FROM signed WHERE eposta='$_POST[eposta]' and pasahitza='$pasahitzakripto' ";
			$stmt = $niresqli->prepare("SELECT eposta, pasahitza, argazkia, erabiltzaile_mota, egoera FROM signed WHERE eposta = ? AND pasahitza = ?");
		
			$eposta=$_POST['eposta'];
			$pasahitzakripto=crypt($_POST['pasahitz'], 'Oi');
			$stmt->bindParam(1, $eposta);
			$stmt->bindParam(2, $pasahitzakripto);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			try{
				$stmt->execute();
				$row_count = $stmt->rowCount();
				if($row_count==1){
					$row = $stmt->fetch();
					if($row['egoera']=="ON"){
						include 'IncreaseGlobalCounter.php';
						session_start();
						$_SESSION["id"]= session_id();
						$_SESSION["eposta"] = $row['eposta'];
						if ($row['argazkia']!=null)
							$_SESSION["argazkia"]=$row['argazkia'];
						if($row['eposta']=="admin@ehu.es"){
							$_SESSION['erabiltzaile']="admin";
							header ("Location: HandlingAccounts.php");
						}
						else if ($row['erabiltzaile_mota']=="Irakaslea"){
							$_SESSION['erabiltzaile']="irakasle";
							header ("Location: Layout.php");
						}
						else if($row['erabiltzaile_mota']=="Ikaslea"){
							$_SESSION['erabiltzaile']="ikasle";
							header ("Location: HandlingQuizesAjax.php");
						}
					} else echo "<p style='color:red;font-size: 35px;'>Arazoak kautotzean!</p>";
				}else{
					echo '<script>alert("Arazoak kautotzean! Berriro saiatu.");</script>';  
				}
			}catch (PDOException $e1){
				echo $e1->getMessage();
			}
		}catch (PDOException $e){
			echo $e->getMessage();
		}
		$niresqli = null;
	}else   echo '<script>alert("Derrigorrezko eremuak bete behar dira!");</script>';   
}
?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>


