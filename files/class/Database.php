<?php

// This class allows to user functions concerning the database.

class Database{

    private $pdo;

    // Construct of the class, using the file database.php it sets the variable pdo as a pdo interface in order to communicate with the database.

    public function __construct() 
    {
        require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "database.php";

        $this->pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    // This function makes a query with possible given parameters to the database using the variable pdo, the request is returned.

    public function query($query, $params = false) {
        if($params) {
            $request = $this->pdo->prepare($query);
            $request->execute($params);    
        }
        else {
            $request = $this->pdo->query($query);
        }
        return $request;
    }

    // This function makes a query and a fetch with given parameters to the database using the variable pdo, the fetch is returned as an array.

    public function fetcher($query, $params) {
        $request = $this->pdo->prepare($query);
        $request->execute($params);
        return($request->fetch(PDO::FETCH_COLUMN, 0));
    }

    // This function returns the last inserted id in the database.

    public function lastInsertedId() {
        return $this->pdo->lastInsertId();
    }

}