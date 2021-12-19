<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--<script src="../js/ValidateFieldsQuestionJS.js"> </script>-->
  <script src="../js/ValidateFieldsQuestionJQ.js"> </script>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div style="text-align: left">
		<form id="galderenF" name="galderenF" action="AddQuestion.php" onsubmit="return egiaztatu()" method="post">
			<label>Eposta (*):</label>
			<input type="text" id="egilea" name="egilea"><br>
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
			<input type="text" id="gaia" name="gaia"><br><br>
			<input type="submit" value="Submit" id="submit">
		</form> <br>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
