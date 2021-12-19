<?php
require_once '../vendor/autoload.php';

$client = new Google_Client();
$clientID = '301823043223-2p8fi463qk8ma5bj3mmi3mf1jg7u5dsf.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'https://sw.ikasten.io/~igarcia393/WS55OI/php/Layout.php';
//$redirectUri = 'http://localhost/WS55OI/php/Layout.php';
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');
?>