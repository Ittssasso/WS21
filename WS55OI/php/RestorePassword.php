<!DOCTYPE html>
<?php 
session_start(); 
if(!isset($_SESSION['epostaPasahitz'])){
    header("location: SendEmail.php");
}
if(!isset($_SESSION['kode'])){
    header("location: RecoveryCode.php");
}
?>
<html>
<head>
    <title>Pasahitza berrezartu</title>
    <link rel="stylesheet" type="text/css" href="../styles/EstiloPasahitza.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/EgiaztatuBezeroanP.js"></script> <!--Egiaztapena bezeroan.-->
    <script src="../js/PasahitzaBaliozkoa.js"></script> <!--Pasahitzaren formatua zuzena dela balioztatzeko.-->
    <?php include '../html/Head.html'?>
</head>

<body>
<?php include 'Menus.php' ?>
<section class="main" id="s1">
    <div style="text-align: left">
        <form id="restorePassword" name="restorePassword" action="RestorePassword.php" method="post" onsubmit="return egiaztatuP()"> <!--Pasahitza berrezartzeko formularioa.  Egiaztapena bezeroan eta zerbitzarian egiten da.-->
            Eposta: <input type="text" id="eposta" name="eposta" value="<?php echo $_SESSION['epostaPasahitz']; ?>" readonly="readonly"> <br>
            Pasahitza: <input type="password" id="pasahitza" name="pasahitza"><br>
            <div id="pasahitzaInfo">
                    <h4>Pasahitzak hurrengo baldintzak bete beharko ditu: </h4>
                        <ul>
                            <li id="lx" class="baliozkoaEz">Gutxienez <strong>letra xehe </strong>bat eduki behar du</li>
                            <li id="ll" class="baliozkoaEz">Gutxienez <strong>letra larri </strong>bat eduki behar du</strong></li>
                            <li id="zenb" class="baliozkoaEz">Gutxienez <strong>zenbaki bat </strong>bat eduki behar du</strong></li>
                            <li id="luz" class="baliozkoaEz">Gutxienez <strong>zortzi letra </strong>eduki behar ditu</li>
                        </ul>
                </div>
            Pasahitza errepikatu: <input type="password" id="pasahitza2" name="pasahitza2"><br/>
            <input type="submit" value="Pasahitza berrezartu" id="pass" name="pass"><br>
        </form>
    </div>

<?php //Egiaztapena zerbitzarian.
include 'DbConfig.php';
if(isset($_POST['eposta'])){
    if(!empty($_POST["pasahitza"]) && !empty($_POST["pasahitza2"])){
        if(preg_match('/[a-z]/', $_POST['pasahitza']) && preg_match('/[A-Z]/', $_POST['pasahitza']) && preg_match('/[0-9]/', $_POST['pasahitza'])){
            if(strlen($_POST["pasahitza"])>=8){
                if($_POST["pasahitza"]==$_POST["pasahitza2"]){
                    try {
                        $dsn = "mysql:host=$zerbitzaria;dbname=$db";
                        $dbh = new PDO($dsn, $erabiltzailea, $gakoa);
                        $stmt = $dbh->prepare("UPDATE signed SET pasahitza=? WHERE eposta=?");
                        $eposta=$_SESSION['epostaPasahitz'];
                        $pasahitzakripto=crypt($_POST['pasahitza'], 'Oi');
                        $stmt->bindParam(1, $pasahitzakripto); 
                        $stmt->bindParam(2, $eposta); 
                        try{
                            $stmt->execute();
                            $row_count = $stmt->rowCount();
                            if($row_count==0){
                                echo "<p style='color:red;font-size: 35px;'>Errorea pasahitza aldatzerakoan! Berriro sahiatu.</p>";        
                            }else{
                                echo "<p style='color:red;font-size: 35px;'>Pasahitza ongi berrezartu da!</p>"; 
                            }       
                        } catch(Exception $e2){
                            echo "Errorea exekutatzerakoan!";
                        }
                        $dbh = null;
                    } catch (PDOException $e){
                        echo $e->getMessage();
                    }
                }else{
                    echo "<p style='color:red;font-size: 35px;'>Pasahitzak ez dira berdinak.</p>";
                }
            }else{
                echo "<p style='color:red;font-size: 35px;'>Pasahitzak gutxienez 8 karaktere izan behar ditu.</p>";
            }
        }else{
            echo "<p style='color:red;font-size: 35px;'>Pasahitzaren formatua ez da zuzena.</p>";
        }
    }else {
        echo "<p style='color:red;font-size: 35px;'>Derrigorrezko eremu guztiak bete behar dira.</p>";   
    }
}
?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>  