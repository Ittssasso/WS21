<!DOCTYPE html>
<html>
<head>
    <?php include '../html/Head.html'?>
    <link rel="stylesheet" type="text/css" href="../styles/EstiloPasahitza.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
    <script src="../js/Verify.js"></script>
    <script src="../js/PasahitzaBaliozkoa.js"></script> <!--Pasahitzaren formatua zuzena dela balioztatzeko.-->
    <title>Erregistratu</title>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" style="text-align: left" id="s1">
        <h3>Erregistratu:</h3> <br/>
            <form action="SignUp.php" method="post" id="signUp" name="signUp" enctype="multipart/form-data">
                <label>Erabiltzaile mota(*): </label> 
                <select id="erab_mota" name="erab_mota"><option value="Irakaslea">Irakaslea</option><option value="Ikaslea">Ikaslea</option></select><br/>
                <label>Eposta(*): </label> <input type="text" id="eposta" name="eposta" ><br/>
                <p id="erregistratuta?"></p>
                <label>Deitura(*): </label> <input type="text" id="deitura" name="deitura"><br/>
                <label>Pasahitza(*): </label> <input type="password" id="pasahitza" name="pasahitza"><br/>
                <div id="pasahitzaInfo">
                    <h4>Pasahitzak hurrengo baldintzak bete beharko ditu: </h4>
                        <ul>
                            <li id="lx" class="baliozkoaEz">Gutxienez <strong>letra xehe </strong>bat eduki behar du</li>
                            <li id="ll" class="baliozkoaEz">Gutxienez <strong>letra larri </strong>bat eduki behar du</strong></li>
                            <li id="zenb" class="baliozkoaEz">Gutxienez <strong>zenbaki bat </strong>bat eduki behar du</strong></li>
                            <li id="luz" class="baliozkoaEz">Gutxienez <strong>zortzi letra </strong>eduki behar ditu</li>
                        </ul>
                </div>
                <label>Pasahitza errepikatu(*): </label> <input type="password" id="pasahitza2" name="pasahitza2"><br/>
                <label>Argazkia: </label> <input type="file" id="irudi" name="irudi" accept="image/*" onchange="kargatu(event)"> <br>
			    <img id="irudia" width="100"><br>
			    <input type="button" id="argazkia_ezabatu" value="Argazkia ezabatu" onclick="ezabatu()">
                <input type="submit" id="submit" value="Erregistratu"> <br/><br/>
                <label></label>
            </form>
<?php
include 'DbConfig.php';
if(isset($_POST["eposta"])){
    if(!empty($_POST["eposta"]) && !empty($_POST["deitura"]) && !empty($_POST["pasahitza"]) && !empty($_POST["pasahitza2"])){
        if( ( $_POST["erab_mota"]=='Irakaslea' && preg_match('/^([a-zA-Z]+(\.[a-zA-Z]+)?@ehu\.(eus|es))$/', $_POST["eposta"])) || ($_POST["erab_mota"]=='Ikaslea' && preg_match('/^[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/', $_POST["eposta"])) ){
            if(preg_match('/^([a-zA-Z]{2,}\s)+[a-zA-Z]{2,}$/', $_POST["deitura"])){
                if(preg_match('/[a-z]/', $_POST['pasahitza']) && preg_match('/[A-Z]/', $_POST['pasahitza']) && preg_match('/[0-9]/', $_POST['pasahitza'])){
                    if(strlen($_POST["pasahitza"])>=8){
                        if($_POST["pasahitza"]==$_POST["pasahitza2"]){
                            
                            try {
                                $dsn = "mysql:host=$zerbitzaria;dbname=$db";
                                $dbh = new PDO($dsn, $erabiltzailea, $gakoa);
                                
                                $hi =$_FILES["irudi"]["tmp_name"];
                                if ($hi!=null){
                                    $irud = file_get_contents($_FILES["irudi"]["tmp_name"]);
                                }else
                                    $irud=null;
                                $stmt = $dbh->prepare("INSERT INTO signed (erabiltzaile_mota, eposta, deitura, pasahitza, argazkia, egoera)
                                VALUES(?, ?, ?, ?, ?, ?)");
                                $erab_mota = $_POST['erab_mota'];
                                $eposta = $_POST['eposta'];
                                $deitura = $_POST['deitura'];
                                $pasahitzakripto=crypt($_POST['pasahitza'], 'Oi');
                                $egoera = 'ON';
                                $stmt->bindParam(1, $erab_mota);
                                $stmt->bindParam(2, $eposta);
                                $stmt->bindParam(3, $deitura);
                                $stmt->bindParam(4, $pasahitzakripto);
                                $stmt->bindParam(5, $irud);
                                $stmt->bindParam(6, $egoera);
                                try{
                                    $stmt->execute();
                                } catch(Exception $e2){
                                    echo "Errorea erregistratzerakoan! Agian jada erregistratua zaude. Bestela, saiatu berriro. ";
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
            }else{
                echo "<p style='color:red;font-size: 35px;'>Izena eta lehenengo abizena idatzi behar dituzu.</p>";
            }
        }else{
            echo "<p style='color:red;font-size: 35px;'>Eposta ez da zuzena.</p>";
        }
    }else {
        echo "<p style='color:red;font-size: 35px;'>Derrigorrezko datu guztiak bete behar dira.</p>";   
    }
}
?>
</section>

<?php include '../html/Footer.html' ?>

</body>
</html>




