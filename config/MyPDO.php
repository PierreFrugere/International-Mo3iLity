<?php

class MyPDO extends PDO
{
    private const DRIVER = 'mysql';
    private const HOST = 'localhost';
    private const DBNAME = 'international_mo3ility';
    private const USERNAME = 'root';
    private const PASSWD = '';

    /**
     * MyPDO constructor.
     * @throws Exception
     */
    public function __construct()
    {
        try {
            // TODO - Gestion avec .ini ou private var

            parent::__construct(MyPDO::DRIVER .
                ":host=" . MyPDO::HOST .
                ";dbname=" . MyPDO::DBNAME
                , MyPDO::USERNAME, MyPDO::PASSWD);

            $this->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            throw new PDOException('Erreur de connexion à la base de donnees!!!');
        }
    }
}

?>