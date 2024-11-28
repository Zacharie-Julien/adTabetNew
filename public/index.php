<?php
session_start();

require_once '../lib/vendor/autoload.php';  // Charger Twig
require_once '../app/routes/routes.php';        // Charger les routes
require_once '../app/controllers/_controleurs.php';  // Charger les contrôleurs
require_once '../app/models/class_utilisateur.php';

$loader = new \Twig\Loader\FilesystemLoader('../app/views/');
$twig = new \Twig\Environment($loader, []);
$twig->addGlobal('session', $_SESSION);

// Connexion à la base de données
require_once '../app/config/parametres.php';
require_once '../app/config/connexion.php';
$db = connect($config);
if ($db === null) {
    die("Échec de la connexion à la base de données.");
}
$contenu = getPage($db);

$contenu($twig, $db);
