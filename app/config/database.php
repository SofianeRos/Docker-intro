<?php

require_once __DIR__ . '/config.php';

$connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// on vérifie la connexion
if (!$connexion) {
    die('Connexion échouée : ' . mysqli_connect_error());
}

// on force l'encodage utf8
mysqli_set_charset($connexion, 'utf8mb4');
?>