<html>
<head>
  <title>Score management</title>
  <?php include '../html/Head.html'?>
</head>

<body>
<?php 

include '../php/Menus.php';
session_start();

  if(isset($_SESSION["eposta"])){ //Dagoeneko kautotuta jolastu badu.
    $posta = $_SESSION["eposta"];
  }else if (isset($_POST["vip_korreoa"])){ //Anonimo bezala jolastu badu.
    $posta = $_POST["vip_korreoa"];
  }
  $data = array( //Zein VIP-ari (baldin bada) gehitu puntuazioa.
    'id' => $posta,
    'p' => $_POST["puntuazioa"]
  );
  $fields = (is_array($data)) ? http_build_query($data) : $data;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://sw.ikasten.io/~igarcia393/REST/VipUsers/");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($fields)));
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch);
  echo $output;
  curl_close($ch);
?>
</section>
<?php include '../html/Footer.html' ?>
</body>
</html>