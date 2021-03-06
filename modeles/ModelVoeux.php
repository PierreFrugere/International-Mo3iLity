<?php
/**
 * Created by PhpStorm.
 * User: HP470
 * Date: 17/01/2018
 * Time: 15:44
 */

require_once(__DIR__.'\..\config\MyPDO.php'); // chargement de la class conenxion base de donnees

class ModelVoeux
{
    /** @var PDO $myPDO*/
    private $myPDO;

    public function __construct() {
        $this->myPDO = new MyPDO();
    }

    public function getAllDestination() {
        $allDesti = array();

        $sql =  'SELECT * FROM destination ORDER BY estObligatoire DESC';
        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($allDesti, $row);
        }
        return $allDesti;
    }
}

