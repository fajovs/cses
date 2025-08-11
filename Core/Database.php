<?php

namespace Core;
use PDO;
class Database {

    public $connection;

    public function __construct($config, $username = 'root', $password = '')
    {

        $dsn = "mysql:" . http_build_query($config, '', ';');


        $this->connection = new PDO($dsn, $username, $password,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {   

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;

    }

     public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollBack()
    {
        return $this->connection->rollBack();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}