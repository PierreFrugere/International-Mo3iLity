<?php
class MyPDO extends PDO
{

    /**
     * MyPDO constructor.
     * @param string $file
     * @throws Exception
     */
    public function __construct($file = __DIR__.'\my_setting.ini')
    {
        try {
//            if (!$settings = parse_ini_file($file, TRUE)) throw new Exception('Unable to open ' . $file . '.');

//            $dns = $settings['database']['driver'] .
//                ':host=' . $settings['database']['host'] .
//                ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
//                ';dbname=' . $settings['database']['schema'];
            // TODO - Gestion avec .ini ou private var

            parent::__construct("mysql:host=localhost;dbname=international_mo3ility", "root", "");

//            return $this->con;
        } catch (PDOException $e) {
            throw new PDOException('Erreur de connexion à la base de donnees!!!');
        }
    }
}
?>