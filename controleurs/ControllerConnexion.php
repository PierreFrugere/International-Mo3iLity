<?php
require_once(__DIR__ . '\..\modeles\ModelConnexion.php'); // chargement du modèle

$errorMSG = "";

// on teste si nos variables sont définies
if (isset($_POST['login']) && isset($_POST['pwd'])) {

    $mc = new ModelConnexion();
    $connexion = $mc->getConnexionAdmin($_POST['login'],$_POST['pwd']);

    // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
    if ($connexion > 0) {
        // dans ce cas, tout est ok, on peut démarrer notre session

        // on la démarre :)
        session_start ();
        // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['pwd'] = $_POST['pwd'];

        // on redirige notre visiteur vers une page de notre section membre
        header ('location: ../Admin/index.php');
    }
    else {
        // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
        $errorMSG = "Membre non reconnu...";
    }
}
require (__DIR__.'\..\vues\connexion.phtml'); //redirige vers la vue