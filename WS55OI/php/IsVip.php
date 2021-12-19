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
    <div style="text-align: center">
        <form id="isVip" name="isVIP" action="<?php echo 'IsVip.php?'?>" method="post">
           <fieldset>
             <legend align="center">Erabiltzaile bat VIPa den identifikatzeko REST bezeroa:</legend>
                Email*: <input type="text" id="eposta" name="eposta">
                <input type="submit" value="VIPa da?" id="vip" name="vip"><br>
            </fieldset>
        </form>
    </div>
<?php
if(isset($_POST["eposta"])){
  if(!empty($_POST["eposta"])){
    $curl = curl_init();
    $url = "https://sw.ikasten.io/~igarcia393/REST/VipUsers/".$_POST["eposta"];
    //$url = "http://localhost/REST/VipUsers/".$_POST["eposta"];
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $str = curl_exec($curl);
    echo $str;
    curl_close($curl);
  }else 
    echo "Bete hutsuneak";
}
?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>