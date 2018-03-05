<?php
require_once (__DIR__.'\..\modeles\ModelDestinations.php'); // chargement du modèle
$mi = new ModelDestinations();
$listeLangue = $mi->getListeLangue();
// tableau 2D pour stocker les langues parlées dans chaque pays
$listeLangueByPays = array();
// paramètres de recherche par défaut
$recherche = "";
$selectedPays = "Tous";
$selectedLang = array();

$listePays = $mi->getlistePays();
$premierAppel = true;
/* --- DEBUT récupération valeurs formulaire avec GET --- */
if (isset($_POST["search"]) && $_POST["search"] != "") {
    $recherche  = $_POST["search"];
    $premierAppel = false;
}

if (isset($_POST["pays"])) {
    $selectedPays = $_POST["pays"];
    $premierAppel = false;
}

if (isset($_POST["lang"])) {
    $selectedLang = $_POST["lang"];
    $premierAppel = false;
}
/* --- FIN récupération --- */

if (!$premierAppel) {
    $listeDestinations = $mi->getListeDestinationsCriteria($recherche, $selectedPays, $selectedLang);
} else {
    // premier appel de la page --> affiche toutes les destinations
    $listeDestinations = $mi->getListeDestinationsCriteria($recherche, $selectedPays, $selectedLang);
}
/*
 * censé récupérer les langues parlées pour chaque pays mais ne fonctionne pas. (pb tableau)
for ($i = 0 ; $i < sizeof($listeDestinations) ; $i++) {
    $listeLangueByPays[$i] = $mi->getListeLangueByPays($listeDestinations[$i]["idDestination"]);
}
//print_r($mi->getListeLangueByPays($listeDestinations));
//print_r($listeLangueByPays);
*/
require (__DIR__.'\..\vues\destinations.phtml'); //redirige vers la vue