<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();
// On récupère nos variables de session
if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
	require_once (__DIR__.'\..\modeles\ModelIndex.php'); // chargement du modèle
	$mi = new ModelIndex();
	// $mi->addSlider("test", "test", "test");
	$slidesDestination = $mi->getDestination();

	if (isset($_POST['nom']) && isset($_POST['description']) && (isset($_POST['fileToUpload']))) {
		$target_dir = dirname(__FILE__).'\..\..\medias\images';
		$target_file = $target_dir . '\\' . basename($_FILES["fileToUpload"]["name"]);
		// TODO: ne fonctionne pas actuellement
		// move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)

		$mi->addSlider($_POST['nom'], "../medias/images/defaut.png", $_POST['description']);
	}

	if (isset($_POST['listeSlider'])) {
		$mi->deleteSlider($_POST['listeSlider']);
	}

  require(__DIR__ . '\..\vues\index.phtml'); //redirige vers la vue
} else {
    $errorMSG = "Veuillez vous connecter pour accéder à cette page";
    require(__DIR__ . '\..\..\vues\connexion.phtml'); //redirige vers la vue
}
