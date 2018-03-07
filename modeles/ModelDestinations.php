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
        $destiResult = array();
        // index de parcours des langues dans $listLang
        $i = 0;

        // permet de savoir s'il y a déjà eu un critère pris en compte : pour écrire "WHERE" dans la rqt  si c'est le premier
        //                                                                           "AND" si ce n'est pas le premier
        $isFirstCrit = true;

        // taille du tableau $listLang contenant les ID des langues seléctionnées
        $szLang = sizeof($listLang);

        // découpage de la chaine de caractères en tableau de mots pour une recherche appropriée
        $words = explode(" ", $recherche);

        // rqt sql dynamique en fonction des paramètres saisis par l'utilisaetur
        $sql = 'SELECT * FROM destination ';

        /* Construction */
        // langue(s) parlée(s) choisie(s)
        if ($szLang <> 0) {
            $sql .= 'JOIN parler ON destination.idDestination = parler.idDestination ';
            $sql .= 'WHERE parler.idLangue IN (';

            // ajout de chaque ID langue seléctionné par l'utilisateur, dans la rqt
            do {
                $sql.= '\'' . $listLang[$i] . '\'';
                $i++;
                // on n'ajoute pas de virgule pour le dernier élément
                if ($i < $szLang) {
                    $sql.= ',';
                }

            } while ($i < $szLang);
            $sql .= ') ';
            $isFirstCrit = false;
        }

        // pays choisi (choix unique)
        if ($pays <> "Tous") {
            // si un autre critère a été seléctionné auparavant, on concatène en fonction de la rqt précédente
            // sinon écrire clause WHERE
            $sql .= (($isFirstCrit)?'WHERE':'AND') . ' destination.pays = \'' . $pays . '\' ';
            $isFirstCrit = false;
        }

        // mot(s)-clé(s) choisi(s)
        if ($words[0] <> "") {
            // raz indice parcours
            $i = 0;

            // si un autre critère a été seléctionné auparavant, on concatène en fonction de la rqt précédente
            // sinon écrire clause WHERE
            $sql .= (($isFirstCrit)?'WHERE':'AND') . ' (destination.descriptif REGEXP ';

            // ajout des mots clés à la rqt
            do {
                $sql.= '\'' . $words[$i] . '\'';
                $i++;
                // on n'ajoute pas de 'AND' pour le dernier élément
                if ($i < sizeof($words)) {
                    $sql.= ' AND destination.descriptif REGEXP ';
                }

            } while ($i < sizeof($words));
            $sql .= ') ';
        }

        // aucun critère séléctionné => renvoie toutes les destinations

        $sql .= ' ORDER BY pays';

        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($destiResult, $row);
        }
        return $destiResult;
    }


    /**
     * @return $allPays : tableau contenant la liste des pays
     */
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

    /**
     * @unused
     * @param $idPays
     * @return array contenant les libellés des langues parlées par le pays
     */
    public function getListeLangueByPays($idPays) {
        $languages = array();
        // TODO PDO cf connexion
        $sql =  'SELECT DISTINCT(libelleLangue) FROM langue JOIN parler ON langue.idLangue = parler.idLangue ';
        $sql .= 'JOIN destination ON destination.idDestination = parler.idDestination ';
        $sql .= 'WHERE destination.idDestination = \'' . $idPays . '\' ORDER BY libelleLangue';
        foreach  ($this->myPDO->query($sql) as $row) {
            array_push($languages, $row);
        }
//        print_r($langes);
        echo "\nCOUCOU : ";
        echo $languages[0]["libelleLangue"];
        echo " FIN\n";
        return $languages;
    }

}

