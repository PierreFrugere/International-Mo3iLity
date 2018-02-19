<?php
/**
 * Created by PhpStorm.
 * User: HP470
 * Date: 17/01/2018
 * Time: 15:44
 */

require_once(__DIR__.'\..\config\MyPDO.php'); // chargement de la class conenxion base de donnees

class ModelDestinations
{
    /** @var PDO $myPDO*/
    private $myPDO;

    public function __construct() {
        $this->myPDO = new MyPDO();
    }

    /**
     * Selection des destinations en fonction des critères de recherche stockés dans un tableau
     * @param $recherche : recherche de texte par l'utilisateur
     * @param $pays : pays seléctionné par l'utilisateur
     * @param $listLang : langages seléctionnés par l'utilisateur
     */
    public function getListeDestinationsCriteria($recherche, $pays, $listLang) {
        $allDesti = array();
        // index de parcours des langues dans $languages
        $i = 0;
        // taille du tableau $languages
        $taille = sizeof($listLang);

        // aucune langue séléctionnée => renvoie tous les pays
        if ($taille == 0) {
            $sql =  'SELECT * FROM destination ORDER BY pays';
        } else {
            $sql =  'SELECT * FROM destination JOIN parler ON parler.idDestination = destination.idDestination ';
            $sql .= 'WHERE parler.idLangue IN (';

            do {
                $sql.= $listLang[$i] . '\'';
                // on n'ajoute pas de virgule pour le dernier élément
                if ($i < $taille) {
                    $sql.= ',';
                }
            } while ($i < $taille);
            $sql .= ') ORDER BY pays';
        }

        echo $sql;

        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($allDesti, $row);
        }
        return $allDesti;
    }

    public function getListePays() {
        $allPays = array();

        $sql =  'SELECT DISTINCT(pays) FROM destination ORDER BY pays';

        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($allPays, $row);
        }
        return $allPays;
    }

    public function getListeLangue() {
        $allLanguages = array();

        $sql =  'SELECT idLangue, libelleLangue FROM langue ORDER BY libelleLangue';
        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($allLanguages, $row);
        }
        return $allLanguages;
    }

    public function getListeLangueByPays($idPays) {
        $languages = array();

        $sql =  'SELECT DISTINCT(libelleLangue) FROM langue JOIN parler ON langue.idLangue = parler.idLangue';
        $sql .= ' JOIN destination ON destination.idDestination = parler.idDestination ';
        $sql .= 'WHERE destination.idDestination = \'' . $idPays . '\' ORDER BY libelleLangue';
        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($languages, $row);
        }
        return $languages;
    }

}

