<?php
session_start();
$id=session_id();
if($_POST['zuzen'] == "true"){ //Galdera asmatu badu, Play.php- hasieratutako session-en aldagaiak inkrementatu. Gaika eta orokorrean.
	$_SESSION['zuzenKop'] = $_SESSION['zuzenKop'] + 1;
	$_SESSION[$_POST['gaia'].'ZuzenKop'] = $_SESSION[$_POST['gaia'].'ZuzenKop'] + 1;
	echo "OSO ONDO!";
}else { //Galdera ez badu asmatu, Play.php- hasieratutako session-en aldagaiak inkrementatu. Gaika eta orokorrean.
	$_SESSION['gaizkiKop'] = $_SESSION['gaizkiKop'] + 1;
	$_SESSION[$_POST['gaia'].'OkerKop'] = $_SESSION[$_POST['gaia'].'OkerKop'] + 1;
	echo "GAIZKI!";
}
array_shift($_SESSION[$_POST['gaia']]);
?>