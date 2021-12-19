<?php
try{
	if (file_exists('../xml/UserCounter.xml'))
		$xml=simplexml_load_file('../xml/UserCounter.xml');
	else
		throw new Exception("Ez da xml-a aurkitzen.");
	$kop=$xml->zenbat;
	$kop=$kop-1;
	$xml->zenbat = $kop;
	$xml->asXML('../xml/UserCounter.xml'); 
} catch(Exception $e){
	echo '<br>Errore bat gertatu da<br>';
}
?>