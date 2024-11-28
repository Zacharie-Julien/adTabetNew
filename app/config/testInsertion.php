<?php
require_once '../config/parametres.php';
require_once '../config/connexion.php';

try {
    // Connexion à la base de données
    $bd = connect($config);
    
    // Exemple de données à insérer
    $nom = "Doe";
    $prenom = "John";
    $email = "john.doe@example.com";
    $mdp = password_hash("password123", PASSWORD_DEFAULT); // Hash du mot de passe
    $role = 2; // Client

    // Requête d'insertion
    $stmt = $bd->prepare("INSERT INTO utilisateur (nom, prenom, email, mdp, idRole) VALUES (:nom, :prenom, :email, :mdp, :role)");
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':mdp' => $mdp,
        ':role' => $role
    ]);

    echo "Inscription réussie !";
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}
?>
