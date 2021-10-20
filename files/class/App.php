<?php

// This class allows to to use some functions concerning the database and the current user.

class App {

    static $db = null;

    // This function create an object Database, store it in the variable db and return it.

    static function getDatabase() {
        if (!self::$db) {
            self::$db = new Database();
        }
        return self::$db;
    }

    // This function create and returns an object Auth using an object Session, including an array of restriction messages.

    static function getAuth() {
        return new Auth(Session::getInstance(),
            ["restriction_msg" => "Vous n'avez pas le droit d'accéder à cette page.", 
            "restriction_msg_assembly" => "Vous n'avez pas le droit d'accéder à cette page si vous n'êtes pas connecté."]);
    }

    // This function redirect the user to the page indicated by the variable file.

    static function redirect($file) {
        header("location: $file");
        exit();
    }
}