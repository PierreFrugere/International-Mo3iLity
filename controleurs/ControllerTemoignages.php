<?php
require_once (__DIR__.'\..\modeles\ModelTemoignages.php'); // chargement du modèle
$mi = new ModelTemoignages();
$test = $mi->getLangue();
require (__DIR__.'\..\vues\temoignages.phtml'); //redirige vers la vue