<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>

<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div  style="text-align: left">
		<form id="galderenF" name="galderenF" action="AddQuestion.php" onsubmit="return egiaztatu()" method="post">
			<label>Eposta (*):</label>
			<input type="email" pattern="([a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es))|([a-zA-Z]+(\.[a-zA-Z]+)?@ehu\.(eus|es))" id="egilea" name="egilea" required><br>
			<label>Galderaren testua (*):</label>
			<input type="text" id="galdera" name="galdera" required minlength="10"><br>
			<label>Erantzun zuzena (*):</label>
			<input type="text" id="erantzunZ" name="erantzunZ" required><br>
			<label>Erantzun okerra1 (*):</label>
			<input type="text" id="erantzunO1" name="erantzunO1" required><br>
			<label>Erantzun okerra2 (*):</label>
			<input type="text" id="erantzunO2" name="erantzunO2" required><br>
			<label>Erantzun okerra3 (*):</label>
			<input type="text" id="erantzunO3" name="erantzunO3" required><br>
			<label>Zailtasuna (*):</label>
			<input type="radio" id="zailtasun_txikia" name="zailtasuna" value="Txikia" checked> <label>Txikia</label>
			<input type="radio" id="zailtasun_ertaina" name="zailtasuna" value="Ertaina"> <label>Ertaina</label>
			<input type="radio" id="zailtasun_handia" name="zailtasuna" value="Handia"> <label>Handia</label> <br>
			<label>Gai-arloa (*):</label>
			<input type="text" id="gaia" name="gaia" required><br><br>
			<input type="submit" value="Submit">
		</form> <br>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
