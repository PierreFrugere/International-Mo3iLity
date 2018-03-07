<?php
require_once (__DIR__.'\..\modeles\ModelDestinations.php'); // chargement du modèle
$mi = new ModelDestinations();
$listeLangue = $mi->getListeLangue();

require (__DIR__ . '\..\vues\destination.phtml'); //redirige vers la vue