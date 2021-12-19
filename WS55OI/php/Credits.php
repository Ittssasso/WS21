<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
  <?php include '../html/Head.html'?>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <style>
   #map { 
		width: 800px;
		height: 140px; }
   </style>

</head>
<body>
<?php include '../php/Menus.php' ?>
  <section class="main" id="s1" style="text-align:center">
    <div>
      <h2>EGILEAREN/EN DATUAK</h2>
	  <p><strong>Itsaso García eta Oihane Zaldua</strong></p>
	  <p>Software Ingeniaritza espezialitatea</p><br>
	  <div>
	  <img src="..\images\IMG_1348.jpg" alt="Itsaso García" style="width:100px;height:120px;">
	  <p>Astigarraga</p>
	  </div>
	  <div>
	  <img src="..\images\IMG_20210704_135912_blanco.jpg" alt="Oihane Zaldua" style="width:100px;height:120px;">
	  <p>Irun</p>
	  </div>
    </div>
	<?php
	$access_key="43a61f99698574b0c8223fafa426f11b";
	$ch = curl_init('http://api.ipstack.com/check?access_key='.$access_key.'');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Store the data:
	$json = curl_exec($ch);
	curl_close($ch);

	// Decode JSON response:
	$api_result = json_decode($json, true);
	// Output
	$country = $api_result['country_name'];
	$region = $api_result['region_name'];
	$city = $api_result['city'];
	$longitude = $api_result['longitude'];
	$latitude = $api_result['latitude'];
	echo "<p>Ongi etorri ";
	echo $city.', '.$region.', '.$country;
	echo "-tik!!".$api_result['location']['country_flag_emoji']."</p><br/>";
	?>
	<div id="map"></div>
	<script type="text/javascript">
		var mymap = L.map('map').setView([ <?php echo $latitude; ?>, <?php echo $longitude; ?>],15);
		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
          maxZoom: 28
      	}).addTo(mymap);
		var marker = L.marker([ <?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(mymap);
		marker.bindPopup("Zerbitzaria hemen dago.").openPopup();
	</script>	
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
