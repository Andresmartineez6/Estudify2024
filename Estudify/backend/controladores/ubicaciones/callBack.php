<?php
session_start();
require_once 'vendor/autoload.php';

$client = getClient();
if (!isset($_GET['code'])) {
    exit('No authorization code provided');
}

$client->fetchAccessTokenWithAuthCode($_GET['code']);
$_SESSION['access_token'] = $client->getAccessToken();
header('Location: sync_calendar.php'); // Redirige a la sincronización después de autenticar
