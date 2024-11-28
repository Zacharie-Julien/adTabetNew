<?php
function connect($config)
{
    try {
        $db = new PDO('mysql:host=' . $config['serveur'] . ';port=3306;dbname=' . $config['bd'], $config['login'], $config['mdp']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        $db = null;
    }
    return $db;
}
