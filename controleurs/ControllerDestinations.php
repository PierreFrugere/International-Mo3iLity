<?php
require_once (__DIR__.'\..\modeles\ModelDestinations.php'); // chargement du modèle
$mi = new ModelDestinations();
$test = $mi->getLangue();
require (__DIR__.'\..\vues\destinations.phtml'); //redirige vers la vue