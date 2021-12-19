<!DOCTYPE html>
<?php
session_start();
$id=session_id();
if(!isset($_SESSION['eposta'])){
    header("location: LogIn.php");
}else if($_SESSION["id"]!=$id){
    header("location: Layout.php");
}else if($_SESSION['erabiltzaile']!='irakasle'){
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

<?php
$curl = curl_init();
$url = "https://sw.ikasten.io/~igarcia393/REST/VipUsers/";
//$url = "http://localhost/REST/VipUsers/";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$str = curl_exec($curl);
echo $str;

?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>