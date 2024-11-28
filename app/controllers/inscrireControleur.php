<?php
function inscrireControleur($twig, $db)
{
    $form = array();
    if (isset($_POST['btInscrire'])) {
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputPassword2 = $_POST['inputPassword2'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $role = $_POST['role'];
        $form['valide'] = true;
        if ($inputPassword != $inputPassword2) {
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        } elseif (verifierMdp($inputPassword) == false) {
            $form['valide'] = false;
            $form['message'] = 'Le mot de passe ne respecte pas les règles de conformité';
        } else {
            $utilisateur = new Utilisateur($db);
            $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $nom, $prenom);
            if (!$exec) {
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
            }
        }
        $form['email'] = $inputEmail;
        $form['role'] = $role;
    }
    echo $twig->render('inscrire.html.twig', array('form' => $form));
}
function verifierMdp($mdp)
{
    $nbMajuscules = 0;
    $nbMinuscules = 0;
    $nbChiffres = 0;
    $nbSpeciaux = 0;

    for ($i = 0; $i < strlen($mdp); $i++) {
        $c = $mdp[$i];
        if (ctype_upper($c)) {
            $nbMajuscules++;
        } elseif (ctype_lower($c)) {
            $nbMinuscules++;
        } elseif (ctype_digit($c)) {
            $nbChiffres++;
        } elseif ((ord($c) >= 33 && ord($c) <= 46) || ord($c) == 64) {
            $nbSpeciaux++;
        }
    }

    return (
        strlen($mdp) >= 12 &&
        $nbMajuscules >= 1 &&
        $nbMinuscules >= 3 &&
        $nbChiffres >= 4 &&
        $nbSpeciaux >= 1
    );
}
