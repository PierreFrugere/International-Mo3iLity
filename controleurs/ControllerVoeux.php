<?php
require_once (__DIR__.'\..\modeles\ModelVoeux.php'); // chargement du modèle
$mi = new ModelVoeux();
$listeDestinationsVoeux = $mi->getAllDestination();
require (__DIR__.'\..\vues\voeux.phtml'); //redirige vers la vue