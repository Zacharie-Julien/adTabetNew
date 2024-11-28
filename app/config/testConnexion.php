<?php
require_once './connexion.php';
require_once './parametres.php';

$db = connect($config);

if ($db) {
    echo "Connexion réussie à la base de données !";

    try {
        $result = $db->query("SELECT COUNT(*) FROM utilisateur");
        $count = $result->fetchColumn();
        echo "<br>Nombre d'utilisateurs dans la table : " . $count;
    } catch (PDOException $e) {
        echo "<br>Erreur lors de la requête : " . $e->getMessage();
    }
} else {
    echo "Échec de la connexion à la base de données.";
}
