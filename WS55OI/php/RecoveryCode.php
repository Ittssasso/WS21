<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['epostaPasahitz'])){
    header("location: SendEmail.php");
}
?>
<html>
    
<head>
    <title>Berreskurapen kodea</title>
    <?php include '../html/Head.html'?>
</head>

<body>
<?php include 'Menus.php' ?>
<section class="main" id="s1">
    <div style="text-align: left">
        <form id="recoveryCode" name="recoveryCode" action="RecoveryCode.php" method="post"> <!--Berreskurapen kodearen formularioa-->
             Berreskuratze-kodea: <input type="text" id="Rcode" name="Rcode"> <br>
            <input type="submit" value="Bidali" id="code" name="code"><br>
        </form>
    </div>

<?php
include 'DbConfig.php';
if(isset($_POST["Rcode"])){
    if($_POST["Rcode"]==$_SESSION['kodea']){ //Mezuan bidalitako berreskurapen kodea, erabiltzaileak sartu duen kokde bera baldin bada, pasahitza berrezartzen utzi.
        $_SESSION["kode"]=$_POST["Rcode"];
        header("Location: RestorePassword.php");
    }else{
        echo "<p style='color:red;font-size: 35px;'>Kodea ez da zuzena!</p>";
    }
}
?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>