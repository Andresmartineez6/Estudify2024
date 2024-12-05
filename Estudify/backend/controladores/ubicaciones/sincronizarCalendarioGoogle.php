<?php
require_once 'vendor/autoload.php';
session_start();

function getClient() {
    $client = new Google\Client();
    $client->setAuthConfig('path/to/credentials.json');
    $client->addScope(Google\Service\Calendar::CALENDAR);
    $client->setRedirectUri('http://localhost/estudify/callback.php');
    $client->setAccessType('offline');
    return $client;
}

// Autenticación inicial y sincronización
$client = getClient();

if (!isset($_SESSION['access_token'])) {
    // Si no hay token, redirige para autenticar
    $authUrl = $client->createAuthUrl();
    header("Location: $authUrl");
    exit();
} else {
    $client->setAccessToken($_SESSION['access_token']);
    $service = new Google\Service\Calendar($client);
    $calendarId = 'primary';

    // Obtener eventos desde la base de datos
    $events = getEventsFromDatabase(); // Implementa esta función

    foreach ($events as $event) {
        $googleEvent = new Google\Service\Calendar\Event([
            'summary' => $event['titulo'],
            'description' => $event['descripcion'],
            'start' => ['dateTime' => $event['fecha_inicio']],
            'end' => ['dateTime' => $event['fecha_fin']]
        ]);
        $service->events->insert($calendarId, $googleEvent);
    }
}
