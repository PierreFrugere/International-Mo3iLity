<?php
require_once(__DIR__ . '\..\modeles\ModelConnexion.php'); // chargement du modèle

$message = "";

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));

    $mc = new ModelConnexion();
    $row = $mc->getAdmin($username);

    if (is_array($row)) {
        if ($row['user_password'] == $password) {
            session_start();
            $_SESSION['user'] = $username;
            echo "Success";
        } else {

            $message = " password does not exist."; // wrong details
        }
    } else {
        $message = $row;
    }
}
require (__DIR__.'\..\vues\connexion.phtml'); //redirige vers la vue