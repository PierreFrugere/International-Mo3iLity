<?php
require_once (__DIR__.'\..\modeles\ModelVoeux.php'); // chargement du modèle
$mi = new ModelIndex();
$test = $mi->getLangue();
require (__DIR__.'\..\vues\voeux.phtml'); //redirige vers la vue