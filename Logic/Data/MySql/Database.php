<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\MySql;

use TaskStep\Config;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Classe database en singleton pour la connexion à la base de données
 * 
 */
class Database{

    private static ?Database $instance = null;

    private PDO $data;

    /**
     * Constructeur de la classe Database, initie le PDO
     * 
     */
    private function __construct(){
        $config = Config::instance()->currentDatabase();

        $this->data = new PDO($config->dsn(), $config->username(), $config->password());
    }


    /**
     * Coeur du singleton, récupere la connexion
     * 
     * return PDO
     */
    public static function getInstance() : Database
    {
        if(is_null(Self::$instance))
        {
            Self::$instance = new Database();
        }
        return Self::$instance;
    }



    /**
     * Permet d'exécuter une requête sans retour
     * 
     * @param $query La requête à exécuter
     * @param $param Les paramètres à insérer dans la requête.
     * 
     * @return Le nombre de lignes affectées par la requête.
     */
    public function executeNonQuery(string $query, array $param = []) : int
    {
        $rowCount = 0;
        
        try
        {
            $request = $this->data->prepare($query);
            $request->execute($param);
            $rowCount = $request->rowCount();
        }
        catch(PDOException $e)
        {
            throw $e;
        }

        return $rowCount;
    }

    /**
     * Permet d'execute une requete avec retour 
     * 
     * 
     * $query = requete à executer
     * $param = array de valeur
     */
    public function executeQuery(string $query, array $param = []) : ?PDOStatement
    {
        $request = null;
        try
        {
            $request = $this->data->prepare($query);
            $request->execute($param);
        }
        catch(PDOException $e)
        {
            throw $e;
        }

        return $request;
    }





}