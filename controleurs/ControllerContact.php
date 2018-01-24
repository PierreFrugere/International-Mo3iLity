<?php
require_once (__DIR__.'\..\modeles\ModelContact.php'); // chargement du modèle
$mi = new ModelContact();
$test = $mi->getLangue();
require (__DIR__.'\..\vues\contact.phtml'); //redirige vers la vue