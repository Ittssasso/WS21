<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>

      <h2>Quiz: galderen jokoa</h2><br>
      <?php include '../php/Top10.php' ?>
	  
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>