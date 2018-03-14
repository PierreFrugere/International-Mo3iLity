<?php
require_once (__DIR__.'\..\modeles\ModelDestinations.php'); // chargement du modèle
$mi = new ModelDestinations();
if ($_GET["desti"] != "") {
    $infosDesti = $mi->getDestinationById($_GET["desti"]);


    if ($infosDesti == "404") {
        header('HTTP/1.1 404 Not Found');
        exit();
    }
    $temoignageDesti = $mi->getTemoignageById($_GET["desti"]);
    $infosTemoignage = $mi->getInfosTemoignageByIdDesti($_GET["desti"]);
    $spokenLang = $mi->getListeLangueById($_GET["desti"]);
}


$libellesTheme = $mi->getLibellesTheme();



require (__DIR__ . '\..\vues\destination.phtml'); //redirige vers la vue