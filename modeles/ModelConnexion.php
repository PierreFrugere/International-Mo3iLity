<?php
/**
 * Created by PhpStorm.
 * User: HP470
 * Date: 17/01/2018
 * Time: 15:44
 */

require_once(__DIR__.'\..\config\MyPDO.php'); // chargement de la class conenxion base de donnees

class ModelConnexion
{
    /** @var PDO $myPDO*/
    private $myPDO;

    public function __construct() {
        $this->myPDO = new MyPDO();
    }

    /**
 * @param $username
 * @return mixed
 */
    public function getAdmin($username) {
        $stmt = $this->myPDO->prepare("SELECT * FROM administration WHERE idUtilisateur=:username");
        $stmt->execute(array(":username" => $username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count <= 0) {
            return "Erreur de connexion le nom de connexion ou le mot de passe est incorrect.";
        }
        return $row;
    }

    /**
     * @param $username
     * @param $pwd
     * @return mixed
     */
    public function getConnexionAdmin($username, $pwd) {
        $stmt = $this->myPDO->prepare("SELECT * FROM administration WHERE idUtilisateur=:username AND mdpUtilisateur=:pwd");
        $stmt->execute(array(":username" => $username, ":pwd" => $pwd));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count <= 0) {
            return "Erreur de connexion le nom de connexion ou le mot de passe est incorrect.";
        }
        return $row;
    }
}

