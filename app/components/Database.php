<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 14:38
 */

namespace App\Components;

class Database
{
    private $instance;
    private $dbConfig;

    public function __construct(array $dbConfig)
    {
        $this->dbConfig = $dbConfig;
        $db = new \PDO(
            $dbConfig['driver'] . ':host=' . $dbConfig['host'] . ';' .
            'port=' . $dbConfig['port'] . ';' .
            'dbname=' . $dbConfig['database'],
            $dbConfig['username'],
            $dbConfig['password'],
            [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC]
        );
        if ($db) {
            $this->instance = $db;
        } else {
            throw new \PDOException('Database::connect() - Something went wrong');
        }
    }

    public function getInstance(): \PDO
    {
        return $this->instance;
    }
}