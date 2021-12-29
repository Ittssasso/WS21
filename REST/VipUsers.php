<?php
// Datuak eskuratzeko konstanteak ...
DEFINE("_HOST_", "localhost");
DEFINE("_PORT_", "80");
DEFINE("_USERNAME_", "igarcia393");
DEFINE("_DATABASE_", "db_igarcia393");
DEFINE("_PASSWORD_", "owM5MTYpNmchdWa");

require_once 'database.php';
$method = $_SERVER['REQUEST_METHOD'];
$resource = $_SERVER['REQUEST_URI'];

    $cnx = Database::Konektatu();
    switch ($method) {

        case 'GET':
           	if(isset($_GET['id'])){
                $datuak = "";
                $id = $_GET['id'];
			    $sql = "SELECT * FROM vip WHERE eposta='$id'";
                echo $sql .' kontsulta exekutatzen dut <p>';
                $datuak = Database::GauzatuKontsulta($cnx, $sql);
			    if (isset($datuak[0])){
                    echo "<br><br><b>Zorionak ".$id." VIPa da </b><br><img src=../images/ok.jpg>";
                    break;
                }else {
                    echo "<br><br><b>Sentitzen dut ".$id." Ez da VIPa</b><br><img src=../images/nook.jpg>";
			        break;}
			}else{
                $sql = "SELECT * FROM vip ORDER BY puntuazioa DESC";
                echo $sql .' kontsulta exekutatzen dut <p>';
                $datuak = Database::GauzatuKontsulta($cnx, $sql);
                if (isset($datuak[0])){
                    echo "<br><br><b>Uneko VIPak zerrendatzeko REST bezeroa: </b><br>";
                    $array = explode(" ", $datuak, 1);
                    foreach($array as $d)
                    echo $d."<br/>";
                    break;
                }else {
                    echo "<br><b>Sentitzen dut, momentuz ez dago VIP zerrendarik </b><br>";
                    break;}
            }

        case 'POST':
            $datuak = "";
            $id = $_POST['id'];
            $p= $_POST['p'];
            $sql = "INSERT INTO vip (eposta, puntuazioa) VALUES ('$id', '$p')"; 
            echo $sql .' kontsulta exekutatzen dut <p>';
            $datuak = Database::GauzatuEzKontsulta($cnx,$sql);
            if($datuak==1){
                echo "<br><br><b>VIPa sortua: ".$id."</b><br><img src=../images/ok.jpg>";
                break;
            }else {
                echo "<br><br><b>Sentitzen dut, VIP da dagoeneko ".$id."</b><br><img src=../images/nook.jpg>";
                break;
            }

        case 'PUT':
            parse_str(file_get_contents('php://input'), $data);
            $id=$data["id"];
            $p=$data["p"];
            $sql = "UPDATE vip SET puntuazioa=puntuazioa+'$p' WHERE eposta='$id'"; //Puntuazioa eguneratzeko kontsulta.
            $result = Database::GauzatuEzKontsulta($cnx, $sql);
            if ($result==0){
                echo '<script>alert("Ez zara VIPa! Beraz, zure puntuazioa ez da gordeko");</script>';
                echo "<script> window.location='Layout.php' </script>"; 
            }else {
                echo '<script>alert("VIP zara eta puntuazioa ondo gehitu da!");</script>';  
                echo "<script> window.location='Layout.php' </script>"; 
            }
            break;

        case 'DELETE':
            $datuak = "";
            $id = $_REQUEST['id'];
            $sql = "DELETE FROM vip WHERE eposta='$id'";
            $datuak = Database::GauzatuEzKontsulta($cnx, $sql);
            if($datuak==1){
                echo "<br><br><b>".$id." VIPa ongi ezabatu da. </b><br><img src=../images/ok.jpg>";
                break;
            }else {
                echo "<br><br><b>Sentitzen dut, ez dago hurrengo helbide elektronikorik  ".$id." ezabatzeko.</b><br><img src=../images/nook.jpg>";
                break;}
	}
    Database::Deskonektatu($cnx);
	
?>

