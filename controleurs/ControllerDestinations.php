<?php
require_once (__DIR__.'\..\modeles\ModelDestinations.php'); // chargement du modèle
$mi = new ModelDestinations();
$listeLangue = $mi->getListeLangue();
// $listePaysCritere = $mi->getListePaysCriteria($selectedCriteria);
$listeLangueByPays = $mi->getListeLangueByPays($pays);
$listePays = $mi->getlistePays();
$listeDestinations = $mi->getListeDestinationsCriteria($criteres);
require (__DIR__.'\..\vues\destinations.phtml'); //redirige vers la vue