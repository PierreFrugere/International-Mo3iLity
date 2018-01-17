<?php
require_once (__DIR__.'\..\modeles\ModelIndex.php'); // chargement du modèle
$mi = new ModelIndex();
$test = $mi->getLangue();
require (__DIR__.'\..\vues\index.phtml'); //redirige vers la vue