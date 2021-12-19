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
  <script src="../js/ValidateFieldsQuestionJQ.js"></script>
  <script src="../js/ShowImageInForm.js"></script>
  <script src="../js/AddQuestionAjax.js"></script>
  <script src="../js/ShowQuestionsAjax.js"></script>
  <script src="../js/JsonQuestionsCounter.js"></script>
  <script src="../js/XmlUserCounter.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
    <div id="galderaGehituDiv" style="text-align: left">
		<p> Kautotutako erabiltzaile kopurua: <span id='user'></span></p>
		<p> Nire galderak/Galderak guztira (JSON) datu-basean: <span id='zenbatNireak'></span> / <span id='zenbatDBJson'></span>  </p>
		<form id="galderenF" name="galderenF" action="" method="post" enctype="multipart/form-data"> 
			<label>Eposta (*):</label>
			<input type="text" id="egilea" name="egilea" value="<?php echo $_SESSION['eposta']; ?>" readonly="readonly"><br>
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
			<input type="button" value="Galdera gehitu" id="submit">
			<input type="button" value="Galderak ikusi" id="ikusi" onclick="ikusiGalderak()">
		</form> <br>
		<p id="zuzen_mezua" name="zuzen_mezua" style="font-style: italic; font-size: 15px; text-align: center"></p>
	</div>

    <div style="text-align: left" id="ShowQuestions"> </div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>