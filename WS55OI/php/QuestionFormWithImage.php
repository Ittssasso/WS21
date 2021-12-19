<!DOCTYPE html>
<?php
session_start();
$id=session_id();
if(!isset($_SESSION['eposta'])){
    header("location: LogIn.php");
}else if($_SESSION["id"]!=$id){
    header("location: Layout.php");
}else if($_SESSION['erabiltzaile']!='irakasle' && $_SESSION['erabiltzaile']!='ikasle'){
    header("location: Layout.php");
}
?>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--<script src="../js/ValidateFieldsQuestionJS.js"> </script>-->
  <script src="../js/ValidateFieldsQuestionJQ.js"> </script>
  <script src="../js/ShowImageInForm.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
    <div style="text-align: left">
		<form id="galderenF" name="galderenF" action="<?php echo 'AddQuestionWithImage.php?'?>" onsubmit="return egiaztatu()" method="post" enctype="multipart/form-data"> <!--"onsubmit" JavaScript-ekin erabiltzen da, JQuery-rekin ez-->
			<label>Eposta (*):</label>
			<input type="text" id="egilea" name="egilea" readonly="readonly" value="<?php echo $_SESSION['eposta']; ?>" ><br>
			<label>Galderaren testua (*):</label>
			<input type="text" id="galdera" name="galdera"><br>
			<label>Erantzun zuzena (*):</label>
			<input type="text" id="erantzunZ" name="erantzunZ"><br>
			<label>Erantzun okerra1 (*):</label>
			<input type="text" id="erantzunO1" name="erantzunO1"><br>
			<label>Erantzun okerra2 (*):</label>
			<input type="text" id="erantzunO2" name="erantzunO2"><br>
			<label>Erantzun okerra3 (*):</label>
			<input type="text" id="erantzunO3" name="erantzunO3"><br>
			<label>Zailtasuna (*):</label>
			<input type="radio" id="zailtasun_txikia" name="zailtasuna" value='1'> <label>Txikia</label>
			<input type="radio" id="zailtasun_ertaina" name="zailtasuna" value='2'> <label>Ertaina</label>
			<input type="radio" id="zailtasun_handia" name="zailtasuna" value='3'> <label>Handia</label> <br>
			<label>Gai-arloa (*):</label>
			<input type="text" id="gaia" name="gaia"><br>
			<label>Irudi bat gehitu: </label>
			<input type="file" id="irudi" name="irudi" accept="image/*" onchange="kargatu(event)"> <br>
			<img id="irudia" width="100"><br>
			<input type="button" id="argazkia_ezabatu" value="Argazkia ezabatu" onclick="ezabatu()">
			<input type="reset" value="Hustu">
			<input type="submit" value="Submit" id="submit">
		</form> <br>

    </div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>
</html>