<?php
require_once (__DIR__.'\..\modeles\ModelDestinations.php'); // chargement du modèle
$mi = new ModelDestinations();
$listeLangue = $mi->getListeLangue();
// $listePaysCritere = $mi->getListePaysCriteria($selectedCriteria);

// $listeLangueByPays = $mi->getListeLangueByPays($pays);
$listePays = $mi->getlistePays();
$boollll = false;
/* --- DEBUT récupération valeurs formulaire avec GET --- */
if (isset($_GET["search"])) {
    $recherche  = $_GET["search"];
    echo $recherche."<br />";
    $boollll = true;
}
if (isset($_GET["pays"])) {
    $selectedPays = $_GET["pays"];
    echo $selectedPays."<br />";
    $boollll = true;
}
if (isset($_GET["lang"])) {
    $selectedLang = $_GET["lang"];
    foreach ($selectedLang as $aLanguage){
        echo $aLanguage."<br />";
    }
    $boollll = true;
}





/* --- FIN récupération --- */
if ($boollll) {
    $listeDestinations = $mi->getListeDestinationsCriteria($recherche, $selectedPays, $selectedLang);
}

require (__DIR__.'\..\vues\destinations.phtml'); //redirige vers la vue