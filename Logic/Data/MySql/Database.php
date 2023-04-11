<?php

declare(strict_types=1);

namespace TaskStep\Data;

use PDO;
use PDOException;
use PDOStatement;

/**
 * Classe database en singleton pour la connexion à la base de données
 * 
 */
class Database{

    private static ?Database $instance;

    private PDO $data;

    /**
     * Constructeur de la classe Database, initie le PDO
     * 
     */
    private function __construct(){
        Self::$data = new PDO("","","");
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
     * Permet d'executer une requete sans retour
     * 
     * 
     * $query = requette à executer
     * $param = array de valeur
     */
    public function executeNonQuery(string $query, array $param = [])
    {
        try
        {
            $request = $this->data->prepare($query);
            $request->execute($param);
        }
        catch(PDOException $e)
        {
            throw $e;
        }
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