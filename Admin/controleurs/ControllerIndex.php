<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();

// On récupère nos variables de session
if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
//    require_once (__DIR__.'\..\..\modeles\ModelVoeux.php'); // chargement du modèle
//    $mi = new ModelVoeux();
//    $test = $mi->getLangue();
    require(__DIR__ . '\..\vues\index.phtml'); //redirige vers la vue
} else {
    $errorMSG = "Veuillez vous connecter pour accéder à cette page";
    require(__DIR__ . '\..\..\vues\connexion.phtml'); //redirige vers la vue
}
