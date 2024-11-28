<?php
function getPage($db)
{
    // Déclaration des pages du site
    $lesPages['accueil'] = "accueilControleur";
    $lesPages['contact'] = "contactControleur";
    $lesPages['mentions'] = "mentionsControleur";
    $lesPages['maintenance'] = "maintenanceControleur";
    $lesPages['inscrire'] = "inscrireControleur";
    $lesPages['connexion'] = "connexionControleur";
    $lesPages['utilisateur'] = "utilisateurControleur";
    $lesPages['deconnexion'] = "deconnexionControleur";
    $lesPages['utilisateurModif'] = "utilisateurModifControleur";
    $lesPages['utilisateurSuppr'] = "utilisateurSupprControleur";





    // Vérifier si la connexion à la base de données fonctionne
    if ($db != null) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'accueil';
        }
        if (!isset($lesPages[$page])) {
            $page = 'accueil';
        }
        $contenu = $lesPages[$page];
    } else {
        $contenu = $lesPages['maintenance'];  // Page de maintenance en cas d'erreur
    }
    return $contenu;
}
