<?php

declare(strict_types=1);

namespace TaskStep\Logic\Data\LegacyMySql;

require_once 'config.php';

use TaskStep\Config;
use \Exception;
use \PDO, \PDOException, \PDOStatement;

/**
 * Connexion à la base de données.
 * 
 * Cette classe est un singleton: utilisez `instance()` pour y avoir accès.
 */
class Database
{
    // -- SINGLETON --

    private static ?Database $_instance = null;

    /**
     * Récupère la connexion actuelle à la BDD.
     */
    public static function instance() : Database
    {
        if(is_null(Self::$_instance))
        {
            Self::$_instance = new Database();
        }
        return Self::$_instance;
    }


    // -- CONNEXION BDD --

    private PDO $pdo;

    private function __construct()
    {
        $config = Config::instance()->legacyDatabase();

        $this->pdo = new PDO($config->dsn(), $config->username(), $config->password());
    }

    /**
     * Exécute une requête et renvoie un curseur sur le résultat.
     * 
     * @param $query La requête SQL à exécuter.
     * 
     * @param $parameters Les paramètres à injecter dans la requête.
     */
    public function execute(string $query, mixed ...$parameters) : PDOStatement
    {
        $statement = $this->pdo->prepare($query);

        if (!$statement->execute($parameters))
        {
            // récupère le message d'erreur enoyé par la BDD
            throw new Exception($statement->errorInfo()[2]);
        }

        return $statement;
    }
}