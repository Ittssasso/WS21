<!DOCTYPE html>
<html>
<head>
    <title>Emaila bidali</title>
    <script src="../js/EgiaztatuBezeroanEm.js"></script> <!--Egiaztapena bezeroan.-->
    <?php include '../html/Head.html'?>
</head>

<body>
<?php include 'Menus.php' ?>
<section class="main" id="s1">
    <div style="text-align: left">
        <h4>Nora nahi duzu bidaltzea berreskuratze-kodea pasahitza berrizendatzeko?</h4>
        <form id="sendEmail" name="sendEmail" action="SendEmail.php" method="post" onsubmit="return egiaztatuEm()"> <!--Berreskurapen kodea eskuratzeko bidali behar den emailaren formularioa.-->
           <fieldset>
             <legend>Eposta sartu:</legend>
                <input type="text" id="eposta" name="eposta"> <br>
                <input type="submit" value="Bidali" id="bidaliMez" name="bidaliMez"><br>
            </fieldset>
        </form>
    </div>

<?php
include 'DbConfig.php';
if(isset($_POST["eposta"])){
    session_start();
    try {
        $dsn = "mysql:host=$zerbitzaria;dbname=$db";
        $dbh = new PDO($dsn, $erabiltzailea, $gakoa);
        $stmt = $dbh->prepare("SELECT eposta FROM signed WHERE eposta=?");
        $eposta=$_POST['eposta'];
        $stmt->bindParam(1, $eposta);
        try{
            $stmt->execute();
            $row_count = $stmt->rowCount();
            if($row_count==1){
                $_SESSION['epostaPasahitz']=$_POST['eposta']; //Posta $_SESSION['epostaPasahitz']-n gordetzeko.
                $zenKar = '0123456789abcdefghijklmnopqrstuvwxyz';
                $kodea = substr(str_shuffle($zenKar), 0, 10); //Ausaz berreskurapen kodea sortzeko.
                $_SESSION['kodea']=$kodea; //Kodea $_SESSION['kodea']-n gordetzeko.
                
                //Bidaliko den mezua prestatzeko:

                $to = $_POST['eposta']; //Nora bidali berreskurapen kodea. (Formularion sartu den helbide-elektronikora)
                $subject = "Berreskurapen kodea pasahitza berrezartzeko";
                $message = "Berreskurapen kodea: ".$kodea; //Mezua berreskurapen kodea izango da.
                $headers = "From: igarcia393@ikasle.ehu.eus"."\r\n"; //Nork bidali duen mezua.
                $headers.= "X-Mailer: PHP/". phpversion();
                if(mail($to, $subject, $message, $headers)){ //Mezua ongi bidali bada.
                    echo "<script> alert('Mezua ondo bidali da');window.location='RecoveryCode.php' </script>";
                }else
                    echo "Mezua ez da bidali";
                echo "<p style='color:red;font-size: 35px;'>Errorea mezua bidaltzerakoan, ez zaude erregistratuta.</p>"; 

            }else{
                echo "<p style='color:red;font-size: 35px;'>Ez zaude erregistratuta! Beraz, ezin duzu pasahitzarik berrezartu.</p>";}    
        } catch(Exception $e2){
            echo "Errorea exekutatzerakoan!";
        }
        $dbh = null;
    } catch (PDOException $e){
        echo $e->getMessage();
    }   
}
?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>